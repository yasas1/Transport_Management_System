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
                            <td>{{$journey->expected_start_date_time->toDayDateTimeString()}}</td>
                            <td>{{$journey->expected_end_date_time->toDayDateTimeString()}}</td>

                            <td width="200px">
                                <button class="btn btn-success btnView" id="view" value={{$journey->id}} ><i class="fa fa-eye"></i></button>
                                {{-- <button id="{{$journey->id}}" class="btn btn-success btnView"><i class="fa fa-eye"></i></button> --}}
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
                
                @endforeach
            @endif

        </div>
    </div>

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
                                <div id="internal_vehicle">
                                    <dt>Vehicle Number</dt>
                                    <dd id="vehicle_number"> </dd>
                                    <dt>Vehicle Name</dt>
                                    <dd id="vehicle_name"></dd>
                                    <dt>Driver</dt>
                                    <dd id="driver_name"></dd>
                                </div>
                                <div id="external_vehicle">
                                    <dt>Vehicle</dt>
                                    <dd>External Vehicle</dd>
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
                    @if(Auth::user()->canChangeJourneyDetails())
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Change Journey details</h4>
                            {!! Form::open(['method' => 'post','id'=>'formChange','action'=>['JourneyController@changeOngoing']]) !!}
                            {{-- <form action="{{ URL::to('/journey/request/changeOngoing')}}" method="POST" id="changeOngoingAjax"> --}}
                                {{csrf_field()}}
                            <input type="hidden" name="id" id="journeyid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehical_id">Change Vehicle</label>
                                        {{-- {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control','id'=>'vehicle'])}} --}}
                                        <select  name="vehical_id" id="vehicle_select" class="form-control vehicle">                                                                                                       
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}" >{{ $vehicle->id }} {{ $vehicle->registration_no }} ( {{ $vehicle->name }} ) </option>
                                            @endforeach  
                                                <option id="external" value="0">External Vehicle</option>   
                                        </select>
                                    </div>
                                    <div class="form-group" id="company">
                                        <label for="company_name">External Vehicle's Company Name</label>
                                        {!! Form::text('company_name',null,['class'=>'form-control','id'=>'companyName','placeholder'=>'Company Name' ]) !!}
                                    </div>
                                    <div class="form-group" id="companycost">
                                        <label for="company_cost">Cost</label>
                                        {!! Form::number('cost', null,['class'=>'form-control ','id'=>'cost','placeholder'=>'Cost']) !!}
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="driver">
                                        <label for="driver_id">Change Driver</label>
                                        {{Form::select('driver_id',$drivers,null,['class'=>'form-control ','id'=>'driverid'])}}
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
                    @endif
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['method' => 'post','id'=>'formCancel','action'=>['JourneyController@cancel']]) !!}   
                            <input type="hidden" name="id" id="journeyId">         
                        </div>
                    </div>                                       
                    <div class="modal-footer">
                        @if(Auth::user()->canCancelJourney())
                            <input type="submit" class="btn btn-warning" name="cancel" value="Cancel Journey "> 
                        @endif
                        <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>                          
                            {!! Form::close() !!}
                    </div> 
                </div>
                
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{-- <script src="{{asset('js/bootstrap-toggle.min.js')}}"></script> --}}

    <script>
        $(".btnView").click(function(evt){
	        var journeyid = $(this).val();
            //console.log(journeyid);
            $.ajax({
                url: '/journey/readConfirmed/{id}',
                type: 'GET',
                data: { id: journeyid },
                success: function(data)
                {
                    var details = JSON.parse(data);
                    //console.log(details[16]); 
                    $('#journeyid').val(details[0].id);
                    $('#journeyId').val(details[0].id);
                    $('#purpose').html(details[0].purpose);
                    $('#places_to_be_visited').html(details[0].places_to_be_visited);
                    $('#number_of_persons').html(details[0].number_of_persons);
                    $('#expected_distance').html(details[0].expected_distance);
                    $('#approval_remarks').html(details[0].approval_remarks);

                    $('#vehicle_number').html(details[1]);
                    $('#vehicle_name').html(details[2]);; 
                    $('#driver_name').html(details[3]);
                    $('#appl_name').html(details[4]);
                    $('#appl_dept').html(details[5]);
                    $('#appl_email').html(details[6]);
                    $('#devisional_head').html(details[7]);
                    $('#approved_by').html(details[8]);
                    $('#approved_at').html(details[9]); 
                    $('#expected_start_date_time').html(details[10]);  
                    $('#expected_end_date_time').html(details[11]);                            
                        
                    $('#confirm_by').html(details[12]);
                    $('#confirm_at').html(details[13]);

                    $('#confirm_remarks').html(details[0].confirmation_remarks);
                    
                    $('#confirmed_start_date_time').html(details[14] );
                    $('#confirmed_end_date_time').html(details[15] ); 

                    if(details[16]==null){
                        //console.log(details[0].driver_id);
                        $('#external_vehicle').hide();
                        $('#internal_vehicle').show();
                        document.getElementById('vehicle_select').value=details[0].vehical_id ; 
                        document.getElementById('driverid').value=details[0].driver_id ; 
                        $('#company').hide();
                        $('#companycost').hide();
                        document.getElementById('companyName').value=''; 
                        document.getElementById('cost').value='' ; 
                    }
                    else{
                        $('#internal_vehicle').hide();
                        $('#external_vehicle').show();
                        document.getElementById('vehicle_select').value=0 ;
                        $("#driver").hide();
                        $('#company').show();
                        $('#companycost').show();
                        document.getElementById('companyName').value=details[16].company_name ; 
                        document.getElementById('cost').value=details[16].cost ; 
                        // $('#external_company').html(details[19].company_name );
                        // $('#external_cost').html(details[19].cost);
                    }                   
                }
            });
            $('#modal').modal('toggle');
        });
        
        setTimeout(function() {
            $('#successMessage').fadeOut('fast');
        }, 10000);

    </script>

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

        $(document).ready(function() {
            // $("div[id=company]").hide();
            // $("div[id=companycost]").hide();
 
            $("button[id=view]").on('click', function(){                      
                $("input[id=change]").attr("disabled", "disabled");

                // $("div[id=company]").hide();
                // $("div[id=companycost]").hide();    
                
            });

            $(".vehicle").on('change',function(evt){
                $("input[id=change]").removeAttr("disabled", "disabled");
                var vehicle = $(this).val();
	            if( vehicle == 0 ){
                    $("div[id=company]").show();
                    $("div[id=companycost]").show();
                    $("div[id=driver]").hide();
                }
                else{
                    $("div[id=company]").hide();
                    $("div[id=companycost]").hide();
                    $("div[id=driver]").show();
                }              
            });

            $("#close").on('click',function(evt){
                $("div[id=driver]").show();
            });
                       
            $("select[id=driverid]").on('change', function(){              
                $("input[id=change]").removeAttr("disabled", "disabled");
            });
            
        });
    </script>

@endsection