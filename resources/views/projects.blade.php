@extends('layout')

@section('content')

<form action="/project" method="POST" class="form-horizontal">
    {{ csrf_field() }}

    <!-- Task Name -->
    <div class="form-group">
        <label for="task" class="col-sm-3 control-label">Project</label>

        <div class="col-sm-6">
            <input type="text" name="name" id="task-name" class="form-control">
        </div>
    </div>

    <!-- Add Task Button -->
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> Add Project
            </button>
        </div>
    </div>
</form>

<hr>
@if (count($projects) > 0)
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading">
        Projects
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">

            <!-- Table Headings -->
            <thead>
                <th>Project</th>
                <th>Created At</th>
            </thead>

            <!-- Table Body -->
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <!-- Task Name -->
                        <td class="table-text">
                            <div>{{ $project->name }}</div>
                        </td>

                        <td>
                            {{ $project->created_at }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endif

@endsection
