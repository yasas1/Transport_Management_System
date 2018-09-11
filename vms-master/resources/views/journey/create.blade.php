@extends('layouts.master')

@section('title', 'JOURNEY | VEHICLE MANAGEMENT SYSTEM')

@section('styles')

    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css')}}">

@endsection

@section('header', 'Journey Request')

@section('description', 'Select Date / Time range to request new journey.')

@section('content')

    <div class="col-md-12">

        <div class="hidden">
            @include('layouts.errors')
            @include('layouts.success')
        </div>
        <!-- Modal -->
    </div>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Vehicle Calender</h3>
            </div>

            <div class="box-body">
                <!-- THE CALENDAR -->
                    <div id='calendar'></div>
                </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Requesting new journey</h4>
                </div>
                <div class="modal-body">
                    @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li> {{ $error}} </li>
                            @endforeach
                        </ul>
                    </div> 
                    @endif

                    {!! Form::open(['method' => 'post','action'=>'JourneyController@store','files'=>true]) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <h4><i class="fa fa-user"></i> Applicant</h4>
                            <div class="col-md-offset-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name"><h4>Name - {{Auth::user()->name}}</h4></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="applicant_email"><h4>Email - {{Auth::user()->email.'@ucsc.cmb.ac.lk'}}</h4></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>


                            <h4><i class="fa fa-car"></i> Vehicle Required</h4>
                            <div class="col-md-offset-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-md-12">
                                <span class="text-orange" id="available"></span>
                            </div>

                            <h4><i class="fa fa-calendar"></i> Date and Time Range</h4>
                            <div class="form-group col-md-offset-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    {{Form::text('time_range',null,['class'=>'form-control','id'=>'dtp','placeholder'=>'Reserve Date and Time'])}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- <div class="col-md-12">
                                    <span class="text-orange" id="available"></span>
                            </div> --}}

                            <h4><i class="fa fa-newspaper-o"></i> Details</h4>
                            <div class="col-md-offset-1">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="purpose">Purpose</label>
                                            {{Form::textarea('purpose',null,['class'=>'form-control','placeholder'=>'Purpose','rows'=>'3'])}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="places_to_be_visited">Places To Be Visited</label>
                                            {{Form::textarea('places_to_be_visited',null,['class'=>'form-control','placeholder'=>'Places To Be Visited','rows'=>'3' ])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="number_of_persons" class="col-sm-7">Number of Persons</label>
                                            <div class="col-lg-5">
                                                {{Form::number('number_of_persons',null,['class'=>'form-control','placeholder'=>'0','min'=>'1'])}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="expected_distance" class="col-sm-7">Approximate Distance (km)</label>
                                            <div class="col-lg-5">
                                                {{Form::text('expected_distance',null,['class'=>'form-control','placeholder'=>'km','id'=>'txtDistance'])}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <span class="text-orange" id="txtDistanceHelpBox"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <h4><i class="fa fa-money"></i> Fund Allocated From</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row col-md-offset-1">
                                        @foreach($fundAlFroms as $fundAlFrom)
                                            <div class="col-md-6">
                                                {!! Form::radio('funds_allocated_from_id', $fundAlFrom->id, false); !!}
                                                {{$fundAlFrom->name}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <h4><i class="fa fa-user-o"></i> Divisional Head</h4>
                            <div class="col-md-offset-1">
                                <div class="row">
                                    <div class="">
                                        {!! Form::hidden('divisional_head_id', null,['id'=>'txtDivisionalHead']); !!}
                                        <div class="btn-group dropup col-md-12">
                                            <button type="button" class="btn btn-default" id="divDiviHead">Select Divisional Head</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @foreach($divHeads as $divHead)
                                                    @if($divHead->head()->first()!='')
                                                        <li class="cmbDivHead dropdown-item" data-value="{{$divHead->head()->first()->emp_id}}">
                                                        <span>
                                                            {{$divHead->head()->first()->emp_initials.'. '.$divHead->head()->first()->emp_surname.' ( '.$divHead->dept_name.' )'}}
                                                        </span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--'is_long_distance',--}}
                    {{--'real_distance'--}}

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <hr>
                        {{Form::submit('SEND JOURNEY REQUEST', ['class'=>'btn btn-success pull-left'])}}
                        {{Form::reset('RESET', ['class'=>'btn btn-warning'])}}
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
    {{--<div class="col-md-6">--}}
        {{--<div class="box box-primary">--}}
            {{--<div class="box-header with-border">--}}
                {{--<h3 class="box-title">Vehicle Calender</h3>--}}
            {{--</div>--}}
            {{--<div class="box-body">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<iframe src="https://calendar.google.com/calendar/embed?src=cmb.ac.lk_3131313639323032363931%40resource.calendar.google.com&ctz=Asia%2FColombo" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--{!! Form::close() !!}--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="aletr alert-successs" id="aaa">aaaa</div>
@endsection

@section('scripts')

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
                { id : journeys[i].id,
                  start :journeys[i].expected_start_date_time,
                  ends :journeys[i].expected_end_date_time,
                  applicant_id :journeys[i].applicant_id,
                  vehical_id : journeys[i].vehical_id,
                  driver_id : journeys[i].driver_id,
                  
                }
            );             
         }
        
        console.log(qEvent);
        
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
                       defaultView:'agendaWeek',
                       header: {
                           left: 'prev,next today myCustomButton',
                           center: 'title',
                           right: 'month,agendaWeek,agendaDay'
                       },
                       googleCalendarApiKey: 'AIzaSyARu_beMvpDj95imxjje5NkAjrT7c3HluE',
                       /* events structurer
                       events: 
                         [
                            { id: '1', resourceId: 'b', start: '2018-09-07T02:10:00', end: '2018-09-08T07:11:00' },
                            { id: '2', resourceId: 'c', start: '2018-09-07T05:00:00', end: '2018-09-07T22:00:00', title: 'event 2' },
                            { id: '3', resourceId: 'd', start: '2018-09-06', end: '2018-09-08', title: 'event 3' },
                            { id: '4', resourceId: 'e', start: '2018-09-07T03:00:00', end: '2018-09-09T08:00:00', title: 'event 4' },
                            { id: '5', resourceId: 'f', start: '2018-09-07T00:30:00', end: '2018-09-10T02:30:00', title: 'event 5' }
                          ],  */
                        //googleCalendarId: 'cmb.ac.lk_vma77hchj6o7jfqnnsssgivkeo@group.calendar.google.com'

                       events:qEvent,
                       eventSources: aaa,
                       eventClick: function(event, element) {
                           console.log(event);
                           var moment = $('#calendar').fullCalendar('getDate');

                           $.confirm({
                               title: 'Journey!', //Confirm
                               content:"<h4>ID - "+ event.id+"</h4>" + 
                               "<h4>Start - "+ event.start.format('YYYY-MM-DD HH:mm:SS') + "</h4>" +
                               "<h4>End - "+ event.ends +"</h4>"+
                               "<h4>Vehicle Id - "+ event.vehical_id +"</h4>",
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
                           $('#dtp').val(startDate.format()+' - '+endDate.format())
                       }
                   });
               }
           })
        });

        // var calendar = $('#calendar').fullCalendar('getCalendar');
        //
        // calendar.on('dayClick', function(date, jsEvent, view) {
        //     console.log('clicked on ' + date.format());
        // });
    </script>

    <script>
       // for after select the vehicle, set available  field null string
            $('#vid').on('change',function () {
                $('#available').html('');
                console.log("check");
            });
    
    </script>

    <script>
        $('.cmbDivHead').on('click',function () {
            $('#txtDivisionalHead').val($(this).attr('data-value'));
            $('#divDiviHead').html($(this).html());
        });
    </script>

    <script type="text/javascript">
        // var journeys = {!! json_encode($journeys->toArray()) !!};
        $(function () {

            $('#dtp').daterangepicker({
                "timePicker": true,
                "linkedCalendars": false,
                "showCustomRangeLabel": false,
                "timePicker24Hour": true,
                "minDate": moment(),
                locale: {
                    format: 'MM/DD/YYYY HH:mm'
                }
            }, function(start, end, label) {
                
                console.log('New date range selected: ' + start.format('YYYY-MM-DD HH:mm') + ' to ' + end.format('YYYY-MM-DD HH:mm') + ' (predefined range: ' + label + ')');                 
                
                var vehicle_id = $('#vid').val();
                if (vehicle_id=="") {
                    console.log(" vehicle should be selected!..");
                    $('#available').html('vehicle should be selected!..');
                }
                else{
                    $.get("{{ URL::to('journey/read') }}",function(data){ 

                         console.log( start.format('mm') );
                        // console.log( start.format('MM') );
                        // console.log( start.format('DD') );    

                        $.each(data,function(i,value){
                            
                            var jStartDate = new Date( Date.parse(value.expected_start_date_time,"Y-m-d") );                           
                            var jEndDate = new Date( Date.parse(value.expected_end_date_time,"Y-m-d") );   
                            //console.log( jDate.getDate() );

                            // console.log( jDate.getFullYear() );
                            // console.log( jDate.getMonth()+1 );
                            // console.log( jDate.getDate()  );
                            

                            if(jStartDate.getFullYear() == start.format('YYYY') && jStartDate.getMonth()+1 == start.format('MM') && jStartDate.getDate() == start.format('DD') ){
                                // console.log( start.format('YYYY') );
                                // console.log( start.format('MM')  ); available
                                // console.log( start.format('DD') );
                                
                                if(jStartDate.getHours() == start.format('HH') && jStartDate.getMinutes() == start.format('mm') ){
                                    console.log( 'check 1' );
                                    $('#available').html('Selected Vehicle is not available at time range');
                                    
                                }
                                else if(jStartDate.getHours() <= start.format('HH') && jEndDate.getHours() >= start.format('HH') ){
                                    console.log( 'check 2' );
                                    $('#available').html('Selected Vehicle is not available at time range');
                                }
                                else if(jStartDate.getHours() >= start.format('HH') && jStartDate.getHours() <= end.format('HH') ){
                                    console.log( 'check 3' );
                                    $('#available').html('Selected Vehicle is not available at time range');
                                }
                                else{
                                    console.log( 'available' );
                                    $('#available').html('');
                                }
                                
                            } 

                        });
                    });
                }
                
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

    </script>

@endsection