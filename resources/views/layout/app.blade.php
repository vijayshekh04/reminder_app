
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Reminder App | Reminder</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/')}}plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/')}}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('/')}}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('/')}}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('/')}}plugins/daterangepicker/daterangepicker.css">

    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

    <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/')}}dist/css/adminlte.min.css">


    <!-- CSS CDN -->
    <link href=
          "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet"/>

</head>
<body class="hold-transition sidebar-mini">
<div class="custom_loading" style="display: none"><div class="spinner"><i class="fa fa-spinner fa-spin"></i></div></div>
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('dist/img/loading-gif.gif') }}" alt="AdminLTELogo" height="60" width="60">
    </div>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('/')}}" class="brand-link">
            <img src="{{asset('/')}}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Reminder App</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('/')}}dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ucfirst(Session::get('user_session')['name']) }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <li class="nav-item @if(Request::segment(1)=="reminder"){{"menu-open"}}@endif">
                        <a href="#" class="nav-link @if(Request::segment(1)=="reminder"){{"active"}}@endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Reminder
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('reminder') }}" class="nav-link @if(Request::segment(1)=="reminder" && Request::segment(2)==""){{"active"}}@endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reminder</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reminder.create') }}" class="nav-link @if(Request::segment(1)=="reminder" && Request::segment(2)=="create"){{"active"}}@endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add</p>
                                </a>
                            </li>
                        </ul>
                    <li class="nav-item">
                        <a href="{{url('logout')}}" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Log Out
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="{{url('')}}">Reminder</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('/')}}plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/')}}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('/')}}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/')}}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<!-- InputMask -->
<script src="{{asset('/')}}plugins/moment/moment.min.js"></script>
<!-- toastr -->
<script  src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<!-- sweetalert2 -->
<script  src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/')}}dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Bootstrap datetimepicker CDN -->
<!-- Page specific script -->
@yield('scripts')


<?php
if (!empty(Session::get('response')) &&  !empty(Session::get('msg')) ){
$response = Session::get('response');
$alt_msg = Session::get('msg');

Session::forget('response');
?>
<script type="text/javascript">

    <?php if($response !="success"){?>
    toastr.error("{{$alt_msg}}");

    <?php }else{ ?>
    toastr.success("{{$alt_msg}}");
    <?php } ?>
</script>
<?php } ?>
<script type="text/javascript">
    function show_message(status,message) {
        if(status == "success"){
            toastr.success(message,"Success");
        }else{
            toastr.error(message,"Fail");
        }
    }
</script>

</body>
</html>
