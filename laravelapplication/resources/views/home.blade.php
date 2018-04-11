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
    <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">

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
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Home</a></li>
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
                        <a href="dashboard" class="active"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                    </li>
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="departments"><i class="fa fa-table fa-fw"></i> Department Management</a>
                    </li>
                    <li>
                        <a href="dependents"><i class="fa fa-table fa-fw"></i> Dependent Management</a>
                    </li>
                    <li>
                        <a href="employees"><i class="fa fa-table fa-fw"></i> Employee Management</a>
                    </li>
                    <li>
                        <a href="projects"><i class="fa fa-table fa-fw"></i> Project Management</a>
                    </li>
                </ul>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">COMP 353: Company Management System</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <h3><b>Winter 2018 - Concordia University</b></h3>
        Team ID: zyc353_4</br></br>

        <h4><b>Team members:</b></h4>
        Aline Koftikian - 27764162</br>
        Ideawin-Bunthy Koun - 26314155</br>
        Nassim El Sayed - 27010419</br></br>


        <button type="button" id="totalPay" class="btn btn-primary btn-lg">View Company Current Total Pay</button>

    </div>


</div>

<!-- jQuery -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/startmin.js"></script>

<script>
    $('#totalPay').on('click', function (){
        $.ajax({
            type:'GET',
            url: 'getCompanyTotalPay',
            success:function(results){
                $.each(results, function(index, result) {
                    var total = result.totalPay + "$"
                    $("#totalPay").html(total);
                });
            },
            error:function (jqXHR, textStatus, errorThrown) {
                alert(JSON.stringify(jqXHR, null, 2));
            }
        });
    });
    </script>

</body>
<footer id="footer" class="text text-center">Copyright &copy 2018 Aline Koftikian, Ideawin-Bunthy Koun, Nassim El-Sayed</footer>
</html>
