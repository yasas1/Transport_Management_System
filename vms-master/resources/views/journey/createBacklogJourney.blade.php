@extends('layouts.master')

@section('title', 'JOURNEY | VEHICLE MANAGEMENT SYSTEM')

@section('styles')
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css')}}">
@endsection

@section('header', 'Create New Backlog Journey')

@section('description', 'Select Date / Time range to request new journey.')

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
                @foreach ($vehiclesButton as $vehicle)
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

                    {!! Form::open(['method' => 'post','action'=>'JourneyController@storeBacklog','files'=>true]) !!}
                    {{-- storeBacklog --}}
                    <div class="row">
                        <div class="col-md-12">
                            <h4><i class="fa fa-user"></i> Applicant</h4>
                            <div class="col-md-offset-1">
                                <div class="row">
                    
                                    <div class="form-group">
                                    {!! Form::hidden('applicant_id', null,['id'=>'textApplicant']); !!}
                                        <div class="btn-group dropdown col-md-12">
                                            <button type="button" class="btn btn-default" id="divApplicant">Select Applicant </button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @foreach($divHeads as $divHead)
                                                    @if($divHead->head !='')
                                                        <li class="cmbApplicant dropdown-item" data-value="{{$divHead->head}}">
                                                        <span>
                                                            {{$divHead->getHead()->first()->emp_initials.'. '.$divHead->getHead()->first()->emp_surname}}
                                                        </span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            {{-- <h4><i class="fa fa-car"></i> Vehicle </h4> --}}
                            {{-- <div class="col-md-offset-1"> --}}
                                <div class="row">
                                    <div class="col-md-6">
                                            <h4><i class="fa fa-car"></i> Vehicle </h4>
                                        <div class="form-group">
                                            
                                            {{-- <label for="vehical_id">Change Vehicle</label> --}}
                                            {{-- {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control','id'=>'vehicle'])}} --}}
                                            <select  name="vehical_id" id="vehicle_select" class="form-control vehicle">                                                                                                       
                                                @foreach ($vehicles as $vehicle)
                                                    <option value="{{ $vehicle->id }}" >{{ $vehicle->registration_no }} ( {{ $vehicle->name }} )  </option>
                                                @endforeach  
                                                    <option id="external" value="0">External Vehicle</option>   
                                            </select>
                                        </div>                                    
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="driverdiv">
                                            {{-- <label for="driver_id">Select Driver</label> --}}
                                            <h4><i class="fa fa-car"></i> Driver </h4>
                                            {{Form::select('driver_id',$drivers,null,['class'=>'form-control ','id'=>'driverid','placeholder'=>'Select a Vehicle'])}}
                                        </div>
                                        <div class="form-group" id="company">
                                                {{-- <label for="company_name">External Vehicle's Company Name</label> --}}
                                                <h5><i class="fa fa-car"></i> External Vehicle's Company Name </h5>
                                                {!! Form::text('company_name',null,['class'=>'form-control','id'=>'companyName','placeholder'=>'Company Name' ]) !!}
                                        </div>
                                        <div class="form-group" id="companycost">
                                            {{-- <label for="company_cost">Cost</label> --}}
                                            <h5><i class="fa fa-car"></i> Cost </h5>
                                            {!! Form::text('cost',null,['class'=>'form-control','id'=>'cost','placeholder'=>'Cost' ]) !!}
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
                                            <label for="expected_distance" class="col-sm-7"> Distance (km)</label>
                                            <div class="col-lg-5">
                                                {{Form::text('real_distance',null,['class'=>'form-control','placeholder'=>'km','id'=>'txtDistance'])}}
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
                                                    @if($divHead->head !='')
                                                        <li class="cmbDivHead dropdown-item" data-value="{{$divHead->head}}">
                                                        <span>
                                                            {{$divHead->getHead()->first()->emp_initials.'. '.$divHead->getHead()->first()->emp_surname.' ( '.$divHead->dept_name.' )'}}
                                                        </span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4><i class="fa fa-user-o"></i> Approved By</h4>
                            <div class="col-md-offset-1">
                                <div class="row">
                                    <div class="">
                                        {!! Form::hidden('approved_by', null,['id'=>'txtApprovedBy']); !!}
                                        <div class="btn-group dropup col-md-12">
                                            <button type="button" class="btn btn-default" id="divApprovedBy">Approved By</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @foreach($divHeads as $divHead)
                                                    @if($divHead->head !='')
                                                        <li class="cmbApprovedBy dropdown-item" data-value="{{$divHead->head}}">
                                                        <span>
                                                            {{$divHead->getHead()->first()->emp_initials.'. '.$divHead->getHead()->first()->emp_surname.' ( '.$divHead->dept_name.' )'}}
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
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <hr>
                        {{Form::submit('SEND JOURNEY REQUEST', ['class'=>'btn btn-success pull-left'])}}
                        {{Form::reset('RESET', ['class'=>'btn btn-warning'])}}
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Close</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
    <div class="aletr alert-successs" id="aaa">aaaa</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js')}}"></script>
    <script src='{{asset('https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/gcal.min.js')}}'></script>
    <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script>
        //var journeys = {!! json_encode($journeys->toArray()) !!};       
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
                            
                            $.ajax({
                                url: '/journey/readJourneyForCreate/{id}',
                                type: 'GET',
                                data: { id: event.id },
                                success: function(data)
                                {
                                    var details = JSON.parse(data);
                                    
                                    //console.log(details[1]); 	
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
                        },
                        dayClick: function(date) {
                            //alert('clicked ' + date.format());
                        },
                        // selectConstraint: {
                        //     start: $.fullCalendar.moment().add(10, 'minutes'), //subtract
                        //     end: $.fullCalendar.moment().startOf('year').add(1, 'year')
                        // },
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
        // var journeys = {!! json_encode($journeys->toArray()) !!};
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