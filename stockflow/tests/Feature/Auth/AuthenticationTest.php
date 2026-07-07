<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_renders(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page->component('Auth/Login'));
    }

    public function test_users_can_authenticate_with_valid_credentials(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard');
    }

    public function test_users_cannot_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    /**
     * A wrong password and a non-existent email must produce the identical
     * error (same key, same generic message) so a caller can't distinguish
     * "no such account" from "wrong password" for a real one.
     */
    public function test_invalid_credentials_do_not_leak_which_field_was_wrong(): void
    {
        $user = User::factory()->create();

        $wrongPassword = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $unknownEmail = $this->from('/login')->post('/login', [
            'email' => 'nobody@stockflow.test',
            'password' => 'wrong-password',
        ]);

        $wrongPassword->assertSessionHasErrors(['email' => __('auth.failed')]);
        $unknownEmail->assertSessionHasErrors(['email' => __('auth.failed')]);

        $this->assertGuest();
    }

    public function test_authenticated_users_can_log_out(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/dashboard')->assertOk();

        $response = $this->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/login');

        // The session must be fully invalidated, not just logged out of the
        // guard: a previously authenticated request to a protected route
        // must now be rejected.
        $this->get('/dashboard')->assertRedirect('/login');
    }
}
