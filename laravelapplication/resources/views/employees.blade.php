<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>COMPANY</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="css/dataTables/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="dashboard">Company Management System</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="dashboard"><i class="fa fa-home fa-fw"></i> Home</a></li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </li>
                    <li>
                        <a href="dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="departments"><i class="fa fa-table fa-fw"></i> Department Management</a>
                        </li>
                        <li>
                            <a href="employees" class="active"><i class="fa fa-table fa-fw"></i> Employee Management</a>
                        </li>
                        <li>
                            <a href="projects"><i class="fa fa-table fa-fw"></i> Project Management</a>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Employee Management</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List of employees
                    </div>
                    <div class="panel-body" align="right">
                        <a href="createEmployee">
                            <button type="button" id="new-employee" class="btn btn-success">Add new employee</button>
                        </a>
                    </div>

                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
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
                                    {{--  @foreach ($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach  --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-1 control-label">Name</label>
                            <div class="col-md-2">
                                <input id="name" type="text" class="form-control" name="nname" value="{{ old('nname') }}" autofocus>

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
                                <select class="form-control js-states" name="state_id">
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
                                    <th>Dependents</th>
                                    <th>Projects</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{$employee->SIN}}</td>
                                        <td>{{$employee->name}}</td>
                                        <td>{{$employee->birthDate}}</td>
                                        <td>{{$employee->phoneNumber}}</td>
                                        <td>{{$employee->address}}</td>
                                        <td>{{$employee->salary}}</td>
                                        <td>{{$employee->gender}}</td>
                                        <td>
                                            <!-- Need unique IDs for each button -->
                                            <button type="button" class="btn btn-link">View dependents</button>
                                        </td>
                                        <td>
                                            <!-- Need unique IDs for each button -->
                                            <button type="button" class="btn btn-link">View projects</button>
                                        </td>
                                        <td>
                                            <!-- Need unique IDs for each button -->
                                            <button type="button" id="btn-update" class="btn btn-warning">Update</button>
                                            <button type="button" id="btn-delete" class="btn btn-danger">Delete</button>
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

<!-- jQuery -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="js/dataTables/jquery.dataTables.min.js"></script>
<script src="js/dataTables/dataTables.bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/startmin.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });

        $('#testButton').click(function(){
            $.ajax({
                type:'GET',
                url:'getEmployee',
                data:{SIN: '4321'},
                success:function(employees){
                    $('#dataTables-example tbody > tr').remove();
                    $.each(employees, function(index, employee) {
                        //alert(JSON.stringify(employee));
                        $("#dataTables-example tbody").append(
                            "<tr><td>" + employee.SIN + "</td><td>" + employee.name + "</td><td>" + employee.birthDate
                            + "</td><td>" + employee.phoneNumber + "</td><td>" + employee.address
                            + "</td><td>" + employee.salary + "</td><td>" + employee.gender + "</td></tr>"
                        )
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(JSON.stringify(jqXHR).toString());
                }
            });
        });

        $('#new-employee').click(function(){
            $.ajax({
                type: 'GET',
                url:'createEmployee'
            });
        });


    });
</script>

</body>
</html>