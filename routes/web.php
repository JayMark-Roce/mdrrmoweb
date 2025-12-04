<?php

use Illuminate\Support\Facades\Route;

// ===============================
// 🧭 Public Controllers
// ===============================
use App\Http\Controllers\PublicDashboardController;
use App\Http\Controllers\PublicSite\ServiceController as PublicServiceController;
use App\Http\Controllers\PublicSite\BookingController as PublicBookingController;
use App\Http\Controllers\Admin\ReviewController;

// ===============================
// 🔐 Authenticated Admin Controllers
// ===============================
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\Admin\GpsController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\AmbulanceController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\MissionVisionController;
use App\Http\Controllers\Admin\AboutMdrrmoController;
use App\Http\Controllers\Admin\OfficialController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CaseController;
use App\Http\Controllers\Admin\PairingController;
use App\Http\Controllers\Admin\MedicController;

// ===============================
// 🔧 Testing, Dev Tools
// ===============================
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\GpsUpdateController;
use App\Http\Controllers\AmbulanceBillingController;
use App\Http\Controllers\Driver\Auth\LoginController;
use App\Http\Controllers\Api\AssignmentController;

// ===============================
// 🌐 Public Routes
// ===============================

// Root route -> login page
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    // Force clear any potential caching
    return response()->view('auth.login')->header('Cache-Control', 'no-cache, no-store, must-revalidate');
})->name('home');

// Test route
Route::get('/test', function() {
    return 'Laravel is working! Time: ' . now();
});

// Public services
Route::get('/services', [PublicServiceController::class, 'index'])->name('services.index');
Route::get('/services/{id}', [PublicServiceController::class, 'show'])->name('services.show');

// Public reviews & bookings
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('/bookings', [PublicBookingController::class, 'store'])->name('bookings.store')->middleware('throttle:5,1');

// Auth routes
require __DIR__.'/auth.php';

// Contact page
Route::view('/contact', 'public.contact.contact')->name('contact');


// ===============================
// 🔐 Admin Dashboard
// ===============================
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/metrics', [DashboardController::class, 'getMetricsByDate'])->middleware(['auth'])->name('dashboard.metrics');
Route::get('/dashboard/view', function(){
    return view('dashboard_view');
})->middleware(['auth'])->name('dashboard.view');

// PWA assets
Route::get('/manifest.webmanifest', function(){
    $path = public_path('manifest.webmanifest');
    if (!file_exists($path)) abort(404);
    return response()->file($path, [ 'Content-Type' => 'application/manifest+json' ]);
});
Route::get('/sw.js', function(){
    $path = public_path('sw.js');
    if (!file_exists($path)) abort(404);
    return response()->file($path, ['Content-Type' => 'application/javascript']);
});
Route::get('/icons/icon-192.svg', function(){
    $path = public_path('icons/icon-192.svg');
    if (!file_exists($path)) abort(404);
    return response()->file($path, ['Content-Type' => 'image/svg+xml']);
});
Route::get('/icons/icon-512.svg', function(){
    $path = public_path('icons/icon-512.svg');
    if (!file_exists($path)) abort(404);
    return response()->file($path, ['Content-Type' => 'image/svg+xml']);
});

// ===============================
// 📣 Admin Content Posting
// ===============================
Route::prefix('admin/posting')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminContentController::class, 'showPostingPage'])->name('admin.posting');
    Route::post('/carousel', [CarouselController::class, 'store']);
    Route::post('/mission-vision', [MissionVisionController::class, 'store']);
    Route::post('/about', [AboutMdrrmoController::class, 'store']);
    Route::post('/officials', [OfficialController::class, 'store']);
    Route::post('/trainings', [TrainingController::class, 'store']);
});

// ===============================
// 🚑 Admin Ambulance Routes
// ===============================
Route::prefix('admin/ambulances')->middleware(['auth'])->group(function () {
    Route::get('/', [AmbulanceController::class, 'index'])->name('admin.ambulances.index');
    Route::post('/store', [AmbulanceController::class, 'store'])->name('admin.ambulances.store');
    Route::put('/{id}', [AmbulanceController::class, 'update'])->name('admin.ambulances.update');
    Route::post('/{id}/set-destination', [AmbulanceController::class, 'setDestination']);
    Route::post('/{id}/clear-destination', [AmbulanceController::class, 'clearDestination']);
});

// ===============================
// 🚨 Admin Emergency Cases Routes
// ===============================
Route::prefix('admin/cases')->middleware(['auth'])->group(function () {
    Route::get('/', [CaseController::class, 'index'])->name('admin.cases.index');
    Route::post('/', [CaseController::class, 'store'])->name('admin.cases.store');
    Route::get('/ambulance/counts', [CaseController::class, 'getAmbulanceCaseCounts'])->name('admin.cases.ambulance-counts');
    Route::get('/ambulances-for-redeployment', [CaseController::class, 'getAmbulancesForRedeployment'])->name('admin.cases.ambulances-for-redeployment');
    Route::get('/completed', [CaseController::class, 'getCompletedCases'])->name('admin.cases.completed');
    Route::get('/archived', [CaseController::class, 'getArchivedCases'])->name('admin.cases.archived');
    Route::get('/needing-redeployment', [CaseController::class, 'getCasesNeedingRedeployment'])->name('admin.cases.needing-redeployment');
    Route::get('/recent-actions', [CaseController::class, 'getRecentDriverActions'])->name('admin.cases.recent-actions');
    Route::get('/{case}', [CaseController::class, 'show'])->name('admin.cases.show');
    Route::patch('/{case}', [CaseController::class, 'update'])->name('admin.cases.update');
    Route::delete('/{case}', [CaseController::class, 'destroy'])->name('admin.cases.destroy');
    Route::post('/{case}/archive', [CaseController::class, 'archive'])->name('admin.cases.archive');
    Route::post('/archived/{archivedCase}/restore', [CaseController::class, 'restore'])->name('admin.cases.restore');
    Route::put('/{case}/status', [CaseController::class, 'updateStatus'])->name('admin.cases.update-status');
    Route::post('/{case}/redeploy', [CaseController::class, 'redeployCase'])->name('admin.cases.redeploy');
    Route::post('/{case}/complete', [CaseController::class, 'completeCaseAsAdmin'])->name('admin.cases.complete');
});

// ===============================
// 🚑 Driver Case Notifications Routes
// ===============================
Route::prefix('driver/cases')->middleware(['auth.driver'])->group(function () {
    Route::get('/notifications', [CaseController::class, 'getDriverNotifications'])->name('driver.cases.notifications');
    Route::get('/all', [CaseController::class, 'getAllDriverCases'])->name('driver.cases.all');
    Route::post('/{case}/accept', [CaseController::class, 'acceptCase'])->name('driver.cases.accept');
    Route::post('/{case}/reject', [CaseController::class, 'rejectCase'])->name('driver.cases.reject');
    Route::post('/{case}/complete', [CaseController::class, 'completeCase'])->name('driver.cases.complete');
});

// ===============================
// 🗺️ Admin GPS Tracking
// ===============================
Route::get('/admin/gps', [GpsController::class, 'index'])->middleware(['auth'])->name('admin.gps');
Route::post('/admin/gps/set-destination', [GpsController::class, 'setDestination'])->name('admin.gps.set-destination');
Route::get('/admin/gps/geofence-notifications', [GpsController::class, 'checkGeofenceNotifications'])->middleware(['auth'])->name('admin.gps.geofence-notifications');
Route::post('/admin/gps/geofence-notifications/acknowledge', [GpsController::class, 'acknowledgeGeofenceNotification'])->middleware(['auth'])->name('admin.gps.geofence-acknowledge');

Route::get('/admin/gps/data', function () {
    try {
        $ambulances = \App\Models\Ambulance::with('driver')->get();
        
        $filteredData = $ambulances->filter(function($ambulance) {
            if (!$ambulance->driver) {
                return false;
            }
            if (!$ambulance->latitude || !$ambulance->longitude) {
                return false;
            }
            if ($ambulance->driver->status !== 'active') {
                return false;
            }
            if (!in_array($ambulance->driver->availability_status, ['online', 'busy'])) {
                return false;
            }
            if (!$ambulance->driver->last_seen_at || $ambulance->driver->last_seen_at < now()->subMinutes(30)) {
                return false;
            }
            return true;
        })->map(function($ambulance) {
            $lastSeen = $ambulance->driver->last_seen_at;
            $minutesAgo = $lastSeen ? now()->diffInMinutes($lastSeen) : null;
            $secondsAgo = $lastSeen ? now()->diffInSeconds($lastSeen) : null;
            $isOnline = $secondsAgo !== null && $secondsAgo < 120;
            
            return [
                'id' => $ambulance->id,
                'name' => $ambulance->name,
                'latitude' => (float) $ambulance->latitude,
                'longitude' => (float) $ambulance->longitude,
                'status' => $ambulance->status,
                'driver_name' => $ambulance->driver->name,
                'driver_email' => $ambulance->driver->email,
                'driver_photo' => $ambulance->driver->photo_url,
                'last_seen' => $lastSeen,
                'last_seen_minutes_ago' => $minutesAgo,
                'is_available' => $ambulance->driver->is_available,
                'online_status' => $isOnline ? 'online' : 'stale',
                'destination_latitude' => $ambulance->destination_latitude ? (float) $ambulance->destination_latitude : null,
                'destination_longitude' => $ambulance->destination_longitude ? (float) $ambulance->destination_longitude : null,
            ];
        })->values();
        
        return response()->json($filteredData->toArray());
    } catch (\Exception $e) {
        return response()->json([]);
    }
})->name('admin.gps.data');

// GPS Resend Request System
Route::post('/admin/gps/resend-request/{ambulanceId}', function ($ambulanceId) {
    if (!auth()->check()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
    try {
        $cacheKey = "gps_resend_request_{$ambulanceId}";
        $cacheData = [
            'ambulance_id' => $ambulanceId,
            'requested_at' => now()->toIso8601String(),
            'status' => 'pending'
        ];
        \Cache::put($cacheKey, $cacheData, now()->addHours(1));
        
        return response()->json([
            'success' => true,
            'message' => 'GPS resend request sent to driver',
            'data' => $cacheData
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to send request: ' . $e->getMessage()
        ], 500);
    }
})->middleware('auth');

Route::get('/admin/gps/resend-status/{ambulanceId}', function ($ambulanceId) {
    if (!auth()->check()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
    try {
        $cacheKey = "gps_resend_request_{$ambulanceId}";
        $cacheData = \Cache::get($cacheKey);
        
        if (!$cacheData) {
            return response()->json([
                'success' => true,
                'exists' => false,
                'data' => null
            ]);
        }
        
        return response()->json([
            'success' => true,
            'exists' => true,
            'data' => $cacheData
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to check status: ' . $e->getMessage()
        ], 500);
    }
})->middleware('auth');

Route::post('/admin/gps/resend-clear/{ambulanceId}', function ($ambulanceId) {
    if (!auth()->check()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
    try {
        $cacheKey = "gps_resend_request_{$ambulanceId}";
        \Cache::forget($cacheKey);
        
        return response()->json([
            'success' => true,
            'message' => 'Resend request cleared'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to clear request: ' . $e->getMessage()
        ], 500);
    }
})->middleware('auth');

Route::get('/driver/gps/resend-check', function () {
    if (!auth('driver')->check()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
    try {
        $driver = auth('driver')->user();
        $ambulanceId = $driver->ambulance_id;
        
        if (!$ambulanceId) {
            $activePairing = \App\Models\DriverAmbulancePairing::where('driver_id', $driver->id)
                ->where('status', 'active')
                ->orderByDesc('pairing_date')
                ->first();
            $ambulanceId = optional($activePairing)->ambulance_id;
        }
        
        if (!$ambulanceId) {
            return response()->json([
                'success' => true,
                'exists' => false,
                'data' => null
            ]);
        }
        
        $cacheKey = "gps_resend_request_{$ambulanceId}";
        $cacheData = \Cache::get($cacheKey);
        
        if (!$cacheData) {
            return response()->json([
                'success' => true,
                'exists' => false,
                'data' => null
            ]);
        }
        
        return response()->json([
            'success' => true,
            'exists' => true,
            'data' => $cacheData
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to check request: ' . $e->getMessage()
        ], 500);
    }
})->middleware('auth.driver');

Route::post('/driver/gps/resend-acknowledge', function () {
    if (!auth('driver')->check()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
    try {
        $driver = auth('driver')->user();
        $ambulanceId = $driver->ambulance_id;
        
        if (!$ambulanceId) {
            $activePairing = \App\Models\DriverAmbulancePairing::where('driver_id', $driver->id)
                ->where('status', 'active')
                ->orderByDesc('pairing_date')
                ->first();
            $ambulanceId = optional($activePairing)->ambulance_id;
        }
        
        if (!$ambulanceId) {
            return response()->json([
                'success' => false,
                'message' => 'No ambulance assigned'
            ], 400);
        }
        
        $cacheKey = "gps_resend_request_{$ambulanceId}";
        $cacheData = \Cache::get($cacheKey);
        
        if (!$cacheData) {
            return response()->json([
                'success' => false,
                'message' => 'No pending request found'
            ], 404);
        }
        
        $cacheData['status'] = 'acknowledged';
        $cacheData['acknowledged_at'] = now()->toIso8601String();
        \Cache::put($cacheKey, $cacheData, now()->addHours(1));
        
        return response()->json([
            'success' => true,
            'message' => 'Request acknowledged',
            'data' => $cacheData
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to acknowledge: ' . $e->getMessage()
        ], 500);
    }
})->middleware('auth.driver');

Route::post('/driver/gps/resend-complete', function () {
    if (!auth('driver')->check()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
    try {
        $driver = auth('driver')->user();
        $ambulanceId = $driver->ambulance_id;
        
        if (!$ambulanceId) {
            $activePairing = \App\Models\DriverAmbulancePairing::where('driver_id', $driver->id)
                ->where('status', 'active')
                ->orderByDesc('pairing_date')
                ->first();
            $ambulanceId = optional($activePairing)->ambulance_id;
        }
        
        if (!$ambulanceId) {
            return response()->json([
                'success' => false,
                'message' => 'No ambulance assigned'
            ], 400);
        }
        
        $cacheKey = "gps_resend_request_{$ambulanceId}";
        $cacheData = \Cache::get($cacheKey);
        
        if (!$cacheData) {
            return response()->json([
                'success' => true,
                'message' => 'No pending request (may have expired)'
            ]);
        }
        
        $cacheData['status'] = 'completed';
        $cacheData['completed_at'] = now()->toIso8601String();
        \Cache::put($cacheKey, $cacheData, now()->addHours(1));
        
        return response()->json([
            'success' => true,
            'message' => 'Request marked as completed',
            'data' => $cacheData
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to complete: ' . $e->getMessage()
        ], 500);
    }
})->middleware('auth.driver');

// Admin assignment management
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/assignments/{driverId}', [AssignmentController::class, 'listStops']);
    Route::post('/admin/assignments/{driverId}/ensure', [AssignmentController::class, 'ensureForDriver']);
    Route::post('/admin/assignments/{driverId}/stops', [AssignmentController::class, 'addStop']);
    Route::post('/admin/assignments/{driverId}/reorder', [AssignmentController::class, 'reorderStops']);
    Route::delete('/admin/assignments/{driverId}/stops/{stopId}', [AssignmentController::class, 'removeStop']);
    Route::get('/admin/ambulances/{ambulanceId}/driver', function($ambulanceId) {
        $driver = \App\Models\Driver::where('ambulance_id', $ambulanceId)->first();
        return response()->json(['driver_id' => optional($driver)->id]);
    });
});

Route::post('/update-location', [GpsUpdateController::class, 'update'])->name('update.location');
Route::get('/driver/ambulance/{id}/destination', function ($id) {
    $amb = \App\Models\Ambulance::findOrFail($id);
    return response()->json([
        'destination_latitude' => $amb->destination_latitude,
        'destination_longitude' => $amb->destination_longitude
    ]);
});
Route::post('/driver/ambulance/{id}/arrived', function ($id) {
    $amb = \App\Models\Ambulance::findOrFail($id);
    $amb->destination_latitude = null;
    $amb->destination_longitude = null;
    $amb->status = 'Available';
    $amb->destination_updated_at = now();
    $amb->save();

    return response()->json(['success' => true]);
});

// ===============================
// 📊 Admin Reports
// ===============================
Route::get('/admin/reports', [ReportsController::class, 'index'])->middleware(['auth'])->name('admin.reports');
Route::get('/admin/reports/archived', [ReportsController::class, 'archived'])->middleware(['auth'])->name('admin.reports.archived');

// ===============================
// 🚗 Driver Location / Login
// ===============================
Route::prefix('driver')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('driver.login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('driver.login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('driver.logout');

    Route::middleware('auth.driver')->group(function () {
        Route::get('/send-location', function () {
            $driver = auth('driver')->user();
            $ambulanceId = $driver->ambulance_id;
            if (!$ambulanceId) {
                $activePairing = \App\Models\DriverAmbulancePairing::where('driver_id', $driver->id)
                    ->where('status', 'active')
                    ->orderByDesc('pairing_date')
                    ->first();
                $ambulanceId = optional($activePairing)->ambulance_id;
            }
            return view('driver.send-location', [
                'ambulanceId' => $ambulanceId,
            ]);
        });

        // Driver assignment endpoints
        Route::get('/assignment', [AssignmentController::class, 'driverAssignment']);
        Route::post('/assignment/reorder', [AssignmentController::class, 'driverReorder']);
        Route::post('/assignment/stops/{stopId}/complete', [AssignmentController::class, 'driverCompleteStop']);
    });
});

// ===============================
// 👨‍✈️ Admin Drivers
// ===============================
Route::prefix('admin/drivers')->middleware(['auth'])->group(function () {
    Route::get('/', [DriverController::class, 'index'])->name('admin.drivers.index');
    Route::get('/archived', [DriverController::class, 'archived'])->name('admin.drivers.archived');
    Route::get('/create', [DriverController::class, 'create'])->name('admin.drivers.create');
    Route::post('/', [DriverController::class, 'store'])->name('admin.drivers.store');
    Route::get('/{driver}', [DriverController::class, 'show'])->name('admin.drivers.show');
    Route::get('/{driver}/edit', [DriverController::class, 'edit'])->name('admin.drivers.edit');
    Route::put('/{driver}', [DriverController::class, 'update'])->name('admin.drivers.update');
    Route::delete('/{driver}', [DriverController::class, 'destroy'])->name('admin.drivers.destroy');
    Route::post('/{driver}/archive', [DriverController::class, 'archive'])->name('admin.drivers.archive');
    Route::post('/{driver}/restore', [DriverController::class, 'restore'])->name('admin.drivers.restore');
    Route::post('/{driver}/update-status', [DriverController::class, 'updateStatus'])->name('admin.drivers.update-status');
    Route::post('/{driver}/toggle-availability', [DriverController::class, 'toggleAvailability'])->name('admin.drivers.toggle-availability');
    Route::post('/{driver}/force-logout', [DriverController::class, 'forceLogout'])->name('admin.drivers.force-logout');
});

// ===============================
// 🏥 Admin Medics
// ===============================
Route::prefix('admin/medics')->middleware(['auth'])->group(function () {
    Route::get('/', [MedicController::class, 'index'])->name('admin.medics.index');
    Route::get('/archived', [MedicController::class, 'archived'])->name('admin.medics.archived');
    Route::get('/create', [MedicController::class, 'create'])->name('admin.medics.create');
    Route::post('/', [MedicController::class, 'store'])->name('admin.medics.store');
    Route::get('/{id}', [MedicController::class, 'show'])->name('admin.medics.show');
    Route::get('/{id}/edit', [MedicController::class, 'edit'])->name('admin.medics.edit');
    Route::put('/{id}', [MedicController::class, 'update'])->name('admin.medics.update');
    Route::post('/{id}/archive', [MedicController::class, 'archive'])->name('admin.medics.archive');
    Route::post('/{id}/restore', [MedicController::class, 'restore'])->name('admin.medics.restore');
});

// ===============================
// 🔗 Admin Pairing
// ===============================
Route::prefix('admin/pairing')->middleware(['auth'])->group(function () {
    Route::get('/', [PairingController::class, 'index'])->name('admin.pairing.index');
    Route::get('/log', [PairingController::class, 'pairingLog'])->name('admin.pairing.log');
    Route::get('/bulk', [PairingController::class, 'bulkPairing'])->name('admin.pairing.bulk');
    Route::post('/bulk', [PairingController::class, 'storeBulkPairing'])->name('admin.pairing.bulk.store');
    Route::post('/bulk-action', [PairingController::class, 'bulkAction'])->name('admin.pairing.bulk.action');
    Route::post('/group-action', [PairingController::class, 'groupAction'])->name('admin.pairing.group.action');
    
    // Driver-Medic Pairing
    Route::get('/driver-medic/create', [PairingController::class, 'createDriverMedicPairing'])->name('admin.pairing.driver-medic.create');
    Route::post('/driver-medic', [PairingController::class, 'storeDriverMedicPairing'])->name('admin.pairing.driver-medic.store');
    Route::get('/driver-medic/{id}/edit', [PairingController::class, 'editDriverMedicPairing'])->name('admin.pairing.driver-medic.edit');
    Route::put('/driver-medic/{id}', [PairingController::class, 'updateDriverMedicPairing'])->name('admin.pairing.driver-medic.update');
    Route::delete('/driver-medic/{id}', [PairingController::class, 'destroyDriverMedicPairing'])->name('admin.pairing.driver-medic.destroy');
    Route::post('/driver-medic/{id}/complete', [PairingController::class, 'completeDriverMedicPairing'])->name('admin.pairing.driver-medic.complete');
    Route::post('/driver-medic/{id}/cancel', [PairingController::class, 'cancelDriverMedicPairing'])->name('admin.pairing.driver-medic.cancel');
    
    // Driver-Ambulance Pairing
    Route::get('/driver-ambulance/create', [PairingController::class, 'createDriverAmbulancePairing'])->name('admin.pairing.driver-ambulance.create');
    Route::post('/driver-ambulance', [PairingController::class, 'storeDriverAmbulancePairing'])->name('admin.pairing.driver-ambulance.store');
    Route::get('/driver-ambulance/{id}/edit', [PairingController::class, 'editDriverAmbulancePairing'])->name('admin.pairing.driver-ambulance.edit');
    Route::put('/driver-ambulance/{id}', [PairingController::class, 'updateDriverAmbulancePairing'])->name('admin.pairing.driver-ambulance.update');
    Route::delete('/driver-ambulance/{id}', [PairingController::class, 'destroyDriverAmbulancePairing'])->name('admin.pairing.driver-ambulance.destroy');
    Route::post('/driver-ambulance/{id}/complete', [PairingController::class, 'completeDriverAmbulancePairing'])->name('admin.pairing.driver-ambulance.complete');
    Route::post('/driver-ambulance/{id}/cancel', [PairingController::class, 'cancelDriverAmbulancePairing'])->name('admin.pairing.driver-ambulance.cancel');
});



//COLLAB

use App\Http\Controllers\ReportedCasesController;
use App\Http\Controllers\PushNotificationController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/reported-cases', [ReportedCasesController::class, 'index'])
        ->name('reported-cases');
    Route::post('/admin/reports/{id}/status', [ReportedCasesController::class, 'updateStatus'])->name('admin.reports.updateStatus');
});
Route::get('/reverse-geocode', function () {
    $lat = request('lat');
    $lon = request('lon');

    $url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=$lat&lon=$lon";

    $response = Http::withHeaders([
        'User-Agent' => 'Laravel-App'
    ])->get($url);

    return $response->json();
});
Route::post('/send-push', [PushNotificationController::class, 'send']);