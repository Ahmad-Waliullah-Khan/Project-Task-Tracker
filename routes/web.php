<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Task;
use App\Project;
use App\Timer;
use Illuminate\Http\Request;

/**
 * Dashboard
 */
 Route::get('/', function () {
     $tasks = Task::orderBy('created_at', 'desc')->get();

     return view('welcome', [
         'tasks' => $tasks
     ]);
 });

 /**
  * Add a project
  */
 Route::post('/project', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $project = new Project;
    $project->name = $request->name;
    $project->save();

    return redirect('/projects');
});

/**
 * Add a new task
 */
Route::post('/task', function (Request $request) {
   $validator = Validator::make($request->all(), [
       'name' => 'required|max:255',
   ]);

   if ($validator->fails()) {
       return redirect('/')
           ->withInput()
           ->withErrors($validator);
   }

   $project = new Task;
   $project->name = $request->name;
   $project->save();

   return redirect('/tasks');
});

Route::post('/log', function (Request $request) {

  session(['task_being_tracked' => $request->input('task')]);

   $timer = new Timer;
   $timer->started_on = Carbon\Carbon::now();
   // $timer->task_id = $request->input('task')
   $timer->save();
});

/**
 * Display all projects
 */
 Route::get('/projects', function () {
     $projects = Project::orderBy('created_at', 'desc')->get();

     return view('projects', [
         'projects' => $projects
     ]);
 });

 /**
  * Display all tasks
  */
 Route::get('/tasks', function () {
   $projects = Project::orderBy('created_at', 'desc')->get();
   $tasks = Task::orderBy('created_at', 'desc')->get();

   return view('tasks', [
       'projects' => $projects,
       'tasks' => $tasks,
   ]);
 });
