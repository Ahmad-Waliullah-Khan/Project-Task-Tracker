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
use App\Log;
use Illuminate\Http\Request;

/**
 * Dashboard
 */
 Route::get('/', function () {
    $log = Log::where('task_id', '=', 0)
         ->first();
    $tasks = Task::orderBy('updated_at', 'desc')->get();

     return view('welcome', [
         'log' => $log,
         'tasks' => $tasks,
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

  if (session('task_being_tracked') !=null) {

    $log = Log::where('task_id', '=', session('task_being_tracked'))
        ->first();

    $log->completed_on = Carbon\Carbon::now();
    $log->save();

    $log = Log::where('task_id', '=', session('task_being_tracked'))
        ->first();

    $completed_on = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $log->completed_on);
    $started_on = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $log->started_on);

    $log->time_logged = $completed_on->diffInMinutes($started_on);

    $log->save();

    session(['task_being_tracked' => null]);

    }
    else {
      session(['task_being_tracked' => $request->input('task')]);

      $log = Log::where('task_id', '=', $request->input('task'))
          ->first();

      if ($log == null) {
        $log = new Log;
        $log->started_on = Carbon\Carbon::now();
        $log->completed_on = Carbon\Carbon::now();
        $log->task_id = $request->input('task');
        $log->time_logged = 0;
        $log->save();
      } else {
        $log->started_on = Carbon\Carbon::now();
        $log->save();
      }

  }

   return redirect('/');
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
