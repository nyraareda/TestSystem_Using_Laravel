<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Statistics;

class StatisticController extends Controller
{
    // public function index(){

    //     $users = User::withCount('assignedTasks')->get();

    //     foreach($users as $user){
    //         $statistic = new Statistics;
    //         $statistic->user_id = $user->id;
    //         $statistic->task_count = $user->assigned_tasks_count;
    //         $statistic->save();

    //         return view('statistics.index', compact('users'));

    //     }
    // }
    // public function index(){

    //     $users = User::withCount('assignedTasks')->get();
    
    //     foreach($users as $user){
    //         $statistic = new Statistics;
    //         $statistic->user_id = $user->id;
    //         $statistic->task_count = $user->assigned_tasks_count;
    //         $statistic->save();
    //     }
        
    
    //     return view('statistics.index', compact('users'));
    // }
     public function index(){
        $statistics = Statistics::with('user')->get();

        // Return the statistics view with the statistics data
        return view('statistics.index', compact('statistics'));
     }
}
