@extends('layout')

@section('content')

<form action="/task" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <!-- Task Name -->
    <div class="form-group">
        <label for="task" class="col-sm-3 control-label">Tasks</label>

        <div class="col-sm-6">
            <input type="text" name="name" id="task-name" class="form-control">
        </div>
        <div class="col-sm-6">
          <div class="form-group">
          <label for="project">Project</label>
          <select class="form-control" id="project">
            @foreach ($projects as $project)
            <option>{{$project->name}}</option>
            @endforeach
          </select>
        </div>
        </div>
      </div>
    </div>

    <!-- Add Task Button -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> Add Task
            </button>
        </div>
    </div>
</form>

<div class="container">

@if (count($tasks) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Tasks Logged
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">

            <!-- Table Headings -->
            <thead>
                <th>Task</th>
                <th>Project</th>
                <th>Time Logged</th>
            </thead>

            <!-- Table Body -->
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <!-- Task Name -->
                        <td class="table-text">
                            <div>{{ $task->name }}</div>
                        </td>

                        <td>
                          
                        </td>

                        <td>
                          @if (isset($task->log))
                            {{ $task->log->time_logged }}
                          @else
                            No Time Logged
                          @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
</div>

@endsection
