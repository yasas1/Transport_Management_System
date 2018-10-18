@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')
    {{-- <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet"> --}}  
@endsection

@section('header', 'View Ongoing Journeys')

@section('description', 'Select a journey to view details.')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
    <div class="box box-primary" style="height: 750px; overflow: auto;" >
        <div class="box-header with-border">
            <h3 class="box-title">Ongoing Journey Requests List </h3>
        </div>
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
                            @if($journey->vehical_id != null)
                            <td>{{$journey->vehical->fullname}}</td>
                            @endif
                            @if($journey->vehical_id == null)
                            <td>External Vehicle</td>
                            @endif
                            <td>{{$journey->expected_start_date_time->toDayDateTimeString()}}</td>
                            <td>{{$journey->expected_end_date_time->toDayDateTimeString()}}</td>
                            <td>{{$journey->applicant->emp_surname}}</td>

                            <td width="200px">
                                <button class="btn btn-success btnView" id="view" data-toggle="modal" data-target="#{{$journey->id}}"><i class="fa fa-eye"></i></button>
                                {{-- <button id="{{$journey->id}}" class="btn btn-success btnView"><i class="fa fa-eye"></i></button> --}}
                            </td>
                        </tr>

                        <div class="modal fade bs-example-modal-lg" id="{{$journey->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <div class="row">
                                            <div class="col-md-12">
        
                                                <h3>Journey Details
                                                    @if($journey->journey_status_id == 1)
                                                        <span class="label label-danger pull-right">Not Approved</span>
                                                        <span class="label label-danger pull-right">Not Confirmed</span>
                                                    @endif
                                                    @if($journey->journey_status_id == 2)
                                                        <span class="label label-success pull-right">Approved</span>
                                                        <span class="label label-danger pull-right">Not Confirmed</span>
                                                    @endif
                                                    @if($journey->journey_status_id == 4)
                                                        <span class="label label-success pull-right">Approved</span>
                                                        <span class="label label-success pull-right">Confirmed</span>
                                                        <span class="label label-info pull-right">Ongoing</span>
                                                    @endif
                                                </h3>
                                                <hr>
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
                                                    @if($journey->vehical_id != null)
                                                    <dt>Vehicle Number</dt>
                                                    <dd>{{$journey->vehical->registration_no}}</dd>
                                                    <dt>Vehicle Name</dt>
                                                    <dd>{{$journey->vehical->name}}</dd>
                                                    <dt>Driver</dt>
                                                    <dd>{{$journey->vehical->driver->fullname}}</dd>
                                                    @endif
                                                    @if($journey->vehical_id ==null)
                                                    <dt>Vehicle Number</dt>
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
                                                    <dt>Approximate Distance</dt>
                                                    <dd>{{$journey->expected_distance.' km'}}</dd>
                                                </dl>
                                                <dl class="dl-horizontal">
                                                    <h4>Expected Date and Time Range</h4>
                                                    <dt>Start Date/ Time</dt>
                                                    <dd>{{$journey->expected_start_date_time->toDayDateTimeString()}}</dd>
                                                    <dt>End Date/ Time</dt>
                                                    <dd>{{$journey->expected_end_date_time->toDayDateTimeString()}}</dd>
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
                                                            <span class="label label-info">Changed</span>
                                                        @else
                                                            <span class="label label-success">Not Changed</span>
                                                        @endif
                                                    </dd>
                                                    <dt>Confirmed End Time</dt>
                                                    <dd>{{$journey->confirmed_end_date_time->toDayDateTimeString()}}
                                                        @if($journey->expected_end_date_time->diffInSeconds($journey->confirmed_end_date_time))
                                                            <span class="label label-info">Changed</span>
                                                        @else
                                                            <span class="label label-success">Not Changed</span>
                                                        @endif
                                                    </dd>
                                                </dl>                                              
                                            </div>                                       
                                        </div>
                                        {{-- array_merge(['7' => 'test'] + $vehicles->toArray()) --}}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>Change Journey details</h4>
                                                {!! Form::model($journey,['method' => 'post','id'=>'formChange'.$journey->id ,'action'=>['JourneyController@changeOngoing',$journey->id]]) !!}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="vehical_id">Change Vehicle</label>
                                                            {{-- {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control','id'=>'vehicle'])}} --}}
                                                            <select value={{ $journey->vehical_id }} name="vehical_id" id="vehicle" class="form-control vehicle">                                                                                                       
                                                                @foreach ($vehicles as $vehicle)
                                                                    <option value="{{ $vehicle->id }}" >{{ $vehicle->registration_no }} ( {{ $vehicle->name }} )  </option>
                                                                @endforeach  
                                                                    <option id="external" value="0">External Vehicle</option>   
                                                            </select>
                                                        </div>
                                                        <div class="form-group" id="company">
                                                            <label for="company_name">Company Name</label>
                                                            {!! Form::text('company_name',null,['class'=>'form-control','id'=>'companyName','placeholder'=>'Company Name' ]) !!}
                                                        </div>
                                                        <div class="form-group" id="companycost">
                                                            <label for="company_cost">Cost</label>
                                                            {!! Form::text('cost',null,['class'=>'form-control','id'=>'cost','placeholder'=>'Cost' ]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="driver">
                                                            <label for="driver_id">Change Driver</label>
                                                            {{Form::select('driver_id',$drivers,null,['class'=>'form-control ','id'=>'driverid','placeholder'=>'Select a Vehicle'])}}
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        {{-- <div class="modal-footer"> --}}
                                        <div>
                                            <input type="submit" class="btn btn-success" id="change" name="change" value="Change">
                                            
                                                {!! Form::close() !!}
                                        </div> 
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!! Form::open(['method' => 'post','id'=>'formCancel{{$journey->id}}','action'=>['JourneyController@cancel',$journey->id]]) !!}            
                                            </div>
                                        </div>                                       
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-warning" name="cancel" value="Cancel Journey "> 
                                            <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>                          
                                                {!! Form::close() !!}
                                        </div>                                      
                                    </div>              
                                </div>
                            </div>
                        <div>
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
                
                @endforeach
            @endif

        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script src="{{asset('js/bootstrap-toggle.min.js')}}"></script> --}}
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
            });  
        });    

    </script>
    <script>
        var journeys = {!! json_encode($journeys->toArray()) !!};

        for (let index = 0; index < journeys.length; index++) {

            if(journeys[index].vehical_id==null){
                $("#"+journeys[index].id).find("#vehicle").val('0').change();
            }
            else{
                $("#"+journeys[index].id).find("#vehicle").val(journeys[index].vehical_id).change();
            }
            if(journeys[index].driver_id==null){
                //$("#"+journeys[index].id).find("#driver").hide();
            }
              
        }

        console.log(journeys[3].vehical_id);
        $("#"+journeys[3].id).find("#vehicle").val(journeys[3].vehical_id).change();
        var y = $("#"+journeys[3].id).find("#vehicle").val();
        console.log(y);
        $(document).ready(function() {
                  //company
            $("div[id=company]").hide();
            $("div[id=companycost]").hide();
 
            $("button[id=view]").on('click', function(){                      
                $("input[id=change]").attr("disabled", "disabled");
                $("div[id=company]").hide();
                $("div[id=companycost]").hide();
            });

            // $("select[id=vehicle]").on('change', function(){              
            //     $("input[id=change]").removeAttr("disabled", "disabled");

            //     // if($("select[id=vehicle]").val()==0){ //$(this).attr("value"); 
            //     //     console.log("bk");
            //     // }
            // });

            $(".vehicle").on('change',function(evt){
                $("input[id=change]").removeAttr("disabled", "disabled");
                var vehicle = $(this).val();
	            if( vehicle == 0 ){
                    $("div[id=company]").show();
                    $("div[id=companycost]").show();
                }
                else{
                    $("div[id=company]").hide();
                    $("div[id=companycost]").hide();
                    // $("#"+journeys[index].id).find("#driver").show();
                }
                console.log(vehicle);
            });
            
            
            $("select[id=driverid]").on('change', function(){              
                $("input[id=change]").removeAttr("disabled", "disabled");
            });
            
        });
    </script>

    {{-- <script>
        $(function () {
            $('.btnView').on('click',function () {
                $.confirm({
                    title:'',
                    columnClass: 'col-lg-8 col-lg-offset-2',
                    content:$('div#d'+$(this).attr('id')).html(),
                    buttons: {
                        formSubmit: {
                            text: 'Close',
                            btnClass: 'btn-green',
                            action: function () {
                                //close
                            }
                        },
                        cancel: function () {
                            //close
                        },
                    },
                    onContentReady: function () {
                        // bind to events
                        var jc = this;
                        this.$content.find('form').on('submit', function (e) {
                            // if the user submits the form by pressing enter in the field.
                            e.preventDefault();
                            jc.$$formSubmit.trigger('click'); // reference the button and click it
                        });
                    }
                });
            })
        });
    </script> --}}
@endsection