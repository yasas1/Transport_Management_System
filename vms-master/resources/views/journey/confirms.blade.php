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
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Confirmation Pending Journey Requests List</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
            @if($journeys)
                <table class="table" id="table">
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

    <div class="col-md-12">
        <div class="box box-primary">
            {{-- <div class="box-header with-border">
                <h3 class="box-title">Comfirm Journey Calender</h3>
            </div> --}}

            <div class="box-body">
                <!-- THE CALENDAR -->
                    <div id='calendar'></div>
                </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>

    <!-- For Calender Event Click-->
 @if($journeys)
 @foreach($journeys as $journey)
        
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" id="{{$journey->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">       
               
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
    </div>
    
@endforeach
@endif

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
                    format: 'MM/DD/YYYY HH:MM'
                }
            }, function(start, end, label) {
                console.log('New date range selected: ' + start.format('YYYY-MM-DD HH:MM') + ' to ' + end.format('YYYY-MM-DD HH:MM') + ' (predefined range: ' + label + ')');
            });

            $('#dtp').on('show.daterangepicker', function(e){
                var modalZindex = $(e.target).closest('.modal').css('z-index');
                $('.daterangepicker').css('z-index', modalZindex+100);
            });
        });
    </script>

    {{-- Script for calender view --}}

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js')}}"></script>
<script src='{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/gcal.min.js')}}'></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script>

     var journeys = {!! json_encode($journeys->toArray()) !!};

    // console.log(journeys[0].vehical.name);
     var qEvent=[];
     for (let i = 0; i < journeys.length; i++) {
        // $journey->vehical->fullname  vehicle_name :
        qEvent.push(
            { id : journeys[i].id,
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
                       $('#myModal').modal('toggle');

                       var moment = $('#calendar').fullCalendar('getDate');

                       /*$.confirm({
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
                       }); */

                   }, 
                   dayClick: function(date) {
                       //alert('clicked ' + date.format());
                   },
                   select: function(startDate, endDate) {
                       $('#myModal').modal('toggle');
                       //alert('selected ' + startDate.format() + ' to ' + endDate.format());
                       // $('#dtp').val(startDate.format('MM/DD/YYYY HH:mm')+' - '+endDate.format('MM/DD/YYYY HH:mm'));
                       $('#dtp').val(startDate.format()+' - '+endDate.format())
                   }
               });
           }
       })
    });

    //
    // var calendar = $('#calendar').fullCalendar('getCalendar');
    //
    // calendar.on('dayClick', function(date, jsEvent, view) {
    //     console.log('clicked on ' + date.format());
    // });
</script> 

@endsection