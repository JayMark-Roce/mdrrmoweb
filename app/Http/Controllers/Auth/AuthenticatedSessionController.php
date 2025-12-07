<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        try {
            $request->authenticate();
            
            $user = Auth::user();
            
            // Log successful login
            \App\Models\LoginLog::create([
                'user_type' => 'admin',
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'login_at' => now(),
                'success' => true,
            ]);

            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log failed login attempt
            \App\Models\LoginLog::create([
                'user_type' => 'admin',
                'user_id' => null,
                'email' => $request->input('email'),
                'name' => null,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'login_at' => now(),
                'success' => false,
                'failure_reason' => $e->getMessage(),
            ]);
            
            throw $e;
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
