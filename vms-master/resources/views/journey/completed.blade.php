@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css')}}">
@endsection

@section('header', 'View Completed Journey Requests')

@section('description', 'Select a journey to view details.')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')

    <div class="box box-primary">
   
        <div class="box-header with-border" >
            <h3 class="box-title">Completed Journey List</h3>
        </div>
        @if($journeys)
                <!-- for hide and view table content -->
        <button onclick="myFunction()" class="btn btn-info">View Table</button> <br>

        <div id="hidetable" class="box-body" style="display: none;">
                   
            <table class="table" id="table" style="display: none; height:150px; overflow: auto;" >
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
                                    <div class="col-md-6">
                                        <dl class="dl-horizontal">
                                            <h4>Confirmaion</h4>
                                            <dt>Confirmed By</dt>
                                            <dd>{{$journey->confirmedBy->emp_title.' '.$journey->confirmedBy->emp_initials.'. '.$journey->confirmedBy->emp_surname}}</dd>
                                            <dt>Confirmed At</dt>
                                            <dd>{{$journey->confirmed_at->toDayDateTimeString()}}</dd>
                                            <dt>Remarks</dt>
                                            <dd>{{$journey->confirmation_remarks}}</dd>
                                            <dt>Confirmed Start Time</dt>
                                            <dd>{{$journey->confirmed_start_date_time->toDayDateTimeString()}}
                                                @if($journey->expected_start_date_time->diffInSeconds($journey->confirmed_start_date_time))
                                                    <span class="label label-warning">Changed</span>
                                                @else
                                                    <span class="label label-success">Not Changed</span>
                                                @endif
                                            </dd>
                                            <dt>Confirmed End Time</dt>
                                            <dd>{{$journey->confirmed_end_date_time->toDayDateTimeString()}}
                                                @if($journey->expected_end_date_time->diffInSeconds($journey->confirmed_end_date_time))
                                                    <span class="label label-warning">Changed</span>
                                                @else
                                                    <span class="label label-success">Not Changed</span>
                                                @endif
                                            </dd>

                                        </dl>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="dl-horizontal">
                                            <h4>Final Details</h4>
                                            <dt>Driver Filled At</dt>
                                            <dd>{{$journey->driver_completed_at->toDayDateTimeString()}}</dd>
                                            <dt>Driver Remarks</dt>
                                            <dd>{{$journey->driver_remarks}}</dd>
                                            <dt>Approximate Distance</dt>
                                            <dd>{{$journey->real_distance}}</dd>
                                            <dt>Start Time</dt>
                                            <dd>{{$journey->real_start_date_time}}</dd>
                                            <dt>End Time</dt>
                                            <dd>{{$journey->real_end_date_time}}</dd>
                                            <dt>Total Hours</dt>
                                            <dd>{{$journey->real_start_date_time->diffInHours($journey->real_end_date_time)}} hours</dd>
                                        </dl>
                                    </div>
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
    <!-- For Calender View -->
    <div class="col-md-12">
        <div class="box box-primary">
            {{-- <div class="box-header with-border">
                <h3 class="box-title">Completed Journey Calender</h3>
            </div> --}}  
            <div class="box-body">
                <!-- THE CALENDAR -->
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
                                {{-- {{$journey->approvedBy->emp_title.' '.$journey->approvedBy->emp_initials.'. '.$journey->approvedBy->emp_surname}} --}}
                                <dd id="approved_by"></dd>
                                <dt>Approved At</dt>
                                {{-- {{$journey->approved_at->toDayDateTimeString()}} --}}
                                <dd id="approved_at"></dd>
                                <dt>Remarks</dt>
                                <dd id="approval_remarks"></dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <h4>Confirmaion</h4>
                                <dt>Confirmed By</dt>
                                {{-- {{$journey->confirmedBy->emp_title.' '.$journey->confirmedBy->emp_initials.'. '.$journey->confirmedBy->emp_surname}} --}}
                                <dd id="confirm_by"></dd>
                                <dt>Confirmed At</dt>
                                {{-- {{$journey->confirmed_at->toDayDateTimeString()}} --}}
                                <dd id="confirm_at"></dd>
                                <dt>Remarks</dt>
                                {{-- {{$journey->confirmation_remarks}} --}}
                                <dd id="confirm_remarks"></dd>
                                <dt>Confirmed Start Time</dt>
                                {{-- {{$journey->confirmed_start_date_time->toDayDateTimeString()}}
                                    @if($journey->expected_start_date_time->diffInSeconds($journey->confirmed_start_date_time))
                                        <span class="label label-warning">Changed</span>
                                    @else
                                        <span class="label label-success">Not Changed</span>
                                    @endif --}}
                                <dd id="confirmed_start_date_time-"> </dd>
                                <dt>Confirmed End Time</dt>
                                <dd id="confirmed_end_date_time-"> </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="dl-horizontal">
                                <h4>Final Details</h4>
                                <dt>Driver Filled At</dt>
                                {{-- {{$journey->driver_completed_at->toDayDateTimeString()}} --}}
                                <dd id="driver_completed_at"></dd>
                                <dt>Driver Remarks</dt>
                                {{-- {{$journey->driver_remarks}} --}}
                                <dd id="driver_remarks"></dd>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>                        
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
    var journeys = {!! json_encode($journeys->toArray()) !!};
    console.log(journeys[0].expected_end_date_time);
     var qEvent=[];
     for (let i = 0; i < journeys.length; i++) {     
        qEvent.push(
            {   id : journeys[i].id,
                start :journeys[i].expected_start_date_time,
                ends :journeys[i].expected_end_date_time,
                applicant_id :journeys[i].applicant_id,
                vehical_id : journeys[i].vehical_id,
                driver_id : journeys[i].driver_id,
           
            }
        );             
    }  
    //console.log(qEvent); 
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
                        console.log(event);
                        //$('#myModal').modal('toggle');
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
                                $('#expected_start_date_time').html(details[0].expected_start_date_time);  
                                $('#expected_end_date_time').html(details[0].expected_end_date_time);                            
                                $('#approved_at').html(details[0].approved_at);     
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

                        $.confirm({
                            title: 'Complted!', 
                            content:"<h4>ID - "+ event.id+"</h4>" +
                            "<h4>Start - "+ event.start.format('YYYY-MM-DD HH:MM:SS') + "</h4>" +
                            "<h4>End - "+ event.ends +"</h4>",
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

                    }, 
                    dayClick: function(date) {
                        //alert('clicked ' + date.format());
                    },
                    select: function(startDate, endDate) {
                        $('#myModal').modal('toggle');
                        //alert('selected ' + startDate.format() + ' to ' + endDate.format());
                        // $('#dtp').val(startDate.format('MM/DD/YYYY HH:mm')+' - '+endDate.format('MM/DD/YYYY HH:mm'));
                        //$('#dtp').val(startDate.format()+' - '+endDate.format())
                    }
                });
            }
        })
    });

</script> 

<script>
    //for hide and view table content 
    function myFunction() {
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