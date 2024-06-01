<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Statistics;
use App\Http\Requests\TaskStoreRequest;
use App\Jobs\UpdateStatisticsJob;


class TaskController extends Controller
{

    function index(){
        $tasks=Task::all();
        $tasks=Task::simplePaginate(10);
        return view('tasks.index',["tasks" => $tasks]);
     }

    public function create()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            return redirect('/tasks')->with('error', 'You are not authorized to create tasks.');
        }
        $users = User::where('role', 'user')->get();
        
        return view('tasks.create', compact('users'));
    }

    public function store(TaskStoreRequest $request){
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->assigned_to_id = $request->assigned_to_id;
        $task->assigned_by_id = Auth::id();
    
        $task->save();
    
        // DB::transaction(function () use ($task) {
        //     $userId = $task->assigned_to_id;
        //     $statistic = Statistics::firstOrCreate(
        //         ['user_id' => $userId],
        //         ['task_count' => 0]
        //     );
    
        //     $statistic->task_count++;
        //     $statistic->save();
        // });
        UpdateStatisticsJob::dispatch($task->assigned_to_id);

        $tasks = Task::simplePaginate(10);
        return view('tasks.index', ["tasks" => $tasks]);
    }
    
}
