<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;


class StatisticsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_statistics(): void
    {
        $users = User::factory(10)->create(['role' => 'user']);
        $admin = User::factory()->create(['role' => 'admin']);

        foreach ($users as $user) {
            Task::factory(10)->create(['assigned_to_id' => $user->id, 'assigned_by_id' => $admin->id]);
        }

        $this->actingAs($admin)
            ->get('/statistics/top')
            ->assertStatus(200);
    }
}
