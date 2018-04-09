@extends('departments-base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update department manager</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{route('updateDepartmentManagerInDatabase')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Id</label>
                                <div class="col-md-6">
                                    <input id="id" type="text" class="form-control" name="id" value="{{ $manages->departmentID }}" readonly>

                                    @if ($errors->has('id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('employeesin') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Manager SIN</label>
                                <div class="col-md-6">
                                    <input id="employeesin" type="text" class="form-control" name="employeesin" value="{{ $manages->employeeSIN }}" required>
                                    @if ($errors->has('employeesin'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('employeesin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Start Date</label>
                                <div class="col-md-6">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" value="{{ $manages->startDate }}" name="startdate" class="form-control pull-right" id="startdate" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update department manager
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection