<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class TaskCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_task_creation()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $user = User::factory()->create([
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);

        $this->actingAs($admin);

        $response = $this->post('/tasks', [
            'title' => 'test task1',
            'description' => 'desc for test task1',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'title' => 'test task1',
            'description' => 'desc for test task1',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id,
        ]);

        $response->assertViewIs('tasks.index');
    }
}
