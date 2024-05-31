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

    public function test_post_new_user(){

        $response =$this->post('register',[
            'name'=>'handa',
            'email'=>'handa@gmail.com',
            'password'=>'123456789',
            'role'=>'user'
        ]);

        $response->assertRedirect('/');
    }

    public function test_database(){
        $this->assertDatabaseHas('users',[
            'name'=>'Nyraa Reda'
        ]);
    }

    public function test_seeders(){
        $this->seed();
        
    }
}
