@extends('layout')

@section('content')

        <div class="panel-body">
            <!-- Display Validation Errors -->


        </div>
        <hr>
        <div class="container">

        <form action="/log" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Log Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Log Task
                    </button>
                </div>
            </div>

              <div class="form-group">
              <label for="project">Task</label>
              <select class="form-control" name="task" id="task">
                <option >...</option>
                @foreach ($tasks as $task)
                  <option value="{{$task->id}}">{{$task->name}}</option>
                @endforeach
              </select>
            </div>

        </form>
      </div>
        <br>
        <br>

        <hr>
        <hr>

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
                                    <!-- TODO: Show logged time -->
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
