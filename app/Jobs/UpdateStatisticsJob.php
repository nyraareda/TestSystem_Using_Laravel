<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Statistics;
use Illuminate\Support\Facades\DB;

class UpdateStatisticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    /**
     * Create a new job instance.
     */
    public function __construct($userId)
    {
        $this->userId=$userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
            // Count the total number of tasks assigned to the user
            $taskCount = DB::table('tasks')->where('assigned_to_id', $this->userId)->count();
        
            // Check if statistics record exists for the user
            $statistics = Statistics::where('user_id', $this->userId)->first();
        
            if ($statistics) {
                // Update task count
                $statistics->task_count = $taskCount;
                $statistics->save();
            } else {
                // Create new statistics record
                Statistics::create([
                    'user_id' => $this->userId,
                    'task_count' => $taskCount,
                ]);
            }
        
    }
}
