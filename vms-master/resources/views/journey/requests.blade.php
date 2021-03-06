@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')
    {{-- <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet"> --}}
@endsection

@section('header', 'View Journey Requests')

@section('description', 'Select a journey request to approve.')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')

    @if(Auth::user()->canApproveLongDistanceJourney()) 
        @if($longDisJourneys)  

            <div class="alert alert-info alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Need Attention for Long Distance Journeys Request List...</strong> 
            </div>  

            {{-- for long distance journeys --}}
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h2 class="box-title"> <strong> Long Distance Journey Request List </strong> </h2>
                </div>
        
                <div class="box-body" style="height: 400px; overflow: auto;" >
                    
                    <table class="table" id="longDistable" >
                        <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Applicant Division</th>
                            <th>Vehicle</th>
                            <th>Start Date / Time</th>
                            <th>End Date / Time</th>
                            <th width="150px">Expected Distance</th>
                            <th width="200px">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($longDisJourneys as $journey)
                            <tr>
                                <td>{{$journey->applicant->emp_title.' '.$journey->applicant->emp_initials.'. '.$journey->applicant->emp_surname}}</td>
                                <td>{{$journey->applicant->division->dept_name}}</td>
                                <td>{{$journey->vehical->fullname}}</td>
                                <td>{{$journey->expected_start_date_time->toDayDateTimeString()}}</td>
                                <td>{{$journey->expected_end_date_time->toDayDateTimeString()}}</td>
                                <th>{{$journey->expected_distance }} </th> 

                                <td width="200px">
                                    <button class="btn btn-success btnView" data-toggle="modal" data-target="#{{$journey->id}}"><i class="fa fa-eye"></i></button>
                                    {{-- <button id="{{$journey->id}}" class="btn btn-success btnViewLong"><i class="fa fa-eye"></i></button> --}}
                                </td>
                            </tr>
                            <div class="modal fade bs-example-modal-lg" id="{{$journey->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Journey Request Approval
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
                                                        <dd>{{$journey->applicant->emp_title.' '.$journey->applicant->emp_initials.'. '.$journey->applicant->emp_surname}}</dd>
                                                        <dt>Division</dt>
                                                        <dd>{{$journey->applicant->division->dept_name}}</dd>
                                                        <dt>Email</dt>
                                                        <dd>{{$journey->applicant->emp_email.'@ucsc.cmb.ac.lk'}}</dd>
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
                                                    </dl>
                        
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! Form::open(['method' => 'post','id'=>'formApproval{{$journey->id}}','action'=>['JourneyRequestController@approval',$journey->id]]) !!}
                                                    <div class="form-group">
                                                        <label for="remarks">Remarks</label>
                                                        {!! Form::textarea('remarks',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2' ]) !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="is_approved">Approve</label> 
                                                        {!! Form::checkbox('is_approved', 1, true) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-success" name="submitType" value="Submit">
                                                <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>
                                                    {!! Form::close() !!}
                                            </div> 
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
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
                </div>         
            </div>
        @endif   
    @endif

        {{-- for journeys that did not request long distance --}}
    
    <div class="box box-primary">

        @if(Auth::user()->role_id == 2)
            <div class="box-header with-border">
                <h3 class="box-title"> <strong> Division Journey Requests </strong></h3>
            </div> 

        @else
            <div class="box-header with-border">
                <h3 class="box-title"> <strong>Journey Requests List </strong></h3>
            </div> 
        @endif

        @if($journeys)
        <div class="box-body" style="height: 550px; overflow: auto;">
           
            <table class="table" id="table" >
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
                        <td>{{$journey->vehical->fullname}}</td>
                        <td>{{$journey->expected_start_date_time->toDayDateTimeString()}}</td>
                        <td>{{$journey->expected_end_date_time->toDayDateTimeString()}}</td>

                        <td width="200px">
                            <button class="btn btn-success btnView" data-toggle="modal" data-target="#{{$journey->id}}"><i class="fa fa-eye"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade bs-example-modal-lg" id="{{$journey->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>Journey Request Approval
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
                                            <dd>{{$journey->applicant->emp_title.' '.$journey->applicant->emp_initials.'. '.$journey->applicant->emp_surname}}</dd>
                                            <dt>Division</dt>
                                            <dd>{{$journey->applicant->division->dept_name}}</dd>
                                            <dt>Email</dt>
                                            <dd>{{$journey->applicant->emp_email.'@ucsc.cmb.ac.lk'}}</dd>
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
                                        </dl>
            
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-12">
                                                {!! Form::open(['method' => 'post','id'=>'formApproval{{$journey->id}}','action'=>['JourneyRequestController@approval',$journey->id]]) !!}
                                                <div class="form-group">
                                                    <label for="remarks">Remarks</label>
                                                    {!! Form::textarea('remarks',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2' ]) !!}
                                                </div>
                                                <div class="form-group">
                                                    <label for="is_approved">Approve</label> 
                                                    {!! Form::checkbox('is_approved', 1, true) !!}
                                                </div>
                                            </div>
                                </div>
                                <div class="modal-footer">
                                <input type="submit" class="btn btn-success" name="submitType" value="Submit">
                                <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
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
            {{-- @foreach($journeys as $journey)
          
            @endforeach   --}}
        </div>
        @endif
    </div>

    @if(Auth::user()->role_id == 2) 
        @if($otherDivHeadsJourneys != null)  

            {{-- for Other Divisional heads' journey requests --}}
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h2 class="box-title"> <strong> Other Divisinal Heads' Journey Requests </strong> </h2>
                </div>
        
                <div class="box-body" style="height: 550px; overflow: auto;" >
                    
                    <table class="table" id="otherDivtable" >
                        <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Applicant Division</th>
                            <th>Vehicle</th>
                            <th>Start Date / Time</th>
                            <th>End Date / Time</th>
                            <th width="150px">Expected Distance</th>
                            <th width="200px">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($otherDivHeadsJourneys as $journey)
                            <tr>
                                <td>{{$journey->applicant->emp_title.' '.$journey->applicant->emp_initials.'. '.$journey->applicant->emp_surname}}</td>
                                <td>{{$journey->applicant->division->dept_name}}</td>
                                <td>{{$journey->vehical->fullname}}</td>
                                <td>{{$journey->expected_start_date_time->toDayDateTimeString()}}</td>
                                <td>{{$journey->expected_end_date_time->toDayDateTimeString()}}</td>
                                <th>{{$journey->expected_distance }} </th> 

                                <td width="200px">
                                    <button class="btn btn-success btnView" data-toggle="modal" data-target="#{{$journey->id}}"><i class="fa fa-eye"></i></button>
                                    {{-- <button id="{{$journey->id}}" class="btn btn-success btnViewLong"><i class="fa fa-eye"></i></button> --}}
                                </td>
                            </tr>
                            <div class="modal fade bs-example-modal-lg" id="{{$journey->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Journey Request Approval
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
                                                    </dl>
                        
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {!! Form::open(['method' => 'post','id'=>'formApproval{{$journey->id}}','action'=>['JourneyRequestController@approval',$journey->id]]) !!}
                                                    <div class="form-group">
                                                        <label for="remarks">Remarks</label>
                                                        {!! Form::textarea('remarks',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2' ]) !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="is_approved">Approve</label> 
                                                        {!! Form::checkbox('is_approved', 1, true) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-success" name="submitType" value="Submit">
                                                <button type="button" class="btn btn-danger" id="close" data-dismiss="modal">Close</button>
                                                    {!! Form::close() !!}
                                            </div> 
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
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
                </div>         
            </div>
        @endif   
    @endif
    
@endsection

@section('scripts')

    <script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>

    {{-- <script>
        $(function () {
            $('.btnView').on('click',function () {

                var longDisJourneys = {!! json_encode($longDisJourneys->toArray()) !!};
                console.log(longDisJourneys);

                $.confirm({
                    title:'',
                    columnClass: 'col-lg-8 col-lg-offset-2',
                    content:$('div#d'+$(this).attr('id')).html(),
                    buttons: {
                        formSubmit: {
                            text: 'Submit',
                            btnClass: 'btn-green',
                            action: function () {
                                $('#formApproval').submit();
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

    <script>
        $(document).ready(function() {
            $('#longDistable').DataTable( {
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

    <script>
        $(document).ready(function() {
            $('#otherDivtable').DataTable( {
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

@endsection