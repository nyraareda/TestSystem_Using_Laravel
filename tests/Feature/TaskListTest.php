<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
class TaskListTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /** @test */
    use RefreshDatabase;
    public function task_list()
    {

        $user=User::factory()->create(['role'=>'user']);
        $admin=User::factory()->create(['role'=>'admin']);

        Task::factory()->create([
            'title' => 'TaskList test1',
            'description' => 'desc for TaskList test1',
            'assigned_to_id' => $user->id,
            'assigned_by_id' => $admin->id,
        ]);
        $response=$this->actingAs($user)->get('/tasks');
        $response->assertStatus(200)
        ->assertSee('TaskList test1');

        // $response = $this->get('/');

        // $response->assertStatus(200);
    }
}
