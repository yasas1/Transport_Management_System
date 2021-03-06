@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css')}}">
@endsection

@section('header', 'My Journey Requests')

@section('description', 'Select a journey to view details.')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')

    <div class="box box-primary">
   
        <div class="box-header with-border" >
            <h3 class="box-title">My Journey Requests</h3>
        </div>
        @if($journeys)
                <!-- for hide and view table content -->
        <button onclick="tableViewFunction()" class="btn btn-info">Table View </button> <br>

        <div id="hidetable" class="box-body" style="display: none;">
                   
            <table class="table" id="table" style="display: none; height:300px; overflow: auto;" >
                <thead>
                <tr>
                    <th>Applicant Name</th>
                    <th>Applicant Division</th>
                    <th>Vehicle</th>
                    <th>Start Date / Time</th>
                    <th>End Date / Time</th>
                    <th width="200px">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($journeys as $journey)
                    <tr>
                        <td>{{$journey->applicant->emp_title.' '.$journey->applicant->emp_initials.'. '.$journey->applicant->emp_surname}}</td>
                        <td>{{$journey->applicant->division->dept_name}}</td>
                        @if($journey->vehical_id != null)
                            <td>{{$journey->vehical->fullname}}</td>
                        @endif
                        @if($journey->vehical_id == null)
                            <td>External Vehicle</td>
                        @endif
                        @if($journey->expected_start_date_time == null)
                            <td>{{$journey->real_start_date_time->toDayDateTimeString()}}</td>
                            <td>{{$journey->real_end_date_time->toDayDateTimeString()}}</td>
                        
                        @endif
                        @if($journey->expected_start_date_time != null)
                            <td>{{$journey->expected_start_date_time->toDayDateTimeString()}}</td>
                            <td>{{$journey->expected_end_date_time->toDayDateTimeString()}}</td>
                        @endif
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
                                            @if($journey->journey_status_id == 4)
                                                <span class="label label-success pull-right">Approved</span>
                                                <span class="label label-success pull-right">Confirmed</span>
                                                <span class="label label-info pull-right">Ongoing</span>
                                            @endif
                                            @if($journey->journey_status_id == 5)
                                                <span class="label label-success pull-right">Approved</span>
                                                <span class="label label-danger pull-right">Confirmation Rejected</span>
                                            @endif
                                            @if($journey->journey_status_id == 6)
                                                <span class="label label-success pull-right">Approved</span>
                                                <span class="label label-success pull-right">Confirmed</span>
                                                <span class="label label-success pull-right">Completed</span>
                                            @endif
                                            @if($journey->journey_status_id == 7)
                                                <span class="label label-info pull-right">Cancelled</span>
                                            
                                            @endif
                                            @if($journey->expected_start_date_time == null)
                                                <span class="label label-info pull-right">Backlog</span>
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
                                            <dd>{{$journey->applicant->emp_title.' '.$journey->applicant->emp_initials.'. '.$journey->applicant->emp_surname}}</dd>
                                            <dt>Division</dt>
                                            <dd>{{$journey->applicant->division->dept_name}}</dd>
                                            <dt>Email</dt>
                                            <dd>{{$journey->applicant->emp_email.'@ucsc.cmb.ac.lk'}}</dd>
                                        </dl>
                                        <dl class="dl-horizontal">
                                            <h4>Resources</h4>
                                            @if($journey->vehical_id != null)
                                                <dt>Vehicle Number</dt>
                                                <dd>{{$journey->vehical->registration_no}}</dd>
                                                <dt>Vehicle Name</dt>
                                                <dd>{{$journey->vehical->name}}</dd>
                                                <dt>Driver</dt>
                                                <dd>{{$journey->vehical->driver->fullname}}</dd>
                                            @endif
                                            @if($journey->vehical_id ==null)
                                                <dt>Vehicle</dt>
                                                <dd>External Vehicle</dd>
                                            @endif
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
                                            @if($journey->expected_distance != null)
                                            <dt>Expected Distance</dt>
                                            <dd>{{$journey->expected_distance.' km'}}</dd>
                                            @endif
                                        </dl>
                                        @if($journey->expected_start_date_time != null)
                                        <dl class="dl-horizontal">
                                            <h4>Expected Date and Time Range</h4>
                                            <dt>Start Date/ Time</dt>
                                            <dd>{{$journey->expected_start_date_time->toDayDateTimeString()}}</dd>
                                            <dt>End Date/ Time</dt>
                                            <dd>{{$journey->expected_end_date_time->toDayDateTimeString()}}</dd>
                                            <dt>Journey Duration</dt>
                                            <dd>{{$journey->expected_end_date_time->diffInHours($journey->expected_start_date_time)}} hours</dd>
                                        </dl>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    @if($journey->approved_by != null)
                                    <div class="col-md-6">
                                        <dl class="dl-horizontal">
                                            <h4>Approval</h4>
                                            <dt>Approved By</dt>
                                            <dd>{{$journey->approvedBy->emp_title.' '.$journey->approvedBy->emp_initials.'. '.$journey->approvedBy->emp_surname}}</dd>
                                            @if($journey->approved_at != null)
                                            <dt>Approved At</dt>
                                            <dd>{{$journey->approved_at->toDayDateTimeString()}}</dd>
                                            @endif
                                            <dt>Remarks</dt>
                                            <dd>{{$journey->approval_remarks}}</dd>
                                        </dl>
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                        @if($journey->confirmed_by != null)
                                        <dl class="dl-horizontal">
                                            <h4>Confirmaion</h4>
                                            <dt>Confirmed By</dt>
                                            <dd>{{$journey->confirmedBy->emp_title.' '.$journey->confirmedBy->emp_initials.'. '.$journey->confirmedBy->emp_surname}}</dd>
                                            @if($journey->confirmed_at != null)
                                            <dt>Confirmed At</dt>
                                            <dd>{{$journey->confirmed_at->toDayDateTimeString()}}</dd>
                                            @endif
                                            <dt>Remarks</dt>
                                            <dd>{{$journey->confirmation_remarks}}</dd>
                                            @if($journey->confirmed_start_date_time != null)
                                            <dt>Confirmed Start Time</dt>
                                            <dd>{{$journey->confirmed_start_date_time->toDayDateTimeString()}}
                                                @if($journey->expected_start_date_time->diffInSeconds($journey->confirmed_start_date_time))
                                                    <span class="label label-warning">Changed</span>
                                                @else
                                                    <span class="label label-success">Not Changed</span>
                                                @endif
                                            </dd>
                                            @endif
                                            @if($journey->confirmed_start_date_time != null)
                                            <dt>Confirmed End Time</dt>
                                            <dd>{{$journey->confirmed_end_date_time->toDayDateTimeString()}}
                                                @if($journey->expected_end_date_time->diffInSeconds($journey->confirmed_end_date_time))
                                                    <span class="label label-warning">Changed</span>
                                                @else
                                                    <span class="label label-success">Not Changed</span>
                                                @endif
                                            </dd>
                                            @endif

                                        </dl>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    @if($journey->vehical_id != null || $journey->journey_status_id == 6 || $journey->vehical_id == 8)
                                        <div class="col-md-6">
                                            @if($journey->journey_status_id != 4 && $journey->journey_status_id != 2)
                                            <dl class="dl-horizontal">
                                                @if($journey->real_start_date_time != null)
                                                <h4>Final Details</h4>
                                                @endif
                                                @if($journey->vehical_id != null && $journey->driver_completed_at != null)
                                                    <dt>Driver Filled At</dt>
                                                    <dd>{{$journey->driver_completed_at->toDayDateTimeString()}}</dd>
                                                @endif
                                                @if($journey->vehical_id != null && $journey->driver_remarks != null)
                                                    <dt>Driver Remarks</dt>
                                                    <dd>{{$journey->driver_remarks}}</dd>
                                                @endif
                                                
                                                @if($journey->real_start_date_time != null)
                                                    @if($journey->real_distance != null)
                                                    <dt>Approximate Distance</dt>
                                                    <dd>{{$journey->real_distance}}</dd>
                                                    @endif
                                                    <dt>Start Time</dt>
                                                    <dd>{{$journey->real_start_date_time->toDayDateTimeString()}}</dd>
                                                    <dt>End Time</dt>
                                                    <dd>{{$journey->real_end_date_time->toDayDateTimeString()}}</dd>
                                                    <dt>Total Hours</dt>
                                                    <dd>{{$journey->real_start_date_time->diffInHours($journey->real_end_date_time)}} hours</dd>
                                                @endif
                                            </dl>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-success" data-dismiss="modal"  value="OK">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach                     
        </div>
        @endif
    </div>
    <div class="col-md-12"> 
        <button  class="all"  style="height:25px;width:35px;border: 1px solid #555555;border-radius: 5px;" >ALL</button>
        @foreach ($vehicles as $vehicle)
            <button class="vehiclebutton" value="{{$vehicle->id}}" id="v{{$vehicle->id}}" style="border: 1px solid #555555;border-radius: 5px;"> {{$vehicle->registration_no}} </button>   
        @endforeach
        @if(Auth::user()->role_id != 4)
            <button  class="external"  style="height:25px;width:65px;border: 1px solid #555555;border-radius: 5px; background-color:#778899;" >External</button>  
        @endif
    </div>
    <br><br>
    <!-- For Calender View -->
    <div class="col-md-12">
        <div class="box box-primary">        
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
                                <span class="label label-success pull-right">Confirmed</span>
                                <span class="label label-success pull-right">Completed</span>                               
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
                                <div id="vehicle_internal">
                                    <dt>Vehicle Number</dt>
                                    <dd id="vehicle_number"> </dd>
                                    <dt>Vehicle Name</dt>
                                    <dd id="vehicle_name"></dd>
                                    <dt>Driver</dt>
                                    <dd id="driver"></dd>
                                </div>
                                <div id="vehicle_external">
                                    <dt>Vehicle</dt>
                                    <dd>External Vehicle</dd>
                                    <dt>External Company</dt>
                                    <dd id="external_company"></dd>
                                    <dt>External Cost</dt>
                                    <dd id="external_cost"></dd>
                                </div>
                                
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
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <h4>Confirmaion</h4>
                                <dt>Confirmed By</dt>                              
                                <dd id="confirm_by"></dd>
                                <dt>Confirmed At</dt>
                                <dd id="confirm_at"></dd>
                                <dt>Remarks</dt>
                                <dd id="confirm_remarks"></dd>
                                <dt>Confirmed Start Time</dt>
                                <dd id="confirmed_start_date_time"> </dd>
                                <dt>Confirmed End Time</dt>
                                <dd id="confirmed_end_date_time"> </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <h4>Final Details</h4>
                                <div id="final_internal">
                                    <dt>Driver Filled At</dt>
                                    {{-- {{$journey->driver_completed_at->toDayDateTimeString()}} --}}
                                    <dd id="driver_completed_at"></dd>
                                    <dt>Driver Remarks</dt>
                                    {{-- {{$journey->driver_remarks}} --}}
                                    <dd id="driver_remarks"></dd>
                                </div>
                                <div id="final_external">
                                    <dt>Completed At</dt>                              
                                    <dd id="completed_at"></dd>
                                    <dt>Completed Remarks</dt>                               
                                    <dd id="completed_remarks"></dd>
                                </div>
                                <dt>Approximate Distance</dt>
                                {{-- {{$journey->real_distance}} --}}
                                <dd id="real_distance"></dd>
                                <dt>Start Time</dt>
                                {{-- {{$journey->real_start_date_time}} --}}
                                <dd id="real_start_date_time"></dd>
                                <dt>End Time</dt>
                                {{-- {{$journey->real_end_date_time}} --}}
                                <dd id="real_end_date_time"></dd>
                                {{-- <dt>Total Hours</dt>
                                <dd>{{$journey->real_start_date_time->diffInHours($journey->real_end_date_time)}} hours</dd> --}}
                                
                            </dl>
                        </div>
                    </div>                   
                </div>
                <div class="modal-footer">                       
                    <button type="button" class="btn btn-primary" data-dismiss="modal"> OK </button>                        
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

{{-- Script for calender view --}}

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js')}}"></script>
<script src='{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/gcal.min.js')}}'></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script>

    var qEvent=[];

    var journey_colors = [];///journey/readVehicle/
    $.get("{{ URL::to('journey/readVehicleColor/') }}",function(data){ 
        
        $.each(data,function(i,value){
            $('#v'+value.id).css('background-color','#'+value.journey_color); // For button color       
            journey_colors[value.id]='#'+value.journey_color;
        });
        //console.log(journey_colors);
    });

    $(document).ready(function(){
        //$('.colorbutton').css('background','#7CFD03');
        $(".vehiclebutton").click(function(evt){
            var vid = $(this).attr("value");   // Vehivle_id from Vehicle_Button
            //$(vid).css('background','#05DCB2');
            qEvent=[];                       
            $('#calendar').fullCalendar('removeEvents');
            $.ajax({
                url: "{{ URL::to('/journey/myJourneyByVehicle/{id}') }}",
                type: 'GET',
                data: { id: vid },
                success: function(data)
                {            
                    $(data).each(function (i,value) {     
                        if(value.expected_start_date_time == null){
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
                            title : value.places_to_be_visited,
                            start : value.expected_start_date_time,
                            end : value.expected_end_date_time,
                            id :  value.id,                                                     
                            applicant :value.emp_title+' '+value.emp_firstname+' '+value.emp_surname,                                             
                            vehical_id : value.vehical_id,
                            status: value.status, 
                            borderColor: 'black',                   
                            color :  journey_colors[value.vehical_id]                                
                        }); 
                        }       
                                              
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
            $.get("{{ URL::to('/journey/readMyJourney') }}",function(data){ 
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
                    if(value.expected_start_date_time == null){
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
                });
                $('#calendar').fullCalendar('addEventSource', qEvent);
                $('#calendar').fullCalendar('refetchEvents');
            });                       
	    });

        $(".external").click(function(evt){
            qEvent=[]; 
            $('#calendar').fullCalendar('removeEvents');
            $.get("{{ URL::to('/journey/myJourneyExternal') }}",function(data){
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
    //console.log(qEvent); 
    $(function () {
        var aaa;
        $.ajax({
            method:'GET',
            url:"{{ URL::to('/journey/readMyJourney') }}",
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
                            title : value.places_to_be_visited, 
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
                    if(value.expected_start_date_time == null){
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
                });
                
            },
            error:function (err) {
                // alert(err.toString());
            },
            complete:function () {             
                //console.log(aaa);
                $('#calendar').fullCalendar({
                    selectable: true,
                    defaultView:'month', //agendaWeek
                    header: {
                        left: 'prev,next today myCustomButton',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },           

                    events:qEvent,                  
               
                    eventClick: function(event, element) {
                        //$('#myModal').modal('toggle');
                        var moment = $('#calendar').fullCalendar('getDate');
                        //console.log(event.id );

                        $.ajax({
                            url: "{{ URL::to('/journey/clickMyJourneys/{id}') }}" ,
                            type: 'GET',
                            data: { id: event.id },
                            success: function(data)
                            {                            
                                var details = JSON.parse(data);
                                $.confirm({
                                    title: 'Journey!', //Confirm
                                    content:
                                    "<h3>Applicant - "+ event.applicant +"</h3>"+
                                    "<h3>Status - "+ event.status +"</h3>"+
                                    "<h4>Place - "+ details[0].places_to_be_visited+"</h3>" + 
                                    "<h4>Start - "+ event.start.format('YYYY-MM-DD HH:mm:SS') + "</h4>" +
                                    "<h4>End - "+ event.end.format('YYYY-MM-DD HH:mm:SS') +"</h4>"+
                                    "<h4>Vehicle - "+ details[1] +"</h4>"+
                                    "<h4>Driver - "+ details[3] +"</h4>",
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
                    }, 
                    dayClick: function(date) {
                        //alert('clicked ' + date.format());
                    },
                    select: function(startDate, endDate) {
                        $('#myModal').modal('toggle');
                    }
                });
            }
        })
    });

</script> 

<script>
            //for hide and view table content 
    function tableViewFunction() {
        var x = document.getElementById("table");
        var y = document.getElementById("hidetable");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
        if (y.style.display === "none") {
            y.style.display = "block";
        } else {
            y.style.display = "none";
        }
    }
</script>

@endsection