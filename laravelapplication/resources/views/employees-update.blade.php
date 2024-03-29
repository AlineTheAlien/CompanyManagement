@extends('employees-base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update employee</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{route('updateEmployeeInDatabase')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('sin') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">SIN</label>

                                <div class="col-md-6">
                                    <input id="sin" type="text" class="form-control" name="sin" value="{{$employee->SIN}}" readonly>

                                    @if ($errors->has('sin'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('sin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Department</label>
                                <div class="col-md-6">
                                    <select class="form-control js-states" name="department_id">
                                        <option value="{{$employee->departmentID}}">{{$employee->departmentName}}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{$department->id}}" name="department" id="department">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $employee->name }}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Birth Date</label>
                                <div class="col-md-6">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" value="{{ $employee->birthDate }}" name="birthdate" class="form-control pull-right" id="birthDate">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('phonenumber') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Phone Number</label>

                                <div class="col-md-6">
                                    <input id="phonenumber" type="text" class="form-control" name="phonenumber" value="{{ $employee->phoneNumber }}">

                                    @if ($errors->has('phonenumber'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phonenumber') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ $employee->address }}">

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('salary') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Salary</label>

                                <div class="col-md-6">
                                    <input id="salary" type="text" class="form-control" name="salary" value="{{ $employee->salary }}">

                                    @if ($errors->has('salary'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Gender</label>
                                <div class="col-md-6">
                                    <select class="form-control js-states" name="gender">
                                        <option value="-1">Select gender</option>
                                        @if ($employee->gender == "M")
                                        <option selected value="M">M</option>
                                        <option value="F">F</option>
                                        @endif
                                        @if ($employee->gender == "F")
                                        <option value="M">M</option>
                                        <option selected value="F">F</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update employee
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