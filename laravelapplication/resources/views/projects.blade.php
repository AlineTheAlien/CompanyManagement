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
                    <a href="projects-create">
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

                        <table id="viewEmployeesTable" class="table table-striped table-bordered table-hover" style="display:none">
                            <caption id = "viewEmployeesCaption"> Test</caption>
                            <thead>
                            <tr>
                                <th>SIN</th>
                                <th>Name</th>
                                <th>Birth Date</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Salary</th>
                                <th>Gender</th>
                                {{--<th>Dependents</th> --}}
                                {{--<th>Projects</th> --}}
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <table id="viewTotalHoursTable" class="table table-striped table-bordered table-hover" style="display:none">
                            <caption id = "viewTotalHoursCaption"> Test</caption>
                            <thead>
                            <tr>
                                <th>Employee SIN</th>
                                <th>Hours</th>
                                {{--<th>Dependents</th> --}}
                                {{--<th>Projects</th> --}}
                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Department ID</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Employees assigned</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td class="id">{{$project->id}}</td>
                                    <td>{{$project->departmentID}}</td>
                                    <td>{{$project->name}}</td>
                                    <td>{{$project->location}}</td>
                                    <td>
                                        <!-- Need unique IDs for each button -->
                                        <button type="button" class="btn btn-link">View employees</button> <br/>
                                        <button type="button" class="btn btn-link">View total hours</button>

                                    </td>
                                    <td>
                                            <button class="btn btn-warning">
                                                Update
                                            </button>
                                            <button class="btn btn-danger">
                                                Delete
                                            </button> <br /> <br/>
                                        <button class="btn btn-success">
                                            Add Employee
                                        </button>
                                        <select class="form-control js-states" name="employee_id">
                                            <option value="-1">Select employee</option>
                                              @foreach ($employees as $employee)
                                                <option value="{{$employee->SIN}}">{{$employee->name}}</option>
                                            @endforeach
                                        </select>
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });

            $('#dataTables-example').on('click', '.btn-danger', function (){
                if (confirm('Are you sure?')){
                    var url = '{{route('deleteProject')}}';
                    var clickedButton = $(this);
                    var id = $(this).parent().siblings('.id').text();
                    $.ajax({
                        type:'POST',
                        url: url,
                        data:{"id": id},
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
                var id = $(this).parent().siblings('.id').text();
                $.ajax({
                    type:'GET',
                    url: 'updateProject',
                    data:{id: id},
                    success:function(data){
                        $('html').html(data);
                    },
                    error:function (jqXHR, textStatus, errorThrown) {
                        alert(JSON.stringify(jqXHR, null, 2));
                    }
                });
            });

            $('#dataTables-example').on('click', '.btn-success', function(){
                var id = $(this).parent().siblings('.id').text();
                var sin = $('#dataTables-example .js-states option:selected').val();
                $.ajax({
                    type:'POST',
                    url: 'addEmployeeToProject',
                    data:{id: id, sin: sin},
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(data){
                        alert("Successfully added employee to project" );
                        },
                    error:function (jqXHR, textStatus, errorThrown) {
                        alert(JSON.stringify(jqXHR, null, 2));
                    }
                });
            });

            $("#viewEmployeesTable").on('click', '.btn-danger', function() {
                if (confirm('Are you sure?')){
                    var sin = $(this).parent().siblings('.sin').text();
                    var clickedButton = $(this);
                    $.ajax({
                        type:'POST',
                        url: 'removeEmployeeFromProject',
                        data:{sin: sin},
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

            $('#dataTables-example').on('click', '.btn-link', function(){
                var id = $(this).parent().siblings('.id').text();
                if ($(this).text() == "View employees"){
                    $.ajax({
                        type:'GET',
                        url: 'getEmployeesAssignedOnProject',
                        data:{id: id},
                        success:function(employees){

                            $("#viewEmployeesTable").show();
                            $("#viewTotalHoursTable").hide();
                            $("#viewEmployeesTable td").remove();
                            $("#viewEmployeesCaption").text("Employees working on ProjectID = " + id);
                            $.each(employees, function(index, employee) {
                                $("#viewEmployeesTable tbody").append(
                                    "<tr><td class='sin'>" + employee.SIN + "</td><td>" + employee.name + "</td><td>" + employee.birthDate
                                    + "</td><td>" + employee.phoneNumber + "</td><td>" + employee.address
                                    + "</td><td>" + employee.salary + "</td><td>" + employee.gender
                                    + "</td><td>" + "<button class='btn btn-danger'>Remove</button>" + "</td></tr>"
                                )
                            });
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }
                if ($(this).text() == "View total hours"){
                    $.ajax({
                        type:'GET',
                        url: 'getProjectTotalHours',
                        data:{id: id},
                        dataType: "json",
                        success:function(projects){
                            alert(JSON.stringify(projects, null, 2));

                            var results = JSON.parse(projects);
                            $("#viewEmployeesTable").hide();
                            $("#viewTotalHoursTable").show();
                            $("#viewTotalHoursTable td").remove();
                            $("#viewTotalHoursCaption").text("Total hours working on ProjectID = " + id);
                            $.each(results[0], function(index, project) {
                                $("#viewTotalHoursTable tbody").append(
                                    "<tr><td>" + project.employeeSIN + "</td><td>" + project.hours + "</td></tr>"
                                )
                            });
                            $("#viewTotalHoursTable tbody").append(
                                "<tr><td><b> Total Hours </b></td><td>" + results[1].totalHours + "</td></tr>"
                            )
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            alert(JSON.stringify(jqXHR, null, 2));
                        }
                    });
                }

            });

            $('#dataTables-example').on('click', '#projects .btn-link', function(){
                var SIN = $(this).parent().siblings('.SIN').text();
                $.ajax({
                    type:'GET',
                    url: 'getProjects',
                    data:{SIN: SIN},
                    success:function(projects){

                        $("#viewProjectTable").show();
                        $("#viewDependentTable").hide();
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
            });
        });
    </script>

@endsection