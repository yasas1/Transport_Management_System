<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/skin-blue.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/jquery-confirm.css')}}">

    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    @yield('styles')

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{url('home')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><i class="fa fa-car"></i></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>VMS</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Tasks Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{Auth::user()?Auth::user()->avatar:''}}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{Auth::user()?Auth::user()->name:''}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{Auth::user()?Auth::user()->avatar:''}}" class="img-circle" alt="User Image">

                                <p>
                                    {{Auth::user()?Auth::user()->name:''}}
                                </p>
                                <p>
                                    {{Auth::user()?Auth::user()->role->name:''}}
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Sign out
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{Auth::user()?Auth::user()->avatar:''}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()?Auth::user()->name:''}}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">

                <li class="header">MENU</li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-car"></i> <span>VEHICLE</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>

                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Auth::user()->canReadVehicle())
                            <li><a href="{{url('/vehicle/')}}"><i class="fa fa-eye"></i> <span>VIEW CURRENT VEHICLES</span></a></li>
                        @endif
                        @if(Auth::user()->canCreateVehicle())
                                <li><a href="{{url('/vehicle/create')}}"><i class="fa fa-plus"></i> <span>CREATE NEW VEHICLE</span></a></li>
                        @endif
                        @if(Auth::user()->canUpdateVehicle())
                                <li><a href="{{url('/vehicle/')}}"><i class="fa fa-edit"></i> <span>EDIT A VEHICLE</span></a></li>
                        @endif
                    </ul>
                </li>
                @if(Auth::user()->canReadDriver() || Auth::user()->canCreateDriver() ||Auth::user()->canUpdateDriver() )
                <li class="treeview">
                    <a href="#"><i class="fa fa-user"></i> <span>DRIVER</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>

                        </span>
                    </a>
                    <ul class="treeview-menu">

                        @if(Auth::user()->canReadDriver())
                        <li><a href="{{url('/driver/')}}"><i class="fa fa-eye"></i> <span>VIEW CURRENT DRIVERS</span></a></li>
                        @endif
                        @if(Auth::user()->canCreateDriver())
                            <li><a href="{{url('/driver/create')}}"><i class="fa fa-plus"></i> <span>ADD NEW DRIVER</span></a></li>
                        @endif
                        @if(Auth::user()->canUpdateDriver())
                                <li><a href="{{url('/driver/')}}"><i class="fa fa-edit"></i> <span>EDIT A DRIVER</span></a></li>
                        @endif

                    </ul>
                </li>
                @endif
                <li class="treeview">
                    <a href="#"><i class="fa fa-road"></i> <span>JOURNEY</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>

                        </span>
                    </a>
                    <ul class="treeview-menu">
{{--                        <li><a href="{{url('/journey/')}}"><i class="fa fa-eye"></i> <span>VIEW CURRENT JOURNEYS</span></a></li>--}}
                        @if(Auth::user()->canRequestJourney())
                            <li><a href="{{url('/journey/create')}}"><i class="fa fa-plus"></i> <span>NEW JOURNEY REQUEST</span></a></li>
                        @endif
                        @if(Auth::user()->canApproveJourney())
                            <li><a href="{{url('/journey/requests')}}"><i class="fa fa-edit"></i> <span>APPROVE REQUESTS</span></a></li>
                        @endif
                        @if(Auth::user()->canConfirmJourney())
                            <li><a href="{{url('/journey/requests/notconfirmed')}}"><i class="fa fa-edit"></i> <span>CONFIRM REQUESTS</span></a></li>
                        @endif
                        @if(Auth::user()->canViewOngoingJourneys())
                            <li><a href="{{url('/journey/requests/confirmed')}}"><i class="fa fa-edit"></i> <span>ONGOING JOURNEYS</span></a></li>
                        @endif
                        @if(Auth::user()->canCompleteJourney())
                            <li><a href="{{url('/journey/requests/complete')}}"><i class="fa fa-edit"></i> <span>COMPLETE JOURNEYS</span></a></li>
                        @endif
                        @if(Auth::user()->canViewCompletedJourneys())
                            <li><a href="{{url('/journey/requests/completed')}}"><i class="fa fa-edit"></i> <span>COMPLETED JOURNEYS</span></a></li>
                        @endif

                    </ul>

                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-users"></i> <span>USER</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>

                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('/users')}}"><i class="fa fa-eye"></i> <span>VIEW CURRENT USERS</span></a></li>
                        <li><a href="{{url('/user/create')}}"><i class="fa fa-plus"></i> <span>CREATE NEW USER</span></a></li>
                        <li><a href="{{url('/users')}}"><i class="fa fa-edit"></i> <span>EDIT A USER</span></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-user-secret"></i> <span>ROLE</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>

                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('/user/roles')}}"><i class="fa fa-eye"></i> <span>VIEW ROLES</span></a></li>
                        <li><a href="{{url('/user/role/create')}}"><i class="fa fa-plus"></i> <span>CREATE NEW ROLE</span></a></li>
                        <li><a href="{{url('/user/roles')}}"><i class="fa fa-edit"></i> <span>EDIT A ROLE</span></a></li>
                    </ul>
                </li>
                <li><a href="{{url('/vehicle/usage')}}"><i class="fa fa-bar-chart"></i> Vehicle Usage</a></li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('header')
                <small>@yield('description')</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Management System For Vehicles
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2018 <a href="http://ucsc.cmb.ac.lk/" target="_blank">UCSC</a>.</strong> All rights reserved.
    </footer>

    <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{asset('js/jquery-confirm.min.js')}}"></script>

<script src="{{asset('js/toastr.min.js')}}"></script>

<script src="{{asset('js/datatables.min.js')}}"></script>

<script src="{{asset('https://unpkg.com/micromodal/dist/micromodal.min.js')}}"></script>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "8000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

@yield('scripts')

@if(session('success'))
    <script>
        $(function () {
            toastr.success('{{session('success')}}');
        })
    </script>
@endif

@if(!$errors->isEmpty())
    <script>
        $(function () {
            toastr.error("<ul>\n" +
                "            @foreach($errors->all() as $error)\n" +
                "                <li>{{ $error }}</li>\n" +
                "            @endforeach\n" +
                "        </ul>");
        })
    </script>
@endif

</body>
</html>