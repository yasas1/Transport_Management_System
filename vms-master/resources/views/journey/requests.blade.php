@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')
    <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet">
@endsection

@section('header', 'View Journey Requests')

@section('description', 'Select a journey request to approve.')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Journey Requests List</h3>
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
                                <button id="{{$journey->id}}" class="btn btn-success btnView"><i class="fa fa-eye"></i></button>
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
                    <div id="d{{$journey->id}}" hidden="hidden">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Journey Request Approval <span class="label label-danger pull-right">Not Approved</span></h3>
                                <hr>
                            </div>
                        </div>
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
                            <hr>
                            <div class="col-md-12">
                                {!! Form::open(['method' => 'post','id'=>'formApproval','action'=>['JourneyRequestController@approval',$journey->id]]) !!}
                                <div class="form-group">
                                    <label for="remarks">Remarks</label>
                                    {{Form::textarea('remarks',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2' ])}}
                                </div>
                                <div class="form-group">
                                    <label for="is_approved">Approve</label> &nbsp
                                    {!! Form::checkbox('is_approved', 1, true); !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
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
    <script>
        $(function () {
            $('.btnView').on('click',function () {
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
    </script>
@endsection