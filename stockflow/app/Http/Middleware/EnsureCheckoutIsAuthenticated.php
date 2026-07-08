<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * The /checkout entry gate (Guest rule #18). Applied to both GET and POST
 * /checkout, ahead of `throttle:checkout` in the middleware stack, so a
 * guest never reaches StoreCheckoutRequest::authorize() — that method
 * assumes an authenticated user ($this->user()->can(...)) and would throw
 * on a null user rather than redirect. Kept as a dedicated middleware
 * rather than a wrapper controller so CheckoutController's create()/
 * store() logic is never duplicated: once this gate passes, the existing
 * CheckoutController (and its own `sale.create` policy check) is
 * unchanged. Gives a specific flash message, unlike the default `auth`
 * middleware's silent redirect, so a guest who's been browsing anonymously
 * understands why they landed on the login page.
 *
 * Uses redirect()->guest() (not a plain redirect()->route()) specifically
 * so the intended /checkout URL is stored in the session the same way
 * Laravel's built-in `auth` middleware does — LoginController::store() and
 * RegisterController::store() both call redirect()->intended(...) after
 * authenticating, so a guest bounced from here lands back on /checkout
 * (not just /dashboard) once they log in or register.
 */
class EnsureCheckoutIsAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->guest(route('login'))->with('flash.error', 'Please log in to complete your order.');
        }

        return $next($request);
    }
}
