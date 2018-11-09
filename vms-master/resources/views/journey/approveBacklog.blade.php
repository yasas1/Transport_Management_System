@extends('layouts.master')

@section('title', 'JOURNEY | VEHICLE MANAGEMENT SYSTEM')

@section('styles')
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css')}}">
@endsection

@section('header', 'Approve Backlog Journey')

@section('description', 'Select Joureny to approve the backlog journey.')

@section('content')

    <div class="col-md-12">
        <div class="hidden">
            @include('layouts.errors')
            @include('layouts.success')
        </div>

    </div>
    <div class="col-sm-12 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Vehicle Calender</h3>
            </div>
            <div>   
                <button  class="all"  style="height:25px;width:35px;border: 1px solid #555555;border-radius: 5px;" >ALL</button> 
                @foreach ($vehicles as $vehicle)
                    <button class="vehiclebutton" value="{{$vehicle->id}}" id="v{{$vehicle->id}}" style="border: 1px solid #555555;border-radius: 5px;"> {{$vehicle->registration_no}} </button>   
                @endforeach
                <button  class="external"  style="height:25px;width:65px;border: 1px solid #555555;border-radius: 5px; background-color:#778899;" >External</button> 
            </div>
                <!-- THE CALENDAR -->
            <div class="box-body">
                <div id='calendar'></div>
            </div>           
        </div>
    </div>
    

    <div class="aletr alert-successs" id="aaa">aaaa</div>

    <!-- For Calender Event Click-->
<div id="modal" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="row">
                    <div class="col-md-12">
                        <h3> Backlog Journey                                  
                            <span class="label label-danger pull-right">Not Approved</span>                                
                        </h3>
                    </div>
                </div>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <dl class="dl-horizontal">
                            <h4>Applicant</h4>
                            <dt >Name</dt>
                            <dd id="appl_name"> </dd>
                            <dt >Division</dt>
                            <dd id="appl_dept"></dd>
                            <dt>Email</dt>
                            <dd id="appl_email"></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <h4>Resources</h4>
                            <dt>Vehicle Number</dt>
                            <dd id="vehicle_number"> </dd>
                            <dt>Vehicle Name</dt>
                            <dd id="vehicle_name"></dd>
                            <dt>Driver</dt>
                            <dd id="driver"></dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <dt>Divisional Head</dt>                           
                            <dd id="devisional_head"> </dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="dl-horizontal">
                            <h4>Details</h4>
                            <dt>Purpose</dt>
                            <dd id="purpose"></dd>
                            <dt>Places To Be Visited</dt>
                            <dd id="places_to_be_visited"></dd>
                            <dt>Number of Persons</dt>
                            <dd id="number_of_persons"></dd>
                            <dt>Approximate Distance  km</dt>
                            <dd id="expected_distance">  </dd>
                        </dl>
                        <dl class="dl-horizontal">
                            <h4>Expected Date and Time Range</h4>
                            <dt>Start Date/ Time</dt>
                            <dd id="expected_start_date_time"></dd>
                            <dt>End Date/ Time</dt>
                            <dd id="expected_end_date_time"></dd>
                        </dl>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <dl class="dl-horizontal">
                            <h4>Approval</h4>
                            <dt>Approved By</dt>
                            <dd id="approved_by"></dd>
                            <dt>Approved At</dt>
                            <dd id="approved_at"></dd>
                            <dt>Remarks</dt>
                            <dd id="approval_remarks"></dd>
                        </dl>
                    </div>
                </div>

                <div class="row">                
                    <div class="col-md-12">
                        <hr>
                        <h4>Change Journey details</h4>
                        
                        {{-- <form action="{{ URL::to('/journey/request/confirmAjax')}}" method="POST" id="formConfirmationAjax"> --}}
                        {!! Form::open(['method' => 'post','id'=>'formCancel','action'=>['JourneyController@cancel']]) !!} 
                            {{csrf_field()}}
                        <input type="hidden" name="id" id="journeyid">
                       
                        <div class="form-group">
                            <label for="confirmation_remarks">Remarks</label>
                            {{Form::textarea('confirmation_remarks',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2' ])}}
                        </div>

                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="col-md-5">
                        <input type="submit" class="btn btn-success" name="submit" value="CONFIRM"> 
                        {!! Form::close() !!} 
                  
                    </div>
                </div> 
           
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">                           
                            <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>                                      
                        </div>    
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">      
            </div> --}}
        </div>
    </div>
</div>

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
        $.get("{{ URL::to('journey/readBcaklogJourney') }}",function(data){ 
            //console.log(data);
            $.each(data,function(i,value){ 
                if(value.vehical_id != null){
                    qEvent.push({ 
                        title : value.places_to_be_visited, // need place as the title
                        start : value.real_start_date_time,
                        end : value.real_end_date_time,
                        id :  value.id, 
                        applicant :value.emp_title+' '+value.emp_firstname+' '+value.emp_surname,                                                    
                        vehical_id : value.vehical_id,
                        borderColor: 'black',
                        status: value.status,
                        color : journey_colors[value.vehical_id]
                    });    
                } 
                else{        //for external vehicle color
                    qEvent.push({ 
                        title : value.places_to_be_visited, 
                        start : value.real_start_date_time,
                        end : value.real_end_date_time,
                        id :  value.id, 
                        applicant :value.emp_title+' '+value.emp_firstname+' '+value.emp_surname,                                                    
                        vehical_id : value.vehical_id,
                        borderColor: 'black',
                        status: value.status,
                        color : "#778899"
                    }); 
                }               
                           
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
                    url: '/journey/ForCreateBacklogByVehicle/{id}',
                    type: 'GET',
                    data: { id: vid },
                    success: function(data)
                    {
                        console.log(data);              
                        $(data).each(function (i,value) {                
                            qEvent.push(
                            { 
                                title : value.places_to_be_visited,
                                start : value.real_start_date_time,
                                end : value.real_end_date_time,
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
                $.get("{{ URL::to('journey/readBcaklogJourney') }}",function(data){ 
                    $.each(data,function(i,value){       
                        if(value.vehical_id != null){
                            qEvent.push({ 
                                title : value.places_to_be_visited, // need place as the title
                                start : value.real_start_date_time,
                                end : value.real_end_date_time,
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
                                start : value.real_start_date_time,
                                end : value.real_end_date_time,
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
                $.get("{{ URL::to('journey/readExternalBacklog') }}",function(data){
                    console.log(data); 
                    $.each(data,function(i,value){       
                        qEvent.push(
                        { 
                            title : value.places_to_be_visited,
                            start : value.real_start_date_time,
                            end : value.real_end_date_time,
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
            var aaa;
           $.ajax({
                method:'GET',
                url:'{{url('/google/calenders')}}',
                success:function (data) {
                    var eventSources = [];

                    $.each(data,function (i,item) {
                        var event = {};
                        event.id = i;
                        event.googleCalendarId = item.id;
                        event.color = item.backgroundColor;
                        eventSources.push(event)
                        $('#aaa').append(item.id);
                    });
                    aaa = eventSources;
                },
                error:function (err) {
                   // alert(err.toString());
                },
                complete:function () {             
                   //console.log(aaa);
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
                        eventSources: aaa,
                        eventClick: function(event, element) {
                            //console.log(event);
                            var moment = $('#calendar').fullCalendar('getDate');
                            
                            // $('#dtpStart').val(event.start.format('MM/DD/YYYY HH:mm'));
                            // $('#dtpEnd').val(event.end.format('MM/DD/YYYY HH:mm'));

                            $.ajax({
                                url: '/journey/read/{id}',
                                type: 'GET',
                                data: { id: event.id },
                                success: function(data)
                                {
                                    var details = JSON.parse(data);

                                    //console.log(details[0].vehical_id); //vehicle_select

                                    $('#purpose').html(details[0].purpose);
                                    $('#places_to_be_visited').html(details[0].places_to_be_visited);
                                    $('#number_of_persons').html(details[0].number_of_persons);
                                    $('#expected_distance').html(details[0].expected_distance); 
                                    $('#expected_start_date_time').html(details[10]);  
                                    $('#expected_end_date_time').html(details[11]);                            
                                    $('#approved_at').html(details[9]);     
                                    $('#approval_remarks').html(details[0].approval_remarks);
                                    $('#journeyid').val(details[0].id); 
                                    $('#journeyId').val(details[0].id);  
                                    $('#Id').val(details[0].id);                             

                                    $('#approved_by').html(details[8]);

                                    $('#appl_name').html(details[4]);
                                    $('#appl_dept').html(details[5]);
                                    $('#appl_email').html(details[6]); 
                                    $('#driver').html(details[3]);
                                    $('#vehicle_number').html(details[1]);
                                    $('#vehicle_name').html(details[2]);  
                                    $('#devisional_head').html(details[7]);

                                    document.getElementById('vehicle_select').value=details[0].vehical_id ; 
                                    document.getElementById('driverid').value=details[0].driver_id ; 
                                    // $('#vehicle_select').val(details[0].vehical_id).change();
                                    // $('#driverid').val(details[0].driver_id).change();                          
                                }
                            });
                            $('#modal').modal('toggle');                         
                        },
                        eventLimit: 2,
                        eventRender: function(event, element) {
                            element.find('.fc-title').append("<br/>" +event.applicant +"<br/>"+ event.status); 
                        },
                        dayClick: function(date) {
                            //alert('clicked ' + date.format());
                        },
                        select: function(startDate, endDate) {                 
                            //$('#myModal').modal('toggle');
                            //alert('selected ' + startDate.format() + ' to ' + endDate.format());
                            // $('#dtp').val(startDate.format('MM/DD/YYYY HH:mm')+' - '+endDate.format('MM/DD/YYYY HH:mm'));
                            $('#dtp').val(startDate.format()+' - '+endDate.format())
                        }
                    });
                }
            })
        });  
           
    </script>

    <script>
        $('.cmbDivHead').on('click',function () {
            $('#txtDivisionalHead').val($(this).attr('data-value'));
            $('#divDiviHead').html($(this).html());
        });
        $('.cmbApplicant').on('click',function () {   
            $('#textApplicant').val($(this).attr('data-value'));
            $('#divApplicant').html($(this).html());
        });
        $('.cmbApprovedBy').on('click',function () {
            $('#txtApprovedBy').val($(this).attr('data-value'));
            $('#divApprovedBy').html($(this).html());
        });

        
    </script>
    
    <script type="text/javascript">
        
        $(function () {
            $('#dtp').daterangepicker({
                "timePicker": true,
                "linkedCalendars": false,
                "showCustomRangeLabel": false,
                "timePicker24Hour": true,
                locale: {
                    format: 'MM/DD/YYYY HH:mm'
                }
            },function(start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD HH:mm') + ' to ' + end.format('YYYY-MM-DD HH:mm') + ' (predefined range: ' + label + ')');                 
            });
        });
        $('#txtDistance').on('keyup',function () {
           var val = $(this).val();
           if(parseInt(val)>=150){
                $('#txtDistanceHelpBox').html('Director approval is required for long distance ( more than 150km ) journeys.');
           }else {
               $('#txtDistanceHelpBox').html('');
           }
        });
        // $('#dtp').on('keyup change',function () {
           
        //     console.log( 'check change' );  
        // });
    </script>

<script>

    $(document).ready(function() {

        $("#company").hide();
        $("#companycost").hide();

        $(".vehicle").on('change',function(evt){
        
            var vehicle = $(this).val();
            if( vehicle == 0 ){
                $("#company").show();
                $("#companycost").show();
                $("#driverdiv").hide();
            }
            else{
                $("#company").hide();
                $("#companycost").hide();
                $("#driverdiv").show();
            }

        });

        $("#close").on('click',function(evt){
            $("#company").hide();
            $("#companycost").hide();
            $("#driverdiv").show();
            console.log("vehicle");
        });

    });
</script>

@endsection