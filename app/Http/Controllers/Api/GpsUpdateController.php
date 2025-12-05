<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ambulance;
use App\Models\EmergencyCase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GpsUpdateController extends Controller
{
    // Geofence radius in meters (100 meters as specified)
    const GEOFENCE_RADIUS = 100;

    /**
     * Calculate distance between two coordinates using Haversine formula
     * Returns distance in meters
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Earth's radius in meters

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    /**
     * Check if driver is within geofence of any active case pickup or destination
     */
    private function checkGeofence($ambulance, $driverLat, $driverLon)
    {
        if (!$ambulance || !$driverLat || !$driverLon) {
            return null;
        }

        // Get all active cases assigned to this ambulance
        $cases = EmergencyCase::where('ambulance_id', $ambulance->id)
            ->where('status', '!=', 'Completed')
            ->get();

        foreach ($cases as $case) {
            // Check pickup location geofence
            if ($case->latitude && $case->longitude) {
                $pickupDistance = $this->calculateDistance(
                    $driverLat,
                    $driverLon,
                    $case->latitude,
                    $case->longitude
                );

                if ($pickupDistance <= self::GEOFENCE_RADIUS) {
                    $cacheKey = "geofence_entered:case_{$case->case_num}:pickup:ambulance_{$ambulance->id}";
                    
                    if (!Cache::has($cacheKey)) {
                        Cache::put($cacheKey, true, now()->addHours(24));
                        
                        $notificationKey = "geofence_notification:case_{$case->case_num}:pickup";
                        Cache::put($notificationKey, [
                            'case_num' => $case->case_num,
                            'case_name' => $case->name,
                            'case_type' => $case->type,
                            'ambulance_id' => $ambulance->id,
                            'ambulance_name' => $ambulance->name,
                            'driver_id' => $ambulance->driver ? $ambulance->driver->id : null,
                            'driver_name' => $ambulance->driver ? $ambulance->driver->name : 'Unknown',
                            'distance' => round($pickupDistance, 2),
                            'location_type' => 'pickup',
                            'timestamp' => now()->toIso8601String(),
                        ], now()->addHours(1));
                        
                        return [
                            'case_num' => $case->case_num,
                            'case_name' => $case->name,
                            'case_type' => $case->type,
                            'ambulance_id' => $ambulance->id,
                            'ambulance_name' => $ambulance->name,
                            'driver_id' => $ambulance->driver ? $ambulance->driver->id : null,
                            'driver_name' => $ambulance->driver ? $ambulance->driver->name : 'Unknown',
                            'distance' => round($pickupDistance, 2),
                            'location_type' => 'pickup',
                        ];
                    }
                }
            }
            
            // Check destination location geofence
            if ($case->to_go_to_latitude && $case->to_go_to_longitude) {
                $destDistance = $this->calculateDistance(
                    $driverLat,
                    $driverLon,
                    $case->to_go_to_latitude,
                    $case->to_go_to_longitude
                );

                if ($destDistance <= self::GEOFENCE_RADIUS) {
                    $cacheKey = "geofence_entered:case_{$case->case_num}:destination:ambulance_{$ambulance->id}";
                    
                    if (!Cache::has($cacheKey)) {
                        Cache::put($cacheKey, true, now()->addHours(24));
                        
                        $notificationKey = "geofence_notification:case_{$case->case_num}:destination";
                        Cache::put($notificationKey, [
                            'case_num' => $case->case_num,
                            'case_name' => $case->name,
                            'case_type' => $case->type,
                            'ambulance_id' => $ambulance->id,
                            'ambulance_name' => $ambulance->name,
                            'driver_id' => $ambulance->driver ? $ambulance->driver->id : null,
                            'driver_name' => $ambulance->driver ? $ambulance->driver->name : 'Unknown',
                            'distance' => round($destDistance, 2),
                            'location_type' => 'destination',
                            'timestamp' => now()->toIso8601String(),
                        ], now()->addHours(1));
                        
                        return [
                            'case_num' => $case->case_num,
                            'case_name' => $case->name,
                            'case_type' => $case->type,
                            'ambulance_id' => $ambulance->id,
                            'ambulance_name' => $ambulance->name,
                            'driver_id' => $ambulance->driver ? $ambulance->driver->id : null,
                            'driver_name' => $ambulance->driver ? $ambulance->driver->name : 'Unknown',
                            'distance' => round($destDistance, 2),
                            'location_type' => 'destination',
                        ];
                    }
                }
            }
        }

        return null;
    }

    public function update(Request $request)
    {
        $ambulance = Ambulance::find($request->id);

        if ($ambulance) {
            $ambulance->latitude = $request->latitude;
            $ambulance->longitude = $request->longitude;
            $ambulance->save();

            // Update the driver's last seen timestamp without changing availability
            try {
                $driver = $ambulance->driver; // relies on Ambulance->driver relation
                if ($driver) {
                    $driver->last_seen_at = now();
                    $driver->save();
                }
            } catch (\Throwable $e) {
                // Silently ignore relation issues to avoid impacting GPS updates
            }

            // Check if admin requested forced logout for the assigned driver
            $mustLogout = false;
            $driver = null;
            
            try {
                // First, try to get driver via direct relationship
                $driver = $ambulance->driver;
                
                // If no direct relationship, check active pairing
                if (!$driver) {
                    $activePairing = \App\Models\DriverAmbulancePairing::where('ambulance_id', $ambulance->id)
                        ->where('status', 'active')
                        ->orderByDesc('pairing_date')
                        ->first();
                    
                    if ($activePairing) {
                        $driver = $activePairing->driver;
                    }
                }
                
                // Check cache for logout flag if we found a driver
                if ($driver) {
                    $cacheKey = 'driver:force_logout:' . $driver->id;
                    $cacheValue = Cache::pull($cacheKey, false);
                    $mustLogout = $cacheValue ? true : false;
                    
                    if ($mustLogout) {
                        Log::info('Driver force logout detected', [
                            'driver_id' => $driver->id,
                            'driver_name' => $driver->name,
                            'ambulance_id' => $ambulance->id,
                            'cache_key' => $cacheKey,
                            'via_pairing' => !$ambulance->driver
                        ]);
                    }
                } else {
                    // Log warning if no driver found for this ambulance
                    Log::warning('No driver found for ambulance when checking force logout', [
                        'ambulance_id' => $ambulance->id,
                        'ambulance_name' => $ambulance->name
                    ]);
                }
            } catch (\Throwable $e) {
                Log::error('Error checking driver force logout', [
                    'ambulance_id' => $ambulance->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

            // Check geofence proximity
            $geofenceAlert = null;
            try {
                if ($request->latitude && $request->longitude && $ambulance->driver) {
                    $geofenceAlert = $this->checkGeofence(
                        $ambulance,
                        $request->latitude,
                        $request->longitude
                    );
                }
            } catch (\Throwable $e) {
                // Log error but don't break GPS updates
                Log::error('Geofence check error: ' . $e->getMessage());
            }

            return response()->json([
                'message' => 'Location updated',
                'must_logout' => $mustLogout,
                'geofence_alert' => $geofenceAlert
            ]);
        }

        return response()->json(['error' => 'Ambulance not found'], 404);
    }
}
