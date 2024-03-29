@extends('employees-base')

@section('action-content')
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                List of employees
            </div>
            <div class="panel-body" align="right">
                <a href="employees-create">
                    <button type="button" id="new-employee" class="btn btn-success">Add new employee</button>
                </a>
            </div>

            <form class="form-horizontal" role="form" method="GET" action="{{route('searchEmployee')}}" enctype="multipart/form-data">
                <div class="form-group{{ $errors->has('sin') ? ' has-error' : '' }}">
                    <label class="col-md-1 control-label">SIN</label>

                    <div class="col-md-1">
                        <input id="sin" type="text" class="form-control" name="sin" value="{{ old('sin') }}">

                        @if ($errors->has('sin'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('sin') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">Department</label>
                    <div class="col-md-2">
                        <select class="form-control js-states" name="department_id">
                            <option value="-1">Select department</option>
                              @foreach ($departments as $department)
                                <option value="{{$department->id}}" name="department" id="department">{{$department->name}}</option>
                            @endforeach
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
                <div class="form-group{{ $errors->has('salary') ? ' has-error' : '' }}">
                    <label class="col-md-1 control-label">Salary</label>
                    <div class="col-md-2">
                        <select class="form-control js-states" name="Salary">
                            <option value="-1">Select range</option>
                            <option value="range1"><$30,000</option>
                            <option value="range2">$30,000 to $50,000</option>
                            <option value="range3">>$50,000 to $100,000</option>
                            <option value="range3">>$100,000</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">Gender</label>
                    <div class="col-md-2">
                        <select class="form-control js-states" name="gender" id = "gender">
                            <option value="-1">Select gender</option>
                            <option value="F">F</option>
                            <option value="M">M</option>
                        </select>
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
                    <table class="table table-striped table-bordered table-hover" id="viewDependentTable" style="display:none">
                        <caption id = "viewDependentCaption">Test</caption>
                        <thead>
                        <tr>
                            <th>Dependent SIN</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>BirthDate</th>
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
                            <th>Hours</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <table class="table table-striped table-bordered table-hover" id="viewSupervisorTable" style="display:none">
                        <caption id = "viewSupervisorCaption">Test</caption>
                        <thead>
                        <tr>
                            <th>SIN</th>
                            <th>Name</th>
                            <th>Birth Date</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Salary</th>
                            <th>Gender</th>
                            <th>Department ID</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>SIN</th>
                            <th>Name</th>
                            <th>Birth Date</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Salary</th>
                            <th>Gender</th>
                            <th>Department ID</th>
                            <th>Other</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($employees !== null)
                        @foreach($employees as $employee)
                            <tr>
                                <td class="SIN">{{$employee->SIN}}</td>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->birthDate}}</td>
                                <td>{{$employee->phoneNumber}}</td>
                                <td>{{$employee->address}}</td>
                                <td>{{$employee->salary}}</td>
                                <td>{{$employee->gender}}</td>
                                <td>{{$employee->departmentID}}</td>
                                <td id="dependents">
                                    <!-- Need unique IDs for each button -->
                                    <button type="button" class="btn btn-link">View dependents</button>
                                    <button type="button" class="btn btn-link">View supervisor</button>
                                    <button type="button" class="btn btn-link">View subordinates</button>
                                    <button type="button" class="btn btn-link">View projects</button>
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
                    var url = '{{route('deleteEmployee')}}';
                    var clickedButton = $(this);
                    var SIN = $(this).parent().siblings('.SIN').text();
                    $.ajax({
                        type:'POST',
                        url: url,
                        data:{"SIN": SIN},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "text",
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
                var SIN = $(this).parent().siblings('.SIN').text();
                $.ajax({
                    type:'GET',
                    url: 'updateEmployee',
                    data:{SIN: SIN},
                    success:function(data){
                        $('html').html(data);
                    },
                    error:function (jqXHR, textStatus, errorThrown) {
                        alert(JSON.stringify(jqXHR, null, 2));
                    }
                });
            });

            $('#viewSupervisorTable').on('click', '.btn-success', function(){
                if ($(this).text() == "Add Subordinate")
                {
                    var SIN = $(this).parent().siblings('.SIN').text();
                    var SIN = $("#viewSupervisorCaption").text().replace("Subordinates for Employee ID = ", "");
                    var subordinateSIN = $('#viewSupervisorTable .js-states option:selected').val();
                    $.ajax({
                        type:'POST',
                        url: 'addSubordinate',
                        data:{SIN: SIN, subordinateSIN:subordinateSIN},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "text",
                        success:function(data){
                            alert("Successfully added subordinate" );
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }

                if ($(this).text() == "Add Supervisor")
                {
                    var SIN = $(this).parent().siblings('.SIN').text();
                    var SIN = $("#viewSupervisorCaption").text().replace("Supervisor for Employee ID = ", "");
                    var supervisorSIN = $('#viewSupervisorTable .js-states option:selected').val();
                    $.ajax({
                        type:'POST',
                        url: 'addSupervisor',
                        data:{SIN: SIN, supervisorSIN:supervisorSIN},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "text",
                        success:function(data){
                            alert("Successfully added supervisor" );
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }

            });

            $('#viewSupervisorTable').on('click', '.btn-danger', function(){
                if ($(this).text() == "Remove supervisor"){
                    if (confirm('Are you sure?')){
                        var clickedButton = $(this);
                        var SIN = $(this).parent().siblings('.SIN').text();
                        var subordinateSIN = $("#viewSupervisorCaption").text().replace("Supervisor for Employee ID = ", "");
                        $.ajax({
                            type:'POST',
                            url: 'removeSupervisor',
                            data:{SIN: SIN, subordinateSIN:subordinateSIN},
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            dataType: "text",
                            success:function(data){
                                clickedButton.parent().parent().remove();
                            },
                            error:function (jqXHR, textStatus, errorThrown) {
                                alert(JSON.stringify(jqXHR, null, 2));
                            }
                        });
                    }
                }

                if ($(this).text() == "Remove subordinate"){
                    if (confirm('Are you sure?')){
                        var clickedButton = $(this);
                        var SIN = $(this).parent().siblings('.SIN').text();
                        var supervisorSIN = $("#viewSupervisorCaption").text().replace("Subordinates for Employee ID = ", "");
                        $.ajax({
                            type:'POST',
                            url: 'removeSubordinate',
                            data:{SIN: SIN, supervisorSIN:supervisorSIN},
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            dataType: "text",
                            success:function(data){
                                clickedButton.parent().parent().remove();
                            },
                            error:function (jqXHR, textStatus, errorThrown) {
                                alert(JSON.stringify(jqXHR, null, 2));
                            }
                        });
                    }
                }
            });

            $('#dataTables-example').on('click', '#dependents .btn-link', function(){
                if ($(this).text() == "View dependents"){
                    var SIN = $(this).parent().siblings('.SIN').text();
                    $.ajax({
                        type:'GET',
                        url: 'getDependents',
                        data:{SIN: SIN},
                        success:function(dependents){

                            $("#viewDependentTable").show();
                            $("#viewProjectTable").hide();
                            $("#viewSupervisorTable").hide();
                            $("#viewDependentTable td").remove();
                            $("#viewDependentCaption").text("Dependents for Employee ID = " + SIN);
                            $.each(dependents, function(index, dependent) {
                                $("#viewDependentTable tbody").append(
                                    "<tr><td>" + dependent.dependentSIN + "</td><td>" + dependent.name + "</td><td>" + dependent.gender
                                    + "</td><td>" + dependent.birthDate + "</td></tr>"
                                )
                            });
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }

                if ($(this).text() == "View supervisor"){
                    var SIN = $(this).parent().siblings('.SIN').text();
                    $.ajax({
                        type:'GET',
                        url: 'getSupervisor',
                        data:{SIN: SIN},
                        success:function(employees){

                            $("#viewSupervisorTable").show();
                            $("#viewDependentTable").hide();
                            $("#viewProjectTable").hide();
                            $("#viewSupervisorTable td").remove();
                            $("#viewSupervisorCaption").text("Supervisor for Employee ID = " + SIN);
                            if (!employees[0]) {
                                $("#viewSupervisorTable tbody").append(
                                    "<tr><td class='SIN'>"  + "</td><td>" + "</td><td>"
                                    + "</td><td>" + "</td><td>"
                                    + "</td><td>" + "</td><td>" + "</td><td>"
                                    + "</td><td> <select class='form-control js-states' name='employee_id'>"
                                    + "<option value='-1'>Select employee</option>"
                                    +    "@if ($employees !== null)"
                                    + "@foreach ($employees as $employee)"
                                    + "<option value='{{$employee->SIN}}''>{{$employee->name}}</option>"
                                    + "@endforeach"
                                    + "@endif"
                                    +  "</select>"
                                    + "<button class='btn btn-success'>Add Supervisor</button></td></tr>"
                                );
                            }
                            $.each(employees, function(index, employee) {
                                $("#viewSupervisorTable tbody").append(
                                    "<tr><td class='SIN'>"  + employee.SIN + "</td><td>" + employee.name + "</td><td>" + employee.birthDate
                                    + "</td><td>" + employee.phoneNumber + "</td><td>" + employee.address
                                    + "</td><td>" + employee.salary + "</td><td>" + employee.gender  + "</td><td>" + employee.departmentID
                                    + "</td><td><button type=\"button\" id='remove_supervisor' class=\"btn btn-danger\">Remove supervisor</button></td></tr>"
                                )
                            });
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }

                if ($(this).text() == "View subordinates"){
                    var SIN = $(this).parent().siblings('.SIN').text();
                    $.ajax({
                        type:'GET',
                        url: 'getSubordinates',
                        data:{SIN: SIN},
                        success:function(employees){

                            $("#viewSupervisorTable").show();
                            $("#viewDependentTable").hide();
                            $("#viewProjectTable").hide();
                            $("#viewSupervisorTable td").remove();
                            $("#viewSupervisorCaption").text("Subordinates for Employee ID = " + SIN);
                            if (!employees[0]) {
                                $("#viewSupervisorTable tbody").append(
                                    "<tr><td class='SIN'>"  + "</td><td>" + "</td><td>"
                                    + "</td><td>" + "</td><td>"
                                    + "</td><td>" + "</td><td>" + "</td><td>"
                                    + "</td><td> <select class='form-control js-states' name='employee_id'>"
                                    + "<option value='-1'>Select employee</option>"
                                    +    "@if ($employees !== null)"
                                    + "@foreach ($employees as $employee)"
                                    + "<option value='{{$employee->SIN}}''>{{$employee->name}}</option>"
                                    + "@endforeach"
                                    + "@endif"
                                    +  "</select>"
                                    + "<button class='btn btn-success'>Add Subordinate</button></td></tr>"
                                );
                            }
                            $.each(employees, function(index, employee) {
                                $("#viewSupervisorTable tbody").append(
                                    "<tr><td class='SIN'>"  + employee.SIN + "</td><td>" + employee.name + "</td><td>" + employee.birthDate
                                    + "</td><td>" + employee.phoneNumber + "</td><td>" + employee.address
                                    + "</td><td>" + employee.salary + "</td><td>" + employee.gender  + "</td><td>" + employee.departmentID
                                    + "</td><td><button type=\"button\" id='remove_subordinate' class=\"btn btn-danger\">Remove subordinate</button></td></tr>"
                                )
                            });
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }

                if ($(this).text() == "View projects"){
                    var SIN = $(this).parent().siblings('.SIN').text();
                    $.ajax({
                        type:'GET',
                        url: 'getProjects',
                        data:{SIN: SIN},
                        success:function(projects){

                            $("#viewProjectTable").show();
                            $("#viewDependentTable").hide();
                            $("#viewSupervisorTable").hide();
                            $("#viewProjectTable td").remove();
                            $("#viewProjectCaption").text("Projects for Employee ID = " + SIN);
                            $.each(projects, function(index, project) {
                                $("#viewProjectTable tbody").append(
                                    "<tr><td>" + project.id + "</td><td>" + project.name + "</td><td>" + project.location + "</td><td>"
                                    + project.hours + "</td></tr>"
                                )
                            });
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }
            });
        });
    </script>

@endsection