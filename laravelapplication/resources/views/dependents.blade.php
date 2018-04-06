@extends('dependents-base')

@section('action-content')
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    List of dependents
                </div>
                <div class="panel-body" align="right">
                    <a href="createDependent">
                        <button type="button" id="new-dependent" class="btn btn-success">Add new dependent</button>
                    </a>
                </div>

                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                    <div class="form-group{{ $errors->has('dependentsin') ? ' has-error' : '' }}">
                        <label class="col-md-1 control-label">Dependent SIN</label>

                        <div class="col-md-1">
                            <input id="sin" type="text" class="form-control" name="dependentsin" value="{{ old('dependentsin') }}">

                            @if ($errors->has('dependentsin'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('dependentsin') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('employeesin') ? ' has-error' : '' }}">
                        <label class="col-md-1 control-label">Employee SIN</label>

                        <div class="col-md-1">
                            <input id="sin" type="text" class="form-control" name="employeesin" value="{{ old('employeesin') }}">

                            @if ($errors->has('employeesin'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('employeesin') }}</strong>
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
                    <div class="form-group">
                        <label class="col-md-1 control-label">Gender</label>
                        <div class="col-md-2">
                            <select class="form-control js-states" name="state_id">
                                <option value="-1">Select gender</option>
                                <option value="F">F</option>
                                <option value="M">M</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-1 control-label">Birth Date</label>
                        <div class="col-md-2">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" name="birthdate" class="form-control pull-right" id="birthDate">
                            </div>
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
                                <th>Dependent SIN</th>
                                <th>Employee SIN</th>
                                <th>Name</th>
                                <th>Gender/th>
                                <th>BirthDate</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dependents as $dependent)
                                <tr>
                                    <td class="dependentSIN">{{$dependent->dependentSIN}}</td>
                                    <td>{{$dependent->employeeSIN}}</td>
                                    <td>{{$dependent->name}}</td>
                                    <td>{{$dependent->gender}}</td>
                                    <td>{{$dependent->birthDate}}</td>
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
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });

            $('.btn-danger').on('click', function (){
                if (confirm('Are you sure?')){
                    var url = '{{route('deleteDependent')}}';
                    var clickedButton = $(this);
                    var SIN = $(this).parent().siblings('.dependentSIN').text();
                    $.ajax({
                        type:'GET',
                        url: url,
                        data:{dependentSIN: SIN},
                        success:function(data){
                            clickedButton.parent().parent().remove();
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }
            });

            $('.btn-warning').on('click', function(){
                var SIN = $(this).parent().siblings('.dependentSIN').text();
                $.ajax({
                    type:'GET',
                    url: 'updateDependent',
                    data:{dependentSIN: SIN},
                    success:function(data){
                        $('html').html(data);
                    },
                    error:function (jqXHR, textStatus, errorThrown) {
                        alert(JSON.stringify(jqXHR, null, 2));
                    }
                });
            });

        });
    </script>
@endsection