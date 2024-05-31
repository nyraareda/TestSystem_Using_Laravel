<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;


class UserLoginTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function user_login_form(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/login');
    }
}
