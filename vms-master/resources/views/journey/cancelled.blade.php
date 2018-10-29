@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')
    {{-- <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet"> --}}  
@endsection

@section('header', 'Not Occurred Journeys')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
    <div class="box box-primary" style="height: 450px; overflow: auto;" >
        <div class="box-header with-border">
            <h3 class="box-title"> <strong> Cancelled Journeys </strong></h3>
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
                        <th>Requested Place</th>
                        <th>Requested Distance</th>
                        {{-- <th width="200px">Actions</th> --}}
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
                            <td>{{$journey->places_to_be_visited}}</td>
                            <td>{{$journey->expected_distance}}</td>
                            {{-- <td width="200px">
                                <button class="btn btn-success btnView" id="view" value={{$journey->id}} ><i class="fa fa-eye"></i></button> 
                            </td> --}}
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
            @endif

        </div>
    </div>

    <div class="box box-primary" style="height: 450px; overflow: auto;" >
        <div class="box-header with-border">
            <h3 class="box-title" > <strong> Denied Journeys </strong> </h3>
        </div>
        <div class="box-body">
            @if($DeniedJourneys)
                <table class="table" id="tableDenied">
                    <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>Applicant Division</th>
                        <th>Vehicle</th>
                        <th>Start Date / Time</th>
                        <th>End Date / Time</th>
                        <th>Requested Place</th>
                        <th>Requested Distance</th>
                        {{-- <th width="200px">Actions</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($DeniedJourneys as $journey)
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
                            <td>{{$journey->places_to_be_visited}}</td>
                            <td>{{$journey->expected_distance}}</td>
                            {{-- <td width="200px">
                                <button class="btn btn-success btnView" id="view" value={{$journey->id}} ><i class="fa fa-eye"></i></button> 
                            </td> --}}
                        </tr>

                    @endforeach    
                    </tbody>
                    <tfoot>
                    {{-- <tr>
                        <th>Applicant Name</th>
                        <th>Applicant Division</th>
                        <th>Vehicle</th>
                        <th>Start Date / Time</th>
                        <th>End Date / Time</th>
                        <th>Updated at</th>
                        <th width="200px">Actions</th>
                    </tr> --}}
                    </tfoot>
                </table>              
            @endif

        </div>
    </div>
    {{-- <div>
        @foreach($divHeads as $divHead)

        @if($divHead->head!='')
            <p> {{$divHead->head}} </p>
            <span>
                {{$divHead->head()->first()->emp_initials.'. '.$divHead->head()->first()->emp_surname.' ( '.$divHead->dept_name.' )'}}
            </span>
            
        @endif

        @endforeach
    </div> --}}

@endsection

@section('scripts')
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
        $('#tableDenied').DataTable( {
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

@endsection