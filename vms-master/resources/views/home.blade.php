@extends('layouts.master')

@section('styles')
    <style>
        /* body { padding-top:20px; } */
        .panel-body .btn:not(.btn-block) { width:120px;margin-bottom:10px;}
    </style>

    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css')}}">

@endsection

@section('content')

    <div class="login-logo">
        <i class="fa fa-car fa-x"></i>
        <b> VEHICLE MANAGEMENT SYSTEM </b>@ UCSC
    </div>

    <div class="col-md-5">

        @if(Auth::user()->canReadVehicle() || Auth::user()->canUpdateVehicle() ||Auth::user()->canCreateVehicle() )          
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa fa-car"></span> VEHICLE</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            @if(Auth::user()->canReadVehicle())
                                <a href="{{url('/vehicle/')}}" class="btn btn-warning btn-sm" role="button"><span class="glyphicon glyphicon-folder-open"></span> <br/>View</a>
                            @endif
                            @if(Auth::user()->canUpdateVehicle())
                                <a href="{{url('/vehicle/')}}" class="btn btn-primary btn-sm" role="button"><span class="glyphicon glyphicon-edit"></span> <br/>Edit</a>
                            @endif
                            @if(Auth::user()->canCreateVehicle())
                                <a href="{{url('/vehicle/create')}}" class="btn btn-danger btn-sm" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New </a> 
                            @endif                           
                        </div>
                    </div>                  
                </div>
            </div>        
            
        @endif
        @if(Auth::user()->canReadDriver() || Auth::user()->canCreateDriver() ||Auth::user()->canUpdateDriver() ) 
                        
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa fa-user"></span> DRIVER</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            @if(Auth::user()->canReadDriver())
                                <a href="{{url('/driver/')}}" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-folder-open"></span> <br/>View</a>
                            @endif
                            @if(Auth::user()->canUpdateDriver())
                                <a href="{{url('/driver/')}}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-edit"></span> <br/>Edit</a>
                            @endif
                            @if(Auth::user()->canCreateDriver())
                                <a href="{{url('/driver/create')}}" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New </a>
                            @endif
                        </div>
                    </div>                  
                </div>
            </div>          
            
        @endif

        
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
                            <a href="{{url('/journey/requests')}}" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-pencil"></span> <br/>Approve</a>
                        @endif
                        @if(Auth::user()->canConfirmJourney())
                            <a href="{{url('/journey/requests/notconfirmed')}}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-ok"></span> <br/>Confirm</a> 
                        @endif                         
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        @if(Auth::user()->canViewOngoingJourneys())
                            <a href="{{url('/journey/requests/confirmed')}}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-indent-left"></span> <br/>Ongoing</a>
                        @endif
                        @if(Auth::user()->canViewCompletedJourneys())
                            <a href="{{url('/journey/requests/completed')}}" class="btn btn-info" role="button"><span class="fa fa-folder"></span> <br/>History</a>
                        @endif
                        @if(Auth::user()->canViewMyJourneys())
                            <a href="{{url('/journey/myjourneys')}}" class="btn btn-success" role="button"><span class="glyphicon glyphicon-user"></span> <br/>My Journey</a>
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

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="fa fa-user-secret"></span> ROLE</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                       
                        <a href="{{url('/user/roles')}}" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-folder-open"></span> <br/>View</a>
                        <a href="{{url('/user/roles')}}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-edit"></span> <br/>Edit</a>               
                        <a href="{{url('/user/role/create')}}" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/> New </a> 
                                                  
                    </div>
                </div>                  
            </div>
        </div> 

    </div>

    <div class="col-md-7">

        <div class="panel panel-primary">
        
            <div class="panel-body">

                <div class="box-header with-border">
                    <h2 class="box-title"> <b>Vehicle Calender</b></h2>
                </div>
                <div>   
                    <button  class="all"  style="height:25px;width:35px;border: 1px solid #555555;border-radius: 5px;" > <b>ALL</b> </button> 
                    @foreach ($vehicles as $vehicle)
                        <button class="vehiclebutton" value="{{$vehicle->id}}" id="v{{$vehicle->id}}" style="border: 1px solid #555555;border-radius: 5px;"> {{$vehicle->registration_no}} </button>   
                    @endforeach
                    <button  class="external"  style="height:25px;width:65px;border: 1px solid #555555;border-radius: 5px; background-color:#778899;" >External</button> 
                </div>
                
                <div id='calendar'></div>
                                
            </div>
        </div>

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

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js')}}"></script>
<script src='{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/gcal.min.js')}}'></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script>
         
    var qEvent=[]; // for calender events
    var journey_colors = [];///journey/readVehicle/             
            // get Journet Color
    $.get("{{ URL::to('journey/readVehicleColor/') }}",function(data){ 
        $.each(data,function(i,value){   
            $('#v'+value.id).css('background-color','#'+value.journey_color); // For button color    
            journey_colors[value.id]='#'+value.journey_color;
        });
    });      
    $(document).ready(function(){
            //$('.colorbutton').css('background','#7CFD03');
        $(".vehiclebutton").click(function(evt){
            var vid = $(this).attr("value");   // Vehivle_id from Vehicle_Button
            //$(vid).css('background','#05DCB2');
            qEvent=[];                       
            $('#calendar').fullCalendar('removeEvents');
            $.ajax({
                url: '/journey/ForCreateByVehicle/{id}',
                type: 'GET',
                data: { id: vid },
                success: function(data)
                {
                    console.log(data);              
                    $(data).each(function (i,value) {                
                        qEvent.push(
                        { 
                            title : value.places_to_be_visited,
                            start : value.expected_start_date_time,
                            end : value.expected_end_date_time,
                            id :  value.id,         
                            applicant :value.emp_title+' '+value.emp_firstname+' '+value.emp_surname,                                             
                            vehical_id : value.vehical_id,
                            borderColor: 'black',
                            status: value.status, 
                            color :  journey_colors[value.vehical_id]                                                        
                        });                       
                    }); 
                    //console.log(qEvent);
                    $('#calendar').fullCalendar('addEventSource', qEvent);
                    $('#calendar').fullCalendar('refetchEvents');  
                }
            });
        });
        $(".all").click(function(evt){
            qEvent=[]; 
            $('#calendar').fullCalendar('removeEvents');
            $.get("{{ URL::to('journey/read') }}",function(data){ 
                $.each(data,function(i,value){       
                    if(value.vehical_id != null){
                        qEvent.push({ 
                            title : value.places_to_be_visited, // need place as the title
                            start : value.expected_start_date_time,
                            end : value.expected_end_date_time,
                            id :  value.id, 
                            applicant :value.emp_title+' '+value.emp_firstname+' '+value.emp_surname,                                                    
                            vehical_id : value.vehical_id,
                            borderColor: 'black',
                            status: value.status,
                            color : journey_colors[value.vehical_id]
                        });    
                    } 
                    else{
                        qEvent.push({ 
                            title : value.places_to_be_visited, // need place as the title
                            start : value.expected_start_date_time,
                            end : value.expected_end_date_time,
                            id :  value.id, 
                            applicant :value.emp_title+' '+value.emp_firstname+' '+value.emp_surname,                                                    
                            vehical_id : value.vehical_id,
                            borderColor: 'black',
                            status: value.status,
                            color : "#778899"
                        }); 
                    }                 
                });
                $('#calendar').fullCalendar('addEventSource', qEvent);
                $('#calendar').fullCalendar('refetchEvents');
            });                      
            
        });
        $(".external").click(function(evt){
            qEvent=[]; 
            $('#calendar').fullCalendar('removeEvents');
            $.get("{{ URL::to('journey/readExternal') }}",function(data){
                console.log(data); 
                $.each(data,function(i,value){       
                    qEvent.push(
                    { 
                        title : value.places_to_be_visited,
                        start : value.expected_start_date_time,
                        end : value.expected_end_date_time,
                        id :  value.id,
                        applicant :value.emp_title+' '+value.emp_firstname+' '+value.emp_surname,                                                      
                        borderColor: 'black',
                        status: value.status, 
                        color :  "#778899"    
                    });                  
                });
                $('#calendar').fullCalendar('addEventSource', qEvent);
                $('#calendar').fullCalendar('refetchEvents');
            });                      
            
        });
    });
    $(function () {
       
        $.ajax({
            method:'GET',
            url:'{{url('journey/read')}}',
            success:function (data) {
                
                $.each(data,function(i,value){ 
                    if(value.vehical_id != null){
                        qEvent.push({ 
                            title : value.places_to_be_visited, // need place as the title
                            start : value.expected_start_date_time,
                            end : value.expected_end_date_time,
                            id :  value.id, 
                            applicant :value.emp_title+' '+value.emp_firstname+' '+value.emp_surname,                                                    
                            vehical_id : value.vehical_id,
                            borderColor: 'black',
                            status: value.status,
                            color : journey_colors[value.vehical_id]
                        });    
                    } 
                    else{
                        qEvent.push({ 
                            title : value.places_to_be_visited, // need place as the title
                            start : value.expected_start_date_time,
                            end : value.expected_end_date_time,
                            id :  value.id, 
                            applicant :value.emp_title+' '+value.emp_firstname+' '+value.emp_surname,                                                    
                            vehical_id : value.vehical_id,
                            borderColor: 'black',
                            status: value.status,
                            color : "#778899"
                        }); 
                    }               
                            
                });
                
            },
            error:function (err) {
                // alert(err.toString());
            },
            complete:function () {             
                $('#calendar').fullCalendar({
                    selectable: true,
                    defaultView:'agendaWeek',
                    defaultDate: $('#calendar').fullCalendar('today'),                        
                    header: {
                        left: 'prev,next today myCustomButton',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    googleCalendarApiKey: 'AIzaSyARu_beMvpDj95imxjje5NkAjrT7c3HluE',                   
                    //googleCalendarId: 'cmb.ac.lk_vma77hchj6o7jfqnnsssgivkeo@group.calendar.google.com'
                    events:qEvent,
                    eventClick: function(event, element) {
                        //console.log(event);
                        var moment = $('#calendar').fullCalendar('getDate');
                        
                        $.ajax({
                            url: '/journey/readJourneyForCreate/{id}',
                            type: 'GET',
                            data: { id: event.id },
                            success: function(data)
                            {
                                var details = JSON.parse(data);
                                    
                                $.confirm({
                                    title: 'Journey!', //Confirm
                                    content:"<h3>Place - "+ details[0].places_to_be_visited+"</h3>" + 
                                    "<h4>Applicant - "+ event.applicant +"</h4>"+
                                    "<h4>Status - "+ event.status +"</h4>"+
                                    "<h4>Start - "+ event.start.format('YYYY-MM-DD HH:mm:SS') + "</h4>" +
                                    "<h4>End - "+ event.end.format('YYYY-MM-DD HH:mm:SS') +"</h4>"+
                                    "<h4>Vehicle - "+ details[1] +"</h4>"+
                                    "<h4 id='test'>Driver - "+ details[3] +"</h4>",
                                    buttons: {
                                        somethingElse: {
                                            text: 'OK',
                                            btnClass: 'btn-blue',
                                            keys: ['enter', 'shift'],
                                            action: function(){
                                            }
                                        }
                                    }
                                });
                            
                            }
                        });                          
                    },
                    eventLimit: 2,
                    eventRender: function(event, element) {
                        element.find('.fc-title').append("<br/>" +event.applicant +"<br/>"+ event.status); 
                    }
                });               
                
            }
        });
    });
    
</script>


@endsection