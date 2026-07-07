<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class LoginController extends Controller
{
    public function __construct(private readonly AuthService $authService) {}

    /**
     * Show the login page.
     *
     * FR-1.1: session (`web` guard) login for all human UI.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Authenticate the request and establish a session.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $this->authService->login($request);

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy the session (FR-1.2).
     */
    public function destroy(Request $request): RedirectResponse
    {
        $this->authService->logout($request);

        return redirect()->route('login');
    }
}
