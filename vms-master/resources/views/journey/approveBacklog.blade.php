@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')
    {{-- <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet"> --}}
@endsection

@section('header', 'View Backlog Journey')

@section('description', 'Select a journey request to approve.')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')

    {{-- for Other Divisional heads' journey requests --}}
    <div class="box box-primary">

        <div class="box-header with-border">
            <h2 class="box-title"> <strong> Backlog Journeys </strong> </h2>
        </div>
        @if($journeys)
        <div class="box-body" style=" height:700px; overflow: auto;" >
            
            <table class="table" id="table"  >
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
                        <td>{{$journey->applicant->emp_title.' '.$journey->applicant->emp_initials.'. ' .$journey->applicant->emp_surname}}</td>
                        <td>{{$journey->applicant->division->dept_name}}</td>
                        @if($journey->vehical_id != null)
                            <td>{{$journey->vehical->fullname}}</td>
                        @endif
                        @if($journey->vehical_id == null)
                            <td>External Vehicle</td>
                        @endif
                        <td>{{$journey->real_start_date_time->toDayDateTimeString()}}</td>
                        <td>{{$journey->real_end_date_time->toDayDateTimeString()}}</td>
                        <td width="200px">
                            <button class="btn btn-success btnView" data-toggle="modal" data-target="#{{$journey->id}}"><i class="fa fa-eye"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                {{-- <tfoot>
                <tr>
                    <th>Applicant Name</th>
                    <th>Applicant Division</th>
                    <th>Vehicle</th>
                    <th>Start Date / Time</th>
                    <th>End Date / Time</th>
                    <th>Updated at</th>
                    <th width="200px">Actions</th>
                </tr>
                </tfoot> --}}
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
                                            <span class="label label-danger pull-right">Not Approved</span>
                                            <span class="label label-info pull-right">Backlog</span>                                        
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
                                            <dd>{{$journey->applicant->emp_title.' '.$journey->applicant->emp_initials.'. ' .$journey->applicant->emp_surname}}</dd>
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
                                        </dl>                                        
                                    </div>
                                </div>                              

                                <div class="row">
                                    <div class="col-md-6">
                                        <dl class="dl-horizontal">
                                            <h4>Final Details</h4>
                                            <dt> Distance</dt>
                                            <dd>{{$journey->real_distance}}</dd>
                                            <dt>Start Time</dt>
                                            <dd>{{$journey->real_start_date_time->toDayDateTimeString()}}</dd>
                                            <dt>End Time</dt>
                                            <dd>{{$journey->real_end_date_time->toDayDateTimeString()}}</dd>
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
        
    
@endsection

@section('scripts')

    <script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>

    
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

@endsection