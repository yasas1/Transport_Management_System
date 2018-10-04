@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')

    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css')}}">

@endsection

@section('header', 'View Journey Requests')

@section('description', 'Select a journey request to confirm.')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
    <div class="box" >
        <div class="box-header with-border">
            <h3 class="box-title">Confirmation Pending Journey Requests List</h3>
        </div>
        <button onclick="tableViewFunction()" class="btn btn-info btn-sm">Table View</button> <br><br>
    </div> 

    <div class="box box-primary" id="tabl" style="display: none; height: 400px; overflow: auto;" >
        <div class="box-body" >
            @if($journeys)

                <table class="table table-hover" id="table"  >
                    <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>Applicant Division</th>
                        <th>Vehicle</th>
                        <th>Start Date / Time</th>
                        <th>End Date / Time</th>
                        <th>Updated at</th>
                        <th width="200px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($journeys as $journey)
                        <tr>
                            <td>{{$journey->applicant->emp_surname}}</td>
                            <td>{{$journey->applicant->division->dept_name}}</td>
                            <td>{{$journey->vehical->fullname}}</td>
                            <td>{{$journey->expected_start_date_time->toDayDateTimeString()}}</td>
                            <td>{{$journey->expected_end_date_time->toDayDateTimeString()}}</td>
                            <td>{{$journey->applicant->emp_surname}}</td>

                            <td width="200px">
                                <button class="btn btn-success btnView" data-toggle="modal" data-target="#{{$journey->id}}"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Applicant Name</th>
                        <th>Applicant Division</th>
                        <th>Vehicle</th>
                        <th>Start Date / Time</th>
                        <th>End Date / Time</th>
                        <th>Updated at</th>
                        <th width="200px">Actions</th>
                    </tr>
                    </tfoot>
                </table>
                @foreach($journeys as $journey)
                    <div class="modal fade bs-example-modal-lg" id="{{$journey->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Journey Request Confirmation
                                                @if($journey->journey_status_id == 1)
                                                    <span class="label label-danger pull-right">Not Approved</span>
                                                    <span class="label label-danger pull-right">Not Confirmed</span>
                                                @endif
                                                @if($journey->journey_status_id == 2)
                                                    <span class="label label-success pull-right">Approved</span>
                                                    <span class="label label-danger pull-right">Not Confirmed</span>
                                                @endif
                                                @if($journey->journey_status_id == 3)
                                                    <span class="label label-success pull-right">Approved</span>
                                                    <span class="label label-danger pull-right">Confirmed</span>
                                                @endif
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <h4>Applicant</h4>
                                                <dt>Name</dt>
                                                <dd>{{$journey->applicant->emp_surname}}</dd>
                                                <dt>Division</dt>
                                                <dd>{{$journey->applicant->division->dept_name}}</dd>
                                                <dt>Email</dt>
                                                <dd>{{$journey->applicant->emp_email}}</dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <h4>Resources</h4>
                                                <dt>Vehicle Number</dt>
                                                <dd>{{$journey->vehical->registration_no}}</dd>
                                                <dt>Vehicle Name</dt>
                                                <dd>{{$journey->vehical->name}}</dd>
                                                <dt>Driver</dt>
                                                <dd>{{$journey->vehical->driver->fullname}}</dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt>Divisional Head</dt>
                                                <dd>{{$journey->divisional_head->emp_title.' '.$journey->divisional_head->emp_initials.'. '.$journey->divisional_head->emp_surname}}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <h4>Details</h4>
                                                <dt>Purpose</dt>
                                                <dd>{{$journey->purpose}}</dd>
                                                <dt>Places To Be Visited</dt>
                                                <dd>{{$journey->places_to_be_visited}}</dd>
                                                <dt>Number of Persons</dt>
                                                <dd>{{$journey->number_of_persons}}</dd>
                                                <dt>Approximate Distance</dt>
                                                <dd>{{$journey->expected_distance.' km'}}</dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <h4>Expected Date and Time Range</h4>
                                                <dt>Start Date/ Time</dt>
                                                <dd>{{$journey->expected_start_date_time->toDayDateTimeString()}}</dd>
                                                <dt>End Date/ Time</dt>
                                                <dd>{{$journey->expected_end_date_time->toDayDateTimeString()}}</dd>
                                                <dt>Journey Duration</dt>
                                                <dd>{{$journey->expected_end_date_time->diffInHours($journey->expected_start_date_time)}} hours</dd>
                                            </dl>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <dl class="dl-horizontal">
                                                <h4>Approval</h4>
                                                <dt>Approved By</dt>
                                                <dd>{{$journey->approvedBy->emp_title.' '.$journey->approvedBy->emp_initials.'. '.$journey->approvedBy->emp_surname}}</dd>
                                                <dt>Approved At</dt>
                                                <dd>{{$journey->approved_at->toDayDateTimeString()}}</dd>
                                                <dt>Remarks</dt>
                                                <dd>{{$journey->approval_remarks}}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <hr>
                                        <div class="col-md-12">
                                            <h4>Change Journey details</h4>
                                            {!! Form::model($journey,['method' => 'post','id'=>'formConfirmation'.$journey->id ,'action'=>['JourneyConfirmController@confirm',$journey->id]]) !!}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="vehical_id">Change Vehicle</label>
                                                        {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control','placeholder'=>'Select a Vehicle'])}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="driver_id">Change Driver</label>
                                                        {{Form::select('driver_id',$drivers,null,['class'=>'form-control ','placeholder'=>'Select a Vehicle'])}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="confirmed_start_date_time">Start Date/ Time</label>
                                                        {{Form::text('confirmed_start_date_time',null,['class'=>'form-control','id'=>'dtp'])}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="confirmed_end_date_time">End Date/ Time</label>
                                                        {{Form::text('confirmed_end_date_time',null,['class'=>'form-control','id'=>'dtp1'])}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirmation_remarks">Remarks</label>
                                                {{Form::textarea('confirmation_remarks',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2' ])}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-success" name="submitType" value="CONFIRM">
                                    <input type="submit" class="btn btn-danger" name="submitType" value="DENY">
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="col-sm-12 col-md-12">   
        <button  class="all"  style="height:25px;width:35px;border: 1px solid #555555;border-radius: 5px;" >ALL</button> 
        @foreach ($vehiclesForColor as $vehicle)
            <button class="vehiclebutton" value="{{$vehicle->id}}" id="v{{$vehicle->id}}" style="border: 1px solid #555555;border-radius: 5px;"> {{$vehicle->registration_no}} </button>   
        @endforeach
    </div>
    <br>   
    
    {{-- <button class="test1" id="test1" style="background-color:#03A6FD">Test1 </button>  --}}

    <div class="col-sm-12 col-md-12">
        <div class="col-sm-11 col-md-11"> </div>
        <div class="col-sm-1 col-md-1">
            <button onclick="resetFunction()" class="btn btn-primary btn-xs" id="reset" style="height:23px;">RELOAD</button>
        </div>
    </div>
    <br><br>
    <div class="col-md-12">
        <div class="box box-primary">
            {{-- <div class="box-header with-border">
                <h3 class="box-title">Comfirm Journey Calender</h3>
            </div> --}}
            <div class="box-body">
                <div id='calendar'></div>
            </div>          
        </div>      
    </div>

        <!-- For Calender Event Click-->
<div id="modal" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Journey Request Confirmation                                   
                            <span class="label label-success pull-right">Approved</span>
                            <span class="label label-danger pull-right">Not Confirmed</span>                                
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
                            {{-- <dt>Journey Duration</dt>
                             {{$journey->expected_end_date_time->diffInHours($journey->expected_start_date_time)}} hours 
                            <dd></dd> --}}
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
                        {{-- {!! Form::open(['method' => 'post','id'=>'formConfirmationAjax','action'=>"JourneyConfirmController@confirmAjax" ]) !!}  --}}
                        <form action="{{ URL::to('/journey/request/confirmAjax')}}" method="POST" id="formConfirmationAjax">
                            {{csrf_field()}}
                        <input type="hidden" name="id" id="journeyid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehical_id">Change Vehicle</label>
                                    {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control','placeholder'=>'Select a Vehicle'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="driver_id">Change Driver</label>
                                    {{Form::select('driver_id',$drivers,null,['class'=>'form-control ','placeholder'=>'Select a Vehicle'])}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirmed_start_date_time">Start Date/ Time</label>
                                    {{Form::text('confirmed_start_date_time',null,['class'=>'form-control','id'=>'dtpStart' ,'required'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirmed_end_date_time">End Date/ Time</label>
                                    {{Form::text('confirmed_end_date_time',null,['class'=>'form-control','id'=>'dtpEnd','required'])}}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirmation_remarks">Remarks</label>
                            {{Form::textarea('confirmation_remarks',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2' , 'required' ])}}
                        </div>
                        <div class="form-group">
                            <label for="is_approved">CONFIRM</label> 
                            {!! Form::checkbox('is_confirm', 1, true) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <input type="submit" class="btn btn-success" name="submit" value="SUBMIT">
                    <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>
                    </form>
                    {{-- {!! Form::close() !!} --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable( {
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
            } );
        } );
    </script>

<script type="text/javascript">
    $(function () {
        $('#dtp,#dtp1').daterangepicker({
            "singleDatePicker": true,
            "timePicker": true,
            "linkedCalendars": false,
            "showCustomRangeLabel": false,
            "timePicker24Hour": true,
            "minDate": moment(),
            drops:"up",
            locale: {
                format: 'MM/DD/YYYY HH:mm'
            }
            
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD HH:mm') + ' to ' + end.format('YYYY-MM-DD HH:mm') + ' (predefined range: ' + label + ')');
        });
        $('#dtp').on('show.daterangepicker', function(e){
            var modalZindex = $(e.target).closest('.modal').css('z-index');
            $('.daterangepicker').css('z-index', modalZindex+100);
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('#dtpStart,#dtpEnd').daterangepicker({
            "singleDatePicker": true,
            "timePicker": true,
            "linkedCalendars": false,
            "showCustomRangeLabel": false,
            "timePicker24Hour": true,
            "minDate": moment(),
            drops:"up",
            locale: {
                format: 'MM/DD/YYYY HH:mm'
            }
            
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD HH:mm') + ' to ' + end.format('YYYY-MM-DD HH:mm') + ' (predefined range: ' + label + ')');
        });
        // $('#dtpStart').on('show.daterangepicker', function(e){
        //     var modalZindex = $(e.target).closest('.modal').css('z-index');
        //     $('.daterangepicker').css('z-index', modalZindex+100);
        // });
    });
</script>
            {{-- Script for calender view  --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js')}}"></script>
<script src='{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/gcal.min.js')}}'></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script>
     
    var qEvent=[];  
                
    var journey_colors = [];
                /*Get Journey color from db */
    $.get("{{ URL::to('journey/readVehicleColor/') }}",function(data){ 
        
        $.each(data,function(i,value){  
            //console.log(value.id);
            $('#v'+value.id).css('background-color','#'+value.journey_color); // For button color
            journey_colors[value.id]='#'+value.journey_color; // Journey colors for event
        });
        
    });

    $.get("{{ URL::to('journey/readForConfirmation') }}",function(data){ 
        $.each(data,function(i,value){       
            qEvent.push(
                { 
                    title : value.purpose,
                    start : value.expected_start_date_time,
                    end : value.expected_end_date_time,
                    id :  value.id,                                                     
                    vehical_id : value.vehical_id, 
                    borderColor: 'black',                   
                    color :  journey_colors[value.vehical_id]    
                }
            );
        });
    });

    $(document).ready(function(){

        $('.test1').click(function(evt){
            
            $('#test1').css('background-color',ColorLuminance("03A6FD", 0.3));
            //console.log(ColorLuminance("03A6FD", 0.3)); 
        });
                /* Function for change color light */
        /* lum — the luminosity factor, i.e. -0.1 is 10% darker, 0.2 is 20% lighter */
        function ColorLuminance(hex, lum) {
           
            // validate hex string ColorLuminance("03A6FD", 0.2) lighten( $base-color, 10% )
            hex = String(hex).replace(/[^0-9a-f]/gi, '');
            if (hex.length < 6) {
                hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
            }
            lum = lum || 0;

            // convert to decimal and change luminosity
            var rgb = "#", c, i;
            for (i = 0; i < 3; i++) {
                c = parseInt(hex.substr(i*2,2), 16);
                c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                rgb += ("00"+c).substr(c.length);
            }

            return rgb;
        }

        //$('.colorbutton').css('background','#7CFD03');
	    $(".vehiclebutton").click(function(evt){
	        var vid = $(this).attr("value");   // Vehivle_id from Vehicle_Button
            //$(vid).css('background','#05DCB2');
            qEvent=[];                       
            $('#calendar').fullCalendar('removeEvents');
            $.ajax({
                url: '/journey/ForConfirmationByVehicle/{id}',
                type: 'GET',
                data: { id: vid },
                success: function(data)
                {
                    //console.log(data);              
                    $(data).each(function (i,value) {                
                        qEvent.push(
                        { 
                            title : value.purpose,
                            start : value.expected_start_date_time,
                            end : value.expected_end_date_time,
                            id :  value.id,                                                     
                            vehical_id : value.vehical_id,
                            borderColor: 'black', 
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
            $.get("{{ URL::to('journey/readForConfirmation') }}",function(data){ 
                $.each(data,function(i,value){       
                    qEvent.push(
                    { 
                        title : value.purpose,
                        start : value.expected_start_date_time,
                        end : value.expected_end_date_time,
                        id :  value.id,                                                     
                        vehical_id : value.vehical_id, 
                        borderColor: 'black',
                        color :  journey_colors[value.vehical_id]    
                    });                  
                });
                $('#calendar').fullCalendar('addEventSource', qEvent);
                $('#calendar').fullCalendar('refetchEvents');
            });                      
            
	    });
    });
        /* For, After confirmation modal is closed, refetch the events  */
    // $("#close").click(function(evt){
    //         $('#calendar').fullCalendar('removeEvents');
    //         $('#calendar').fullCalendar('addEventSource', qEvent);
	//         $('#calendar').fullCalendar('refetchEvents');
	// });
   
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
                console.log(aaa);
                $('#calendar').fullCalendar({
                    selectable: true,
                    editable:true,
                    //selectHelper:true,
                    defaultView:'month', //agendaWeek
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

                        $.ajax({
                            url: '/journey/read/{id}',
                            type: 'GET',
                            data: { id: event.id },
                            success: function(data)
                            {
                                var details = JSON.parse(data);
                                // console.log(details[0].expected_distance);
                                console.log(details[7]);

                                $('#purpose').html(details[0].purpose);
                                $('#places_to_be_visited').html(details[0].places_to_be_visited);
                                $('#number_of_persons').html(details[0].number_of_persons);
                                $('#expected_distance').html(details[0].expected_distance); 
                                $('#expected_start_date_time').html(details[10]);  
                                $('#expected_end_date_time').html(details[11]);                            
                                $('#approved_at').html(details[9]);     
                                $('#approval_remarks').html(details[0].approval_remarks);
                                $('#journeyid').val(details[0].id); 

                                $('#approved_by').html(details[8]);

                                $('#appl_name').html(details[4]);
                                $('#appl_dept').html(details[5]);
                                $('#appl_email').html(details[6]); 
                                $('#driver').html(details[3]);
                                $('#vehicle_number').html(details[1]);
                                $('#vehicle_name').html(details[2]);  
                                $('#devisional_head').html(details[7]);

                            }
                        });
                        $('#modal').modal('toggle');
                    }, 
                    dayClick: function(date) {
                        //alert('clicked ' + date.format());
                    },
                    select: function(startDate, endDate) {                          
                        // $('#dtp').val(startDate.format());                      
                    },
                    eventDrop: function (event, delta) {

                        $('#dtpStart').val(event.start.format('MM/DD/YYYY HH:mm'));
                        $('#dtpEnd').val(event.end.format('MM/DD/YYYY HH:mm'));

                        $.ajax({
                            url: '/journey/read/{id}',
                            type: 'GET',
                            data: { id: event.id },
                            success: function(data)
                            {
                                var details = JSON.parse(data);
                                // console.log(details[0].expected_distance);

                                console.log(details[7]);

                                $('#purpose').html(details[0].purpose);
                                $('#places_to_be_visited').html(details[0].places_to_be_visited);
                                $('#number_of_persons').html(details[0].number_of_persons);
                                $('#expected_distance').html(details[0].expected_distance); 
                                $('#expected_start_date_time').html(details[10]);  
                                $('#expected_end_date_time').html(details[11]);                            
                                $('#approved_at').html(details[9]);     
                                $('#approval_remarks').html(details[0].approval_remarks);
                                $('#journeyid').val(event.id); 

                                $('#approved_by').html(details[8]);

                                $('#appl_name').html(details[4]);
                                $('#appl_dept').html(details[5]);
                                $('#appl_email').html(details[6]); 
                                $('#driver').html(details[3]);
                                $('#vehicle_number').html(details[1]);
                                $('#vehicle_name').html(details[2]);  
                                $('#devisional_head').html(details[7]);

                            }
                        });

                        $('#modal').modal('toggle');
                    },
                    eventResize: function(event, delta, revertFunc) {

                        $('#dtpStart').val(event.start.format('MM/DD/YYYY HH:mm'));
                        $('#dtpEnd').val(event.end.format('MM/DD/YYYY HH:mm'));
                        console.log(event.start.format('MM/DD/YYYY HH:mm'));
                    
                        $.ajax({
                            url: '/journey/read/{id}',
                            type: 'GET',
                            data: { id: event.id },
                            success: function(data)
                            {
                                var details = JSON.parse(data);
                                // console.log(details[0].expected_distance);

                                console.log(details[7]);

                                $('#purpose').html(details[0].purpose);
                                $('#places_to_be_visited').html(details[0].places_to_be_visited);
                                $('#number_of_persons').html(details[0].number_of_persons);
                                $('#expected_distance').html(details[0].expected_distance); 
                                $('#expected_start_date_time').html(details[10]);  
                                $('#expected_end_date_time').html(details[11]);                            
                                $('#approved_at').html(details[9]);     
                                $('#approval_remarks').html(details[0].approval_remarks);
                                $('#journeyid').val(event.id); 

                                $('#approved_by').html(details[8]);

                                $('#appl_name').html(details[4]);
                                $('#appl_dept').html(details[5]);
                                $('#appl_email').html(details[6]); 
                                $('#driver').html(details[3]);
                                $('#vehicle_number').html(details[1]);
                                $('#vehicle_name').html(details[2]);  
                                $('#devisional_head').html(details[7]);

                            }
                        });
                        $('#modal').modal('toggle');
                        
                    }
               });
           }
       })
    });
</script> 

<script>

    $('#formConfirmationAjax').on('submit',function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.post(url,data,function(data){
            console.log(data);           
            //window.location.reload(true);
            window.setTimeout(function(){ 
                location.reload();
            } ,1000);                     
        });       
    });
    
</script>

<script>
        //for hide and view table content 
        function tableViewFunction() {
            var x = document.getElementById("tabl");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function resetFunction() {
            location.reload();
        }

</script>

@endsection