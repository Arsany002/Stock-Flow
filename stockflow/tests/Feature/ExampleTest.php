<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * / is the public storefront home page — guests no longer get bounced
     * to /login, see the storefront requirements' Guest rule #1. Superseded
     * the previous "guests are redirected to login" expectation.
     */
    public function test_guests_can_view_the_home_page(): void
    {
        $response = $this->get('/');

        $response->assertOk();
    }
}
