<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Statistics;

class StatisticController extends Controller
{
    //Get all statstics-> all student have tasks
    public function index(){
        $statistics = Statistics::with('user')->get();
        $statistics=Statistics::simplePaginate(15);
        return view('statistics.index',compact('statistics'),["statistics" => $statistics]);
    }
    //Get statstics-> only top 10 task count of student
     public function topUsersIndex(){
     $topUsers = User::withCount('assignedTasks')->orderByDesc('assigned_tasks_count')->take(10)->get();
     return view('statistics.top', compact('topUsers'));
}
}
