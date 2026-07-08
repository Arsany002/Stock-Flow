<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
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
     * Public self-registration: always creates a Retail Customer, never
     * any other role — there is no role input to this method at all, by
     * design (see RegisterRequest's docblock). Logs the new user in and
     * regenerates the session exactly like login() does, so a
     * self-registered user gets the same session-fixation protection.
     * Deliberately does NOT touch the cart: it's plain Laravel session
     * state under a different key (CartService::SESSION_KEY), so
     * regenerating the session ID here carries it over for free — the
     * same mechanism that already makes the cart survive a login.
     */
    public function register(RegisterRequest $request): User
    {
        $user = User::query()->create($request->registrationData());
        $user->addRole(UserRole::RetailCustomer->value);

        Auth::login($user);
        $request->session()->regenerate();

        return $user;
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
