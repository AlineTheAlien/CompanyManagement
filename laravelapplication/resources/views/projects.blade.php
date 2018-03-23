@extends('projects-base')

@section('action-content')
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List of projects
                </div>
                <div class="panel-body" align="right">
                    <a href="createProject">
                        <button type="button" id="new-project" class="btn btn-success">Add new project</button>
                    </a>
                </div>

                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                    <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                        <label class="col-md-1 control-label">Id</label>

                        <div class="col-md-1">
                            <input id="id" type="text" class="form-control" name="id" value="{{ old('id') }}">

                            @if ($errors->has('id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1 control-label">Department</label>
                        <div class="col-md-2">
                            <select class="form-control js-states" name="department_id">
                                <option value="-1">Select department</option>
                                {{--  @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach  --}}
                            </select>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-1 control-label">Name</label>
                        <div class="col-md-2">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                        <label for="location" class="col-md-1 control-label">Location</label>
                        <div class="col-md-2">
                            <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" autofocus>

                            @if ($errors->has('location'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-1 col-md-offset-1">
                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Department</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Employees assigned</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{$project->id}}</td>
                                    <td>{{$project->departmentId}}</td>
                                    <td>{{$project->name}}</td>
                                    <td>{{$project->location}}</td>
                                    <td>
                                        <!-- Need unique IDs for each button -->
                                        <button type="button" class="btn btn-link">View employees</button>
                                    </td>
                                    <td>
                                        {{--
                                        route doesn't work...
                                        <form class="row" method="POST" action="{{ route('destroyEmployee', ['sin' => $employee->SIN]) }}" onsubmit = "return confirm('Are you sure?')">
                                        <a href="{{ route('destroyEmployee', ['sin' => $employee->SIN]) }}" class="btn btn-warning">
                                           --}}
                                        <form method="POST" action="" onsubmit = "return confirm('Are you sure?')">
                                            <a href="updateProject" class="btn btn-warning">
                                                Update
                                            </a>
                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
@endsection
