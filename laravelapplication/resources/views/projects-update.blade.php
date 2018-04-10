@extends('projects-base')

@section('action-content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update project</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{route('updateProjectInDatabase')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Id</label>

                                <div class="col-md-6">
                                    <input id="id" type="text" class="form-control" name="id" value="{{$project->id}}" required>

                                    @if ($errors->has('id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$project->name}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                <label for="location" class="col-md-4 control-label">Location</label>

                                <div class="col-md-6">
                                    <input id="location" type="text" class="form-control" name="location" value="{{$project->location}}" required autofocus>

                                    @if ($errors->has('location'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Department</label>
                                <div class="col-md-6">
                                    <select class="form-control js-states" name="department_id">
                                        @foreach ($departments as $department)
                                            @if($department->id == $project->departmentID)
                                                <option value="{{$department->id}}" name="department" id="department">{{$department->name}}</option>
                                            @endif
                                        @endforeach
                                        @foreach ($departments as $department)
                                            <option value="{{$department->id}}" name="department" id="department">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('stage') ? ' has-error' : '' }}">
                                <label for="stage" class="col-md-4 control-label">Stage</label>

                                <div class="col-md-6">
                                    <select class="form-control js-states" name="stage">

                                        <option value="{{$project->stage}}">{{$project->stage}}</option>
                                        <option value="preliminary">preliminary</option>
                                        <option value="intermediate">intermediate</option>
                                        <option value="advanced">advanced</option>
                                        <option value="complete">complete</option>
                                    </select>

                                    @if ($errors->has('stage'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('stage') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label class="col-md-1 control-label">Stage</label>--}}
                                {{--<div class="col-md-2">--}}
                                    {{--<select class="form-control js-states" name="stage">--}}
                                        {{--<option value="-1">Select stage</option>--}}
                                        {{--<option value="preliminary">Preliminary</option>--}}
                                        {{--<option value="intermediate">Intermediate</option>--}}
                                        {{--<option value="advanced">Advanced</option>--}}
                                        {{--<option value="complete">Complete</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update project
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