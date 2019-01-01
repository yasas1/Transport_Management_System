@extends('layouts.MasterTopNav')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.errors')
                @include('layouts.success')
            </div>
            <div class="login-box">
                <div class="login-logo">
                    <i class="fa fa-car"></i>
                    <br>
                    <a href="{{route('home')}}"><b> VEHICLE MANAGEMENT SYSTEM  </b><br>@ UCSC</a>
                </div>
                <!-- /.login-logo -->
                <div class="login-box-body">

                    <h3 class="login-box-msg">Staff Login</h3>


                    <div class="social-auth-links text-center">
                        <a href="{{ route('google.login') }}" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                            Google+</a>
                    </div>

                    <div class="social-auth-links text-center">
                        <a href="{{url('/log/director')}}" class="btn btn-block btn-success btn-flat"><i class="fa fa-user"></i> Director </a>
                        <a href="{{url('/log/dhead')}}" class="btn btn-block btn-info btn-flat"><i class="fa fa-user"></i> Divisional Head </a>
                        <a href="{{url('/log/admin')}}" class="btn btn-block btn-danger btn-flat"><i class="fa fa-user"></i> System Admin </a>
                        <a href="{{url('/log/driver')}}" class="btn btn-block btn-warning btn-flat"><i class="fa fa-user"></i> Driver </a>
                        <a href="{{url('/log/user')}}" class="btn btn-block btn-default btn-flat"><i class="fa fa-user"></i> User </a>
                    </div>

                    <!-- /.social-auth-links -->

                </div>


                <!-- /.login-box-body -->
            </div>
        </div>
    </div>
@endsection
