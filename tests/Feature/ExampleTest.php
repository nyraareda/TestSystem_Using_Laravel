<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    use RefreshDatabase;
    public function test_the_application_returns_a_successful_response(): void
    {
        $user = User::factory()->create();

        // Make authenticated request
        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }
}
