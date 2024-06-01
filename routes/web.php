<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\StatisticController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('tasks', TaskController::class)->middleware('auth');
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/statistics', [StatisticController::class, 'index'])->middleware('auth');
Route::get('/statistics/top', [StatisticController::class, 'topUsersIndex'])->middleware('auth');
Route::get('/tasks', [TaskController::class, 'index'])->middleware('auth');

