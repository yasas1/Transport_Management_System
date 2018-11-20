@extends('layouts.master')

@section('styles')
<style>
    /* body { padding-top:20px; } */
    .panel-body .btn:not(.btn-block) { width:120px;margin-bottom:10px;}
</style>



@endsection

@section('content')


    <div class="row">

        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa fa-road"></span> JOURENEY</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <a href="{{url('/journey/create')}}" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>New Journey </a>
                          <a href="{{url('/journey/requests')}}" class="btn btn-warning " role="button"><span class="glyphicon glyphicon-pencil"></span> <br/>Approve</a>
                          <a href="{{url('/journey/requests/notconfirmed')}}" class="btn btn-primary " role="button"><span class="glyphicon glyphicon-ok"></span> <br/>Confirm</a>
                         
                         
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <a href="{{url('/journey/requests/confirmed')}}" class="btn btn-primary " role="button"><span class="glyphicon glyphicon-indent-left"></span> <br/>Ongoing</a>
                            <a href="{{url('/journey/requests/completed')}}" class="btn btn-info " role="button"><span class="fa fa-folder"></span> <br/>History</a>
                            <a href="{{url('/journey/myjourneys')}}" class="btn btn-success " role="button"><span class="glyphicon glyphicon-user"></span> <br/>My Journey</a>
                            
                            {{-- <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-tag"></span> <br/>Tags</a> --}}
                        </div>
                    </div>
                    
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <a href="{{url('/journey/createBacklog')}}" class="btn btn-danger  " role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New Backlog </a>                      
                        
                                
                            <a href="{{url('/journey/createAprrovedBacklog')}}" class="btn btn-warning  " role="button"><span class="glyphicon glyphicon-pencil"></span> <br/> Approve Backlog </a>
                        </div>
                    </div> 
                        
                           
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-bookmark"></span> BACKLOG JOURENY</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <a href="#" class="btn btn-danger " role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New </a>
                            <a href="#" class="btn btn-warning " role="button"><span class="glyphicon glyphicon-bookmark"></span> <br/>Aprrove</a>
                            <a href="#" class="btn btn-primary " role="button"><span class="glyphicon glyphicon-signal"></span> <br/>Reports</a>
                            <a href="#" class="btn btn-primary " role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Comments</a>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <a href="#" class="btn btn-success" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Users</a>
                            <a href="#" class="btn btn-info " role="button"><span class="glyphicon glyphicon-file"></span> <br/>Notes</a>
                            <a href="#" class="btn btn-primary " role="button"><span class="glyphicon glyphicon-picture"></span> <br/>Photos</a>
                            <a href="#" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-tag"></span> <br/>Tags</a>
                        </div>
                    </div>
                    <a href="http://www.jquery2dotnet.com/" class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-globe"></span> Website</a>
                </div>
            </div>
        </div>


    </div>


@endsection
