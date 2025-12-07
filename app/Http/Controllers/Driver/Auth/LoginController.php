<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Driver;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('driver.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('driver')->attempt($credentials)) {
            /** @var Driver $driver */
            $driver = Auth::guard('driver')->user();
            if ($driver) {
                $driver->setAvailabilityStatus('online');
                
                // Log successful login
                \App\Models\LoginLog::create([
                    'user_type' => 'driver',
                    'user_id' => $driver->id,
                    'email' => $driver->email,
                    'name' => $driver->name,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'login_at' => now(),
                    'success' => true,
                ]);
            }
            return redirect()->intended('/driver/send-location');
        }

        // Log failed login attempt
        \App\Models\LoginLog::create([
            'user_type' => 'driver',
            'user_id' => null,
            'email' => $request->input('email'),
            'name' => null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'login_at' => now(),
            'success' => false,
            'failure_reason' => 'Invalid credentials',
        ]);

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        // Driver-initiated logout disabled; only admin can log out drivers
        abort(403, 'Driver logout is disabled. Please contact admin.');
    }
}
