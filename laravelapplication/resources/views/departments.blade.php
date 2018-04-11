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
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

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
                            <input id="employeesin" type="text" class="form-control" name="employeesin" value="{{ old('employeesin') }}">

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

                        <table id="viewManagerTable" class="table table-striped table-bordered table-hover" style="display:none">
                            <caption id = "viewManagerCaption"> Test</caption>
                            <thead>
                            <tr>
                                <th>Department Id</th>
                                <th>Start Date</th>
                                <th>SIN</th>
                                <th>Name</th>
                                <th>Birth Date</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Salary</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <table id="viewEmployeesTable" class="table table-striped table-bordered table-hover" style="display:none">
                            <caption id = "viewEmployeesCaption"> Test</caption>
                            <thead>
                            <tr>
                                <th>Department Id</th>
                                <th>SIN</th>
                                <th>Name</th>
                                <th>Birth Date</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Salary</th>
                                <th>Gender</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-hover" id="viewProjectTable" style="display:none">
                            <caption id = "viewProjectCaption">Test</caption>
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Total Hours</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Other</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($departments !== null)
                            @foreach($departments as $department)
                                <tr>
                                    <td class = "id">{{$department->id}}</td>
                                    <td>{{$department->name}}</td>
                                    <td id="other">
                                        <button type="button" class="btn btn-link"> View manager </button> <br/>
                                        <button type="button" class="btn btn-link"> View employees </button>
                                        <button type="button" class="btn btn-link"> View projects </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning"> Update </button>
                                        <button class="btn btn-danger"> Delete </button>
                                    </td>
                                </tr>
                            @endforeach
                                @endif
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

            $('#dataTables-example').on('click', '.btn-danger', function (){
                if (confirm('Are you sure?')){
                    var url = '{{route('deleteDepartment')}}';
                    var clickedButton = $(this);
                    var id = $(this).parent().siblings('.id').text();
                    $.ajax({
                        type:'POST',
                        url: url,
                        data:{id: id},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success:function(data){
                            clickedButton.parent().parent().remove();
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }
            });

            $('#dataTables-example').on('click', '.btn-warning', function(){
                var id = $(this).parent().siblings('.id').text();
                $.ajax({
                    type:'GET',
                    url: 'updateDepartment',
                    data:{id: id},
                    success:function(data){
                        $('html').html(data);
                    },
                    error:function (jqXHR, textStatus, errorThrown) {
                        alert(JSON.stringify(jqXHR, null, 2));
                    }
                });
            });

            $('#dataTables-example').on('click', '#other .btn-link', function(){
                $("#viewEmployeesTable").hide();
                $("#viewManagerTable").hide();
                $("#viewProjectsTable").hide();
                if ($(this).text() == " View employees "){
                    var id = $(this).parent().siblings('.id').text();
                    $.ajax({
                        type:'GET',
                        url: 'getDepartmentEmployees',
                        data:{id: id},
                        success:function(employees){
                            $("#viewEmployeesTable").show();
                            $("#viewEmployeesTable td").remove();
                            $("#viewEmployeesCaption").text("Employees for Department ID = " + id);
                            $.each(employees, function(index, employee) {
                                $("#viewEmployeesTable tbody").append(
                                    "<tr><td class = \"id\">" + id + "</td><td>" + employee.SIN + "</td><td>" + employee.name + "</td><td>" + employee.birthDate
                                    + "</td><td>" + employee.phoneNumber + "</td><td>" + employee.address
                                    + "</td><td>" + employee.salary + "</td><td>" + employee.gender + "</td></tr>"
                                );
                            });

                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }

                if ($(this).text() == " View manager "){
                    var id = $(this).parent().siblings('.id').text();
                    $.ajax({
                        type:'GET',
                        url: 'getManager',
                        data:{id: id},
                        success:function(employees){
                            if (!$.trim(employees)){
                                $("#viewManagerTable").show();
                                $("#viewManagerTable td").remove();
                                $("#viewManagerCaption").text("Manager for Department ID = " + id);
                                $("#viewManagerTable tbody").append(
                                    "<tr><td class = \"id\">" + id + "</td><td>" + "" + "</td><td>" + "" + "</td><td>" + "" + "</td><td>" + ""
                                    + "</td><td>" + "" + "</td><td>" + ""
                                    + "</td><td>" + "" + "</td><td>" + ""
                                    + "</td><td><button type=\"button\" id='new_manager' class=\"btn btn-success\"> Add manager </button></td></tr>"
                                );

                            }
                            else{
                                $("#viewManagerTable").show();
                                $("#viewManagerTable td").remove();
                                $("#viewManagerCaption").text("Manager for Department ID = " + id);
                                $.each(employees, function(index, employee) {
                                    $("#viewManagerTable tbody").append(
                                        "<tr><td class = \"id\">" + id + "</td><td>" + employee.startDate + "</td><td>" + employee.SIN + "</td><td>" + employee.name + "</td><td>" + employee.birthDate
                                        + "</td><td>" + employee.phoneNumber + "</td><td>" + employee.address
                                        + "</td><td>" + employee.salary + "</td><td>" + employee.gender
                                        + "</td><td><button type=\"button\" id='update_manager' class=\"btn btn-warning\"> Update Manager </button><br/><br/>"
                                        + "<button type=\"button\" id='remove_manager' class=\"btn btn-danger\"> Remove manager </td></tr>"
                                    );
                                });
                            }
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }

                if ($(this).text() == " View projects "){
                    var id = $(this).parent().siblings('.id').text();
                    $.ajax({
                        type:'GET',
                        url: 'getDepartmentProjects',
                        data:{id: id},
                        success:function(projects){
                            $("#viewProjectTable").show();
                            $("#viewProjectTable td").remove();
                            $("#viewProjectCaption").text("Projects for Department ID = " + id);
                            $.each(projects, function(index, project) {
                                $("#viewProjectTable tbody").append(
                                    "<tr><td>" + project.id + "</td><td>" + project.name + "</td><td>" + project.location + "</td><td>"
                                    + project.totalHours + "</td></tr>"
                                )
                            });
                            $("#viewTotalPayTable tbody").append(
                                "<tr class='totalHoursRow'><td><b> Total Pay </b></td><td class='totalHours'>" + results[1][0].totalHours + "</td><td></td><td></td></tr>"
                            )
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }

            });

            $('#viewManagerTable').on('click', '#update_manager.btn-warning', function(){
                var id = $(this).parent().siblings('.id').text();
                $.ajax({
                    type:'GET',
                    url: 'updateDepartmentManager',
                    data:{id: id},
                    success:function(data){
                        $('html').html(data);
                    },
                    error:function (jqXHR, textStatus, errorThrown) {
                        alert(JSON.stringify(jqXHR, null, 2));
                    }
                });
            });

            $('#viewManagerTable').on('click', '#new_manager.btn-success', function(){
                var id = $(this).parent().siblings('.id').text();
                $.ajax({
                    type:'GET',
                    url: 'createDepartmentManager',
                    data:{id: id},
                    success:function(data){
                        $('html').html(data);
                    },
                    error:function (jqXHR, textStatus, errorThrown) {
                        alert(JSON.stringify(jqXHR, null, 2));
                    }
                });
            });

            $('#viewManagerTable').on('click', '#remove_manager.btn-danger', function(){
                if (confirm('Are you sure?')) {
                    var clickedButton = $(this);
                    var id = $(this).parent().siblings('.id').text();
                    $.ajax({
                        type:'POST',
                        url: 'removeDepartmentManager',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id: id},
                        success:function(data){
                            clickedButton.parent().parent().remove();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }
            });

        });
    </script>
@endsection