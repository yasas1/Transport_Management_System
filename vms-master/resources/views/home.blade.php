@extends('layouts.master')

@section('styles')
<style>
    /* body { padding-top:20px; } */
    .panel-body .btn:not(.btn-block) { width:120px;margin-bottom:10px;}
</style>

@endsection

@section('content')

    <div class="login-logo">
        <i class="fa fa-car fa-x"></i>
        <b> VEHICLE MANAGEMENT SYSTEM </b>@ UCSC
    </div>

    <div class="row">
        @if(Auth::user()->canReadVehicle() || Auth::user()->canUpdateVehicle() ||Auth::user()->canCreateVehicle() ) 
            <div class="col-md-6">          
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="fa fa-car"></span> VEHICLE</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                @if(Auth::user()->canReadVehicle())
                                    <a href="{{url('/vehicle/')}}" class="btn btn-warning " role="button"><span class="glyphicon glyphicon-folder-open"></span> <br/>View</a>
                                @endif
                                @if(Auth::user()->canUpdateVehicle())
                                    <a href="{{url('/vehicle/')}}" class="btn btn-primary " role="button"><span class="glyphicon glyphicon-edit"></span> <br/>Edit</a>
                                @endif
                                @if(Auth::user()->canCreateVehicle())
                                    <a href="{{url('/vehicle/create')}}" class="btn btn-danger " role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New </a> 
                                @endif                           
                            </div>
                        </div>                  
                    </div>
                </div>        
            </div>
        @endif
        @if(Auth::user()->canReadDriver() || Auth::user()->canCreateDriver() ||Auth::user()->canUpdateDriver() ) 
            <div class="col-md-6">          
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="fa fa-user"></span> DRIVER</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                @if(Auth::user()->canReadDriver())
                                    <a href="{{url('/driver/')}}" class="btn btn-warning " role="button"><span class="glyphicon glyphicon-folder-open"></span> <br/>View</a>
                                @endif
                                @if(Auth::user()->canUpdateDriver())
                                    <a href="{{url('/driver/')}}" class="btn btn-primary " role="button"><span class="glyphicon glyphicon-edit"></span> <br/>Edit</a>
                                @endif
                                @if(Auth::user()->canCreateDriver())
                                    <a href="{{url('/driver/create')}}" class="btn btn-danger " role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New </a>
                                @endif
                            </div>
                        </div>                  
                    </div>
                </div>          
            </div>
        @endif

        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa fa-road"></span> JOURENEY</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            @if(Auth::user()->canRequestJourney())
                                <a href="{{url('/journey/create')}}" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>New Request </a>
                            @endif
                            @if(Auth::user()->canApproveJourney())
                                <a href="{{url('/journey/requests')}}" class="btn btn-warning " role="button"><span class="glyphicon glyphicon-pencil"></span> <br/>Approve</a>
                            @endif
                            @if(Auth::user()->canConfirmJourney())
                                <a href="{{url('/journey/requests/notconfirmed')}}" class="btn btn-primary " role="button"><span class="glyphicon glyphicon-ok"></span> <br/>Confirm</a> 
                            @endif                         
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            @if(Auth::user()->canViewOngoingJourneys())
                                <a href="{{url('/journey/requests/confirmed')}}" class="btn btn-primary " role="button"><span class="glyphicon glyphicon-indent-left"></span> <br/>Ongoing</a>
                            @endif
                            @if(Auth::user()->canViewCompletedJourneys())
                                <a href="{{url('/journey/requests/completed')}}" class="btn btn-info " role="button"><span class="fa fa-folder"></span> <br/>History</a>
                            @endif
                            @if(Auth::user()->canViewMyJourneys())
                                <a href="{{url('/journey/myjourneys')}}" class="btn btn-success " role="button"><span class="glyphicon glyphicon-user"></span> <br/>My Journey</a>
                            @endif                                
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <a href="{{url('/journey/createBacklog')}}" class="btn btn-danger  " role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New Backlog </a>                      
                            <a href="{{url('/journey/createAprrovedBacklog')}}" class="btn btn-warning  " role="button"><span class="glyphicon glyphicon-pencil"></span> <br/> Approve Backlog </a>
                        </div>
                    </div> 
                        
                            
                </div>
            </div>
        </div>

    </div>

    <div class="row"> 

    </div>

    {{-- <div class="row"> 

        <div class="col-md-6">

            <div class="panel panel-primary">
                
                <div class="panel-body">

                    <canvas id="doughnut-chart" width="800" height="450"></canvas>
                                    
                </div>
            </div>
        </div>

    </div> --}}

@endsection

@section('scripts')



@endsection