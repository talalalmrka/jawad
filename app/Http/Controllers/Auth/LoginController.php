<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    /**
     * Show the application's login form.
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $this->ensureIsNotRateLimited();
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:4', 'max:255'],
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (!Auth::attempt($credentials, $remember)) {
            RateLimiter::hit($this->throttleKey());
            return back()
                ->withErrors([
                    'status' => __(__('Invalid Login')),
                ]);
        } else {
            session()->regenerate();
            return redirect()->intended(route('dashboard'))
                ->with('status', __('Login succeed.'));
        }


    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            throw ValidationException::withMessages([
                'status' => __('Too many attemps retry after :seconds seconds', [
                    'seconds' => RateLimiter::availableIn($this->throttleKey()),
                ])
            ]);
        }
    }

    public function throttleKey()
    {
        return 'email' . '|' . request()->ip();
    }
}