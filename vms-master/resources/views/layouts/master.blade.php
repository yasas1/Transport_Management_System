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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"> --}}

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

                <li>
                    <a href="{{url('home')}}"><i class="glyphicon glyphicon-home"></i> <span>HOME</span></a>     
                </li>
                @if(Auth::user()->canReadVehicle() || Auth::user()->canUpdateVehicle() ||Auth::user()->canCreateVehicle() ) 
                    <li class="treeview">
                        <a href="#"><i class="fa fa-car"></i> <span>VEHICLE</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>

                            </span>
                        </a>
                        <ul class="treeview-menu
                            {{
                                url()->current() == url('/vehicle/')||
                                url()->current() == url('/vehicle/create')||
                                url()->current() == url('/vehicle/')?'active':''
                            }}
                            ">

                            @if(Auth::user()->canReadVehicle())
                                <li class="{{url()->current() == url('/vehicle/')?'active':''}}" > <a href="{{url('/vehicle/')}}"><i class="fa fa-eye"></i> <span>VIEW CURRENT VEHICLES</span></a></li>
                            @endif
                            @if(Auth::user()->canCreateVehicle())
                                <li class="{{url()->current() == url('/vehicle/create')?'active':''}}" > <a href="{{url('/vehicle/create')}}"><i class="fa fa-plus"></i> <span>CREATE NEW VEHICLE</span></a></li>
                            @endif
                            @if(Auth::user()->canUpdateVehicle())
                                <li class="{{url()->current() == url('/vehicle/')?'active':''}}" > <a href="{{url('/vehicle/')}}"><i class="fa fa-edit"></i> <span>EDIT A VEHICLE</span></a></li>
                            @endif
                        </ul>
                    </li>
                @endif
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
                <li class="treeview
                        {{
                        url()->current() == url('/journey/create')||
                        url()->current() == url('/journey/requests')||
                        url()->current() == url('/journey/createAprrovedBacklog')||
                        url()->current() == url('/journey/requests/notconfirmed')||
                        url()->current() == url('/journey/requests/complete')||
                        url()->current() == url('/journey/requests/confirmed')||
                        url()->current() == url('/journey/requests/completed')||
                        url()->current() == url('/journey/cancelled')||
                        url()->current() == url('/journey/myjourneys')||
                        url()->current() == url('/journey/createBacklog')?'active':''
                        }}
                        ">
                    <a href="#"><i class="fa fa-road"></i> <span>JOURNEY</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>

                        </span>
                    </a>
                    <ul class="treeview-menu">
                    {{-- <li><a href="{{url('/journey/')}}"><i class="fa fa-eye"></i> <span>VIEW CURRENT JOURNEYS</span></a></li>--}}
                        @if(Auth::user()->canRequestJourney())
                            <li class="{{url()->current() == url('/journey/create')?'active':''}}" ><a href="{{url('/journey/create')}}"><i class="fa fa-plus"></i> <span>NEW JOURNEY REQUEST</span></a></li>
                        @endif           

                        @if(Auth::user()->canApproveJourney()) 
                            <li class="{{url()->current() == url('/journey/requests')?'active':''}}" ><a href="{{url('/journey/requests')}}"><i class="fa fa-edit"></i> <span>APPROVE REQUESTS (HEAD)</span></a></li>
                        @endif

                        @if(Auth::user()->canCreateViewBacklogJourneys()) 
                            <li class="{{url()->current() == url('/journey/createBacklog')?'active':''}}"><a href="{{url('/journey/createBacklog')}}"><i class="fa fa-plus"></i> <span>NEW BACKLOG JOURNEYS</span></a></li>
                        @endif

                        @if(Auth::user()->canApproveBacklogJourneys())
                            <li class="{{url()->current() == url('/journey/createAprrovedBacklog')?'active':''}}" ><a href="{{url('/journey/createAprrovedBacklog')}}"><i class="fa fa-edit"></i> <span>APPROVE BACKLOGS (HEAD)</span></a></li>
                        @endif

                        @if(Auth::user()->canConfirmJourney())
                            <li  class="{{url()->current() == url('/journey/requests/notconfirmed')?'active':''}}"><a href="{{url('/journey/requests/notconfirmed')}}"><i class="fa fa-edit"></i> <span>CONFIRM REQUESTS (CLARK)</span></a></li>
                        @endif

                        @if(Auth::user()->canViewOngoingJourneys())
                            <li class="{{url()->current() == url('/journey/requests/confirmed')?'active':''}}"><a href="{{url('/journey/requests/confirmed')}}"><i class="fa fa-edit"></i> <span>ONGOING JOURNEYS</span></a></li>
                        @endif

                        @if(Auth::user()->canCompleteJourney())
                            <li class="{{url()->current() == url('/journey/requests/complete')?'active':''}}"><a href="{{url('/journey/requests/complete')}}"><i class="fa fa-edit"></i> <span>RUNNING CHART (Driver)</span></a></li>
                        @endif

                        @if(Auth::user()->canViewCompletedJourneys())
                            <li class="{{url()->current() == url('/journey/requests/completed')?'active':''}}"><a href="{{url('/journey/requests/completed')}}"><i class="fa fa-eye"></i> <span>JOURNEY HISTORY</span></a></li>
                        @endif          

                        @if(Auth::user()->canViewMyJourneys())
                        <li class="{{url()->current() == url('/journey/myjourneys')?'active':''}}"><a href="{{url('/journey/myjourneys')}}"><i class="fa fa-eye"></i> <span>MY JOURNEYS</span></a></li>
                        @endif

                        @if(Auth::user()->canViewCancelledJourneys())
                            <li class="{{url()->current() == url('/journey/cancelled')?'active':''}}"><a href="{{url('/journey/cancelled')}}"><i class="fa fa-eye"></i> <span>UNSUCCESSSFUL JOURNEYS</span></a></li>
                        @endif

                    </ul>
                </li>
                
                <li class="treeview
                        {{
                        url()->current() == url('/user')||
                        url()->current() == url('/user/roles')||
                        url()->current() == url('/user/role/create')||
                        url()->current() == url('/user/role/create')?'active':''
                        }}
                        ">
                    <a href="#"><i class="fa fa-user"></i> <span>USER MANAGEMENT</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                   
                    <ul class="treeview-menu">
                        <li class="{{url()->current() == url('/user')?'active':''}}"><a href="{{url('/user')}}"><i class="fa fa-eye"></i> <span>VIEW USERS</span></a></li>
                    @if(Auth::user()->canReadRole() || Auth::user()->canCreateRole() )
                        <li class="treeview
                                {{
                                url()->current() == url('/user/roles')||
                                url()->current() == url('/user/role/create')?'active':''
                                }}
                                ">
                            <a href="#"><i class="fa fa-user-secret"></i> <span>ROLE</span>
                                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>

                        </span>
                            </a>
                            <ul class="treeview-menu">
                                @if(Auth::user()->canReadRole() )
                                    <li class="{{url()->current() == url('/user/roles')?'active':''}}"><a href="{{url('/user/roles')}}"><i class="fa fa-eye"></i> <span>VIEW ROLES</span></a></li>
                                @endif
                                @if(Auth::user()->canCreateRole() )
                                    <li class="{{url()->current() == url('/user/role/create')?'active':''}}"><a href="{{url('/user/role/create')}}"><i class="fa fa-plus"></i> <span>CREATE NEW ROLE</span></a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    </ul>

                </li>
                
                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 6) 
                <li class="treeview {{
                    url()->current() == url('/vehicle/usage')|| 
                    url()->current() == url('/vehicle/addservicing')||
                    url()->current() == url('/vehicle/repairs')||
                    url()->current() == url('/vehicle/tyres')||
                    url()->current() == url('/vehicle/fuelUsage')||
                    url()->current() == url('/vehicle/mileage')||
                    url()->current() == url('/vehicle/accidents')||
                    url()->current() == url('/vehicle/annualLicences')?'active':''
                    }} ">
                    <a href="#"><i class="fa fa-bar-chart"></i> <span>VEHICLE USAGE</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>

                        </span> 
                    </a>
                    <ul class="treeview-menu"> 
                        <li class="{{url()->current() == url('/vehicle/usage')?'active':''}}" ><a href="{{url('/vehicle/usage')}}"><i class="fa fa-eye"></i> VEHICLE USAGE</a></li> 
                        <li class="{{url()->current() == url('/vehicle/addservicing')?'active':''}}" ><a href="{{url('/vehicle/addservicing')}}"><i class="fas fa-oil-can"></i> <span>&nbsp SERVICING</span></a></li>
                        <li class="{{url()->current() == url('/vehicle/repairs')?'active':''}}" ><a href="{{url('/vehicle/repairs')}}"><i class="fa fa-wrench"></i><span>&nbsp REPAIRS</span></a></li>
                        <li class="{{url()->current() == url('/vehicle/tyres')?'active':''}}" ><a href="{{url('/vehicle/tyres')}}"> <i class="fa fa-circle-o-notch"></i> <span>&nbsp TYRES</span></a></li>
                        <li class="{{url()->current() == url('/vehicle/annualLicences')?'active':''}}" ><a href="{{url('/vehicle/annualLicences')}}"><i class="fas fa-list-alt"></i> <span>&nbsp ANNUAL LICENCES</span></a></li>                       
                        <li class="{{url()->current() == url('/vehicle/accidents')?'active':''}}" ><a href="{{url('/vehicle/accidents')}}"><i class="fas fa-car-crash"></i><span>&nbsp ACCIDENTS</span></a></li>
                        <li class="{{url()->current() == url('/vehicle/mileage')?'active':''}}" ><a href="{{url('/vehicle/mileage')}}"> <i class="fas fa-tachometer-alt"></i> <span>&nbsp VEHICLE MILEAGE</span></a></li>
                        <li class="{{url()->current() == url('/vehicle/fuelUsage')?'active':''}}" ><a href="{{url('/vehicle/fuelUsage')}}"> <i class="fas fa-gas-pump"></i> <span>&nbsp FILLING FUEL </span></a></li>
                    </ul>
                    
                </li>
                @endif
                <li class="treeview">
                    <a href="#"><i class="fas fa-map-marked"></i> <span>&nbsp Map</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>

                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{url('/journey/map')}}"><i class="fa fa-map-marker"></i> Map</a></li>
                    </ul>
                    
                </li>
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
                <b style="font-family:Trebuchet MS;"> @yield('header') </b>
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
            Vehicle Management System
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