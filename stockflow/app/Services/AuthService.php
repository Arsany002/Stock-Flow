<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Session (`web` guard) authentication for the human Inertia UI.
 *
 * @see docs/project/canonical-decisions.md §3 — session auth for humans,
 *      Passport is reserved exclusively for the external B2B API.
 */
class AuthService
{
    /**
     * Attempt to authenticate the request and establish a session.
     *
     * @throws ValidationException when credentials don't match.
     */
    public function login(LoginRequest $request): void
    {
        if (! Auth::attempt($request->credentials(), $request->remember())) {
            // Deliberately generic: does not reveal whether the email exists
            // or the password was wrong (FR-1.1 / US-1.1 non-leaking AC).
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();
    }

    /**
     * Log the current user out and fully invalidate the session.
     */
    public function logout(Request $request): void
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
