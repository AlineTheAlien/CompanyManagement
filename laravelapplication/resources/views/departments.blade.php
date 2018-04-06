@extends('departments-base')

@section('action-content')
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List of departments
                </div>
                <div class="panel-body" align="right">
                    <a href="departments-create">
                        <button type="button" id="new-department" class="btn btn-success">Add new department</button>
                    </a>
                </div>

                <form class="form-horizontal" role="form" method="GET" action = "{{route('searchDepartment')}}" enctype="multipart/form-data">
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
                    <div class="form-group{{ $errors->has('employeesin') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-1 control-label">Manager SIN</label>
                        <div class="col-md-2">
                            <input id="employeesin" type="text" class="form-control" name="employeesin" value="{{ old('employeesin') }}" autofocus>

                            @if ($errors->has('employeesin'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('employeesin') }}</strong>
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
                                <th>Name</th>
                                <th>Manager</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td class = "id">{{$department->id}}</td>
                                    <td>{{$department->name}}</td>
                                    <td>
                                        <button type="button" class="btn btn-link">View manager</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning"> Update </button>
                                        <button class="btn btn-danger"> Delete </button>
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

@endsection
