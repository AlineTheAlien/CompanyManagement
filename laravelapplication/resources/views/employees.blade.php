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
                                        <td class="SIN">{{$employee->SIN}}</td>
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
                                            <a href="updateEmployee" class="btn btn-warning"> Update </a>
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

        $('.btn-danger').on('click', function (){
            if (confirm('Are you sure?')){
                var url = '{{route('deleteEmployee')}}';
                var clickedButton = $(this);
                var SIN = $(this).parent().siblings('.SIN').text();
                $.ajax({
                    type:'GET',
                    url: url,
                    data:{SIN: SIN},
                    success:function(data){
                        clickedButton.parent().parent().remove();
                    },
                    error:function (jqXHR, textStatus, errorThrown) {
                        alert(JSON.stringify(jqXHR, null, 2));
                    }
                });
            }
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

    });
</script>

</body>
</html>