@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')

@endsection

@section('header', 'View Vehicles')

@section('description', 'View existing vehicles.')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Existing Vehicles List</h3>

        </div>
        <div class="box-header">
            @include('layouts.errors')
            @include('layouts.success')
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
            @if($vehicles)
                <table class="table" id="table">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Reg No</th>
                        <th>Working Name</th>
                        <th>Purchased at</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th width="110px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td>
                                @if($vehicle->photo)
                                    {!! '<img height="50px" src="'.$vehicle->photo->path.'" alt="">' !!}
                                @endif
                            </td>
                            <td>{{$vehicle->registration_no?$vehicle->registration_no:'N/A'}}</td>
                            <td>{{$vehicle->name?$vehicle->name:'N/A'}}</td>
                            <td>{{$vehicle->date_of_perchase?$vehicle->date_of_perchase->formatLocalized('%A %d %B %Y'):'N/A'}}</td>
                            <td>{{$vehicle->created_at?$vehicle->created_at->diffForHumans():'N/A'}}</td>
                            <td>{{$vehicle->updated_at?$vehicle->updated_at->diffForHumans():'N/A'}}</td>
                            <td width="110px">
                                <button id="{{$vehicle->id}}" class="btn btn-success btnView"><i class="fa fa-eye"></i></button>
                                <a href="{{url('/vehicle/'.$vehicle->id.'/edit')}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                <a href="{{url('/vehicle/'.$vehicle->id.'/edit')}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Photo</th>
                        <th>Reg No</th>
                        <th>Working Name</th>
                        <th>Purchased at</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th width="110px">Actions</th>
                    </tr>
                    </tfoot>
                </table>
                @foreach($vehicles as $vehicle)
                    <div id="d{{$vehicle->id}}" hidden="hidden">

                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        @if($vehicle->photo)
                                            {!! '<img height="50px" src="'.$vehicle->photo->path.'" alt="">' !!}
                                        @else
                                            <img src="http://build.ford.com/dig/Ford/F-150/2018/BP3TT-FULL-EXT/Image[%7CFord%7CF-150%7C2018%7C1%7C1.%7C300A.W1E.145.J7.LSC.88M.A5GAB.52P.SS5.64F.53B.CCAB.89G.99P.CLO.AWD.XLT.924.50S.595.58B.]/EXT/4/vehicle.png" class="img-polaroid" alt="Lenovo Desktop">
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <h2>{{$vehicle->name?$vehicle->name:''}}</h2>
                                            </div>
                                            <div class="row">
                                                <h4 class="muted">Reg No: {{$vehicle->registration_no?$vehicle->registration_no:''}}</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">Price - Rs:{{$vehicle->perchase_price?$vehicle->perchase_price:''}}</div>
                                                <div class="col-md-4">Date of Registration: {{$vehicle->date_of_registration?$vehicle->date_of_registration->formatLocalized('%A %d %B %Y'):''}}</div>
                                                <div class="col-md-4"></div>
                                            </div>
                                            <div class="row">
                                                <p>Purchased At: {{$vehicle->date_of_perchase?$vehicle->date_of_perchase->formatLocalized('%A %d %B %Y'):''}}</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4"><p class="muted">Created By:</p></div>
                                                <div class="col-md-4"><p class="muted">Updated By:</p></div>
                                                <div class="col-md-4"></div>
                                            </div>
                                            <div class="row">
                                                Dept Number:{{$vehicle->dept_no?$vehicle->dept_no:''}}
                                            </div>
                                            <div class="row">
                                                Make and Type: {{$vehicle->make_and_type?$vehicle->make_and_type:''}}
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">Chassis Number: {{$vehicle->chassis_no?$vehicle->chassis_no:''}}</div>
                                                <div class="col-md-4">Engine Number: {{$vehicle->engine_no?$vehicle->engine_no:''}}</div>
                                                <div class="col-md-4">Horse Power: {{$vehicle->horse_power?$vehicle->horse_power:''}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">Pay Load: {{$vehicle->pay_load?$vehicle->pay_load:''}}</div>
                                                <div class="col-md-4">Type of Body: {{$vehicle->type_of_body?$vehicle->type_of_body:''}}</div>
                                                <div class="col-md-4"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">Number of Cylinders: {{$vehicle->no_of_cylinders?$vehicle->no_of_cylinders:''}}</div>
                                                <div class="col-md-4">Bore: {{$vehicle->bore?$vehicle->bore:''}}</div>
                                                <div class="col-md-4">Stroke: {{$vehicle->stroke?$vehicle->stroke:''}}</div>
                                            </div>
                                            <div class="row">
                                                Carburettor Make and Type: {{$vehicle->carburettor_make_and_type?$vehicle->carburettor_make_and_type:''}}
                                            </div>
                                            <div class="row">
                                                Sizes of Jets
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">Main: {{$vehicle->sizes_of_jets_main?$vehicle->sizes_of_jets_main:''}}</div>
                                                <div class="col-md-4">Compensation: {{$vehicle->sizes_of_jets_compensation?$vehicle->sizes_of_jets_compensation:''}}</div>
                                                <div class="col-md-4">Choke: {{$vehicle->sizes_of_jets_choke?$vehicle->sizes_of_jets_choke:''}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">Fuel Injection Pump Make: {{$vehicle->fuel_injection_pump_make_and_make?$vehicle->fuel_injection_pump_make_and_make:''}}</div>
                                                <div class="col-md-4">Fuel Injection Pump Makes Number: {{$vehicle->fuel_injection_pump_makers_no?$vehicle->fuel_injection_pump_makers_no:''}}</div>
                                                <div class="col-md-4"></div>
                                            </div>
                                            <div class="row">
                                                Atomiser (Injectors) Make: {{$vehicle->atomisers_make?$vehicle->atomisers_make:''}}
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">Coil or Magneto Make: {{$vehicle->coil_or_magneto_make?$vehicle->coil_or_magneto_make:''}}</div>
                                                <div class="col-md-3">Maker's Number: {{$vehicle->coil_or_magneto_makers_no?$vehicle->coil_or_magneto_makers_no:''}}</div>
                                                <div class="col-md-3">Type: {{$vehicle->coil_or_magneto_type?$vehicle->coil_or_magneto_type:''}}</div>
                                                <div class="col-md-3">Rotation: {{$vehicle->coil_or_magneto_rotation?$vehicle->coil_or_magneto_rotation:''}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">Lighting Set Make: {{$vehicle->lighting_set_make?$vehicle->lighting_set_make:''}}</div>
                                                <div class="col-md-4">Lighting Set Type: {{$vehicle->lighting_set_type?$vehicle->lighting_set_type:''}}</div>
                                                <div class="col-md-4">Lighting Set Voltage: {{$vehicle->lighting_set_voltage?$vehicle->lighting_set_voltage:''}}</div>
                                            </div>
                                            <div class="row">Tyres</div>
                                            <div class="row">
                                                <div class="col-md-3">Front Size: {{$vehicle->tyres_size_front?$vehicle->tyres_size_front:''}}</div>
                                                <div class="col-md-3">Rear Size: {{$vehicle->tyres_size_rear?$vehicle->tyres_size_rear:''}}</div>
                                                <div class="col-md-3">Front Pressure: {{$vehicle->tyres_pressure_front?$vehicle->tyres_pressure_front:''}}</div>
                                                <div class="col-md-3">Rear Pressure: {{$vehicle->tyres_pressure_rear?$vehicle->tyres_pressure_rear:''}}</div>
                                            </div>
                                            <div class="row">Battery</div>
                                            <div class="row">
                                                <div class="col-md-4">Dimensions: {{$vehicle->battery_dimensions?$vehicle->battery_dimensions:''}}</div>
                                                <div class="col-md-4">Voltage: {{$vehicle->bettery_voltage?$vehicle->bettery_voltage:''}}</div>
                                                <div class="col-md-4">Amperage: {{$vehicle->battery_amperage?$vehicle->battery_amperage:''}}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">Dimensions: {{$vehicle->battery_dimensions?$vehicle->battery_dimensions:''}}</div>
                                                <div class="col-md-4">Voltage: {{$vehicle->bettery_voltage?$vehicle->bettery_voltage:''}}</div>
                                                <div class="col-md-4">Amperage: {{$vehicle->battery_amperage?$vehicle->battery_amperage:''}}</div>
                                            </div>
                                            <div class="row">Capacity</div>
                                            <div class="row">
                                                <div class="col-md-3">Fuel Tank: {{$vehicle->capacity_of_fuel_tank?$vehicle->capacity_of_fuel_tank:''}}</div>
                                                <div class="col-md-3">Reserve Tank: {{$vehicle->capacity_of_reserve_tank?$vehicle->capacity_of_reserve_tank:''}}</div>
                                                <div class="col-md-2">Crank Case: {{$vehicle->engine_crank_case?$vehicle->engine_crank_case:''}}</div>
                                                <div class="col-md-2">Gear Box: {{$vehicle->gear_box?$vehicle->gear_box:''}}</div>
                                                <div class="col-md-2">Rear Axel: {{$vehicle->rear_axel?$vehicle->rear_axel:''}}</div>
                                            </div>
                                            <div class="row">Oil Specifications</div>
                                            <div class="row">
                                                <div class="col-md-3">Engine: {{$vehicle->oil_specifications_engine?$vehicle->oil_specifications_engine:''}}</div>
                                                <div class="col-md-3">Gear Box Oil: {{$vehicle->oil_specifications_gear_oil?$vehicle->oil_specifications_gear_oil:''}}</div>
                                                <div class="col-md-3">Shock Absorber Fluid: {{$vehicle->oil_specifications_shock_absorber_fluid?$vehicle->oil_specifications_shock_absorber_fluid:''}}</div>
                                                <div class="col-md-3">Differential Oil: {{$vehicle->oil_specifications_differential_oil?$vehicle->oil_specifications_differential_oil:''}}</div>
                                            </div>
                                            <br>
                                            <p><a href="{{url('/vehicle/'.$vehicle->id.'/edit')}}" class="btn btn-success btn-large">Edit Vehicle Details</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            @endif
        </div>
    </div>
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
            } );
        } );

    </script>
    <script>
        $(function () {
            $('.btnView').on('click',function () {
                $.confirm({
                    title:'Vehicle Details',
                    columnClass: 'col-md-12',
                    content:$('div#d'+$(this).attr('id')).html()
                });
            })
        })
    </script>
@endsection