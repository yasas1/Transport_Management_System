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
                        <span class="fa fa-road"></span> JOURENY</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <a href="#" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>New </a>
                          <a href="#" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-pencil"></span> <br/>Approve</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-ok"></span> <br/>Confirm</a>
                         
                         
                        </div>
                        <div class="col-xs-6 col-md-6">
                                <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-indent-left"></span> <br/>Ongoing</a>
                            <a href="#" class="btn btn-info btn-lg" role="button"><span class="fa fa-folder"></span> <br/>History</a>
                            <a href="#" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>My Journey</a>
                            
                            {{-- <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-tag"></span> <br/>Tags</a> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5 col-md-5">
                            <a href="#" class="btn btn-danger btn-lg btn-block" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New Backlog </a>                      
                        </div>
                        <div class="col-xs-5 col-md-5">     
                            <a href="#" class="btn btn-warning btn-lg btn-block" role="button"><span class="glyphicon glyphicon-pencil"></span><br/>Aprrove Backlog</a>
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
                            <a href="#" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New </a>
                            <a href="#" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-bookmark"></span> <br/>Aprrove</a>
                            <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-signal"></span> <br/>Reports</a>
                            <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Comments</a>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <a href="#" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Users</a>
                            <a href="#" class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-file"></span> <br/>Notes</a>
                            <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-picture"></span> <br/>Photos</a>
                            <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-tag"></span> <br/>Tags</a>
                        </div>
                    </div>
                    <a href="http://www.jquery2dotnet.com/" class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-globe"></span> Website</a>
                </div>
            </div>
        </div>


    </div>


@endsection
