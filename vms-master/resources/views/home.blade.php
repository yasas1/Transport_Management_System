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
                        <span class="fa fa-car"></span> VEHICLE</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <a href="{{url('/vehicle/create')}}" class="btn btn-danger " role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New </a>
                            <a href="{{url('/vehicle/')}}" class="btn btn-warning " role="button"><span class="glyphicon glyphicon-folder-open"></span> <br/>View</a>
                            <a href="{{url('/vehicle/')}}" class="btn btn-primary " role="button"><span class="glyphicon glyphicon-edit"></span> <br/>Edit</a> 
                        </div>
                    </div>                  
                </div>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa fa-user"></span> DRIVER</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <a href="{{url('/driver/create')}}" class="btn btn-danger " role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New </a>
                            <a href="{{url('/driver/')}}" class="btn btn-warning " role="button"><span class="glyphicon glyphicon-folder-open"></span> <br/>View</a>
                            <a href="{{url('/driver/')}}" class="btn btn-primary " role="button"><span class="glyphicon glyphicon-edit"></span> <br/>Edit</a>
                        </div>
                    </div>                  
                </div>
            </div>
    
        </div>

        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa fa-road"></span> JOURENEY</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <a href="{{url('/journey/create')}}" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>New  </a>
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

    </div>
    <div class="row"> 

        <div class="col-md-6">

            <div class="panel panel-primary">
                
                <div class="panel-body">

                    <canvas id="doughnut-chart" width="800" height="450"></canvas>
                                    
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>

    var vehicles = {!! json_encode($vehicles->toArray()) !!}; 

    var v1Count = {!! json_encode($v1Count) !!}; 
    var v2Count = {!! json_encode($v2Count) !!}; 
    var v3Count = {!! json_encode($v3Count) !!}; 
    var externalCount = {!! json_encode($externalCount) !!};

    var vehicle_colors = [];
                    /*Get Journey color from db */
    $.get("{{ URL::to('journey/readVehicleColor/') }}",function(data){ 
        
        $.each(data,function(i,value){  
            console.log(value.journey_color);
            vehicle_colors[i]='#'+value.journey_color; // Journey colors for event
        });
        console.log(externalCount);
    });

    new Chart(document.getElementById("doughnut-chart"), {
        type: 'doughnut',
        data: {
        labels: [vehicles[0].name,vehicles[1].name, vehicles[2].name, "External"],
        datasets: [
            {
            label: "Count",
            backgroundColor: ["#1E90FF", "#32CD32","#DA574D","#778899"],
            data: [v1Count,v2Count,v3Count,externalCount]
            }
        ]
        },
        options: {
        title: {
            display: true,
            text: 'All Vehicle Usage for Journeys'
        }
        }
    });

</script>

@endsection