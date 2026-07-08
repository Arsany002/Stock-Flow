<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Public Retail Customer self-registration. Guest-only — the `guest`
 * route middleware (routes/web.php) already redirects an authenticated
 * visitor to /dashboard before this controller ever runs, so there's no
 * separate check needed here for that rule.
 */
class RegisterController extends Controller
{
    public function __construct(
        private readonly AuthService $authService,
        private readonly CartService $cart,
    ) {}

    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $this->authService->register($request);

        // Same "where should this person land" logic as login: prefer
        // wherever they were trying to go (e.g. /checkout, stored by
        // EnsureCheckoutIsAuthenticated's redirect()->guest()), then
        // checkout if they have something in the cart already, otherwise
        // the dashboard.
        if ($request->session()->has('url.intended')) {
            return redirect()->intended(route('dashboard'));
        }

        if (! $this->cart->isEmpty()) {
            return redirect()->route('checkout.create');
        }

        return redirect()->route('dashboard');
    }
}
