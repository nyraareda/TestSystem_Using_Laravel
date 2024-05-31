<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserLoginTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_user_login_form(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/login');
        $response->assertStatus(302);

    }

    public function test_user_validation(): void
    {
        $user1 = User::make([
            'name' => "nyraa reda",
            'email' => "nyraa@gmail.com"
        ]);
        $user2 = User::make([
            'name' => "esraa reda",
            'email' => "esraa@gmail.com"
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }
}
