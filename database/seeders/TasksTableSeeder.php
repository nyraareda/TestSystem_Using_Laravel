<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Statistics; // Add this line to import the Statistics model

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $userIds = DB::table('users')->pluck('id')->toArray();

        foreach (range(1, 100) as $index) {
            // Choose a random user ID from the available user IDs for both assigned_to_id and assigned_by_id
            $assignedToId = $faker->randomElement($userIds);
            $assignedById = $faker->randomElement($userIds);
            DB::table('tasks')->insert([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'assigned_to_id' => $assignedToId,
                'assigned_by_id' => $assignedById,
                'created_at' => now(),
                'updated_at' => now(),
                // Add other columns as necessary
            ]);

            // Update statistics for assigned_to_id
            $this->updateStatistics($assignedToId);
        }
    }

    /**
     * Update statistics for the given user ID.
     */
    private function updateStatistics($userId)
{
    // Count the total number of tasks assigned to the user
    $taskCount = DB::table('tasks')->where('assigned_to_id', $userId)->count();

    // Check if statistics record exists for the user
    $statistics = Statistics::where('user_id', $userId)->first();

    if ($statistics) {
        // Update task count
        $statistics->task_count = $taskCount;
        $statistics->save();
    } else {
        // Create new statistics record
        Statistics::create([
            'user_id' => $userId,
            'task_count' => $taskCount,
        ]);
    }
}
}
