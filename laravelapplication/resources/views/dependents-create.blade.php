@extends('dependents-base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add new dependent</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{route('createDependent')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('dependentsin') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Dependent SIN</label>

                                <div class="col-md-6">
                                    <input id="dependentsin" type="text" class="form-control" name="dependentsin" required>

                                    @if ($errors->has('dependentsin'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('dependentsin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('employeesin') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Employee SIN</label>

                                <div class="col-md-6">
                                    <input id="employeesin" type="text" class="form-control" name="employeesin" required>

                                    @if ($errors->has('employeesin'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('employeesin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Gender</label>
                                <div class="col-md-6">
                                    <select class="form-control js-states" name="gender" id = "gender" required>
                                        <option value="-1">Select gender</option>
                                        <option value="F">F</option>
                                        <option value="M">M</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Birth Date</label>
                                <div class="col-md-6">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="birthdate" class="form-control pull-right" id="birthdate" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create new dependent
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