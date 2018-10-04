@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')

@endsection

@section('header', 'Vehicle Details')

@section('description', 'Edit a existing vehicle.')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Editing a existing vehical</h3>

        </div>
        <div class="box-header">
            @include('layouts.errors')
            @include('layouts.success')
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">

            {!! Form::model($vehicle,['method' => 'PATCH','files'=>true,'action'=>['VehicleController@update',$vehicle->id]]) !!}

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label>Upload Image</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <img id="imgVehicle" class="img-responsive pull-left"
                                 src="{{$vehicle->photo?asset($vehicle->photo->path):asset('images/van.png')}}"
                                 alt="Vehicle Sample Image"><br>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            {!! Form::label('photo', 'Vehicle Photo',['class' => 'control-label']) !!}
                            {{Form::file('photo',['id'=>'imgVehicleInput'])}}
                            <p class="help-block">Select a profile photo (max 500kb)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="journey_color">Journey Color</label>
                <input name="journey_color" class="jscolor" value="2A6AD7"> 
                
            </div>
            <div class="form-group">
                <label for="number">Registration No <span class="text text-danger">*</span></label>
                {{Form::text('registration_no',null,['class'=>'form-control','placeholder'=>'Registration Number Of The Vehicle','required'])}}
            </div>

            <div class="form-group">
                <label for="dept_no">Department Number</label>
                {{Form::text('dept_no',null,['class'=>'form-control','placeholder'=>'Department Number'])}}
            </div>

            <div class="form-group">
                <label for="count">Working Name </label>
                {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Working Name Of The Vehicle'])}}
            </div>

            <div class="form-group">
                <label for="count">Date of Registration</label>
                {{Form::date('date_of_registration',null,['class'=>'form-control','placeholder'=>'Date Of Registration'])}}
            </div>

            <div class="form-group">
                <label for="make_and_type">Make and Type</label>
                {{Form::text('make_and_type',null,['class'=>'form-control','placeholder'=>'Make and Type'])}}
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="chassis_no">Chassis Number</label>
                        {{Form::text('chassis_no',null,['class'=>'form-control','placeholder'=>'Chassis Number'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="engine_no">Engine Number</label>
                        {{Form::text('engine_no',null,['class'=>'form-control','placeholder'=>'Engine Number'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="horse_power">Horse Power</label>
                        {{Form::text('horse_power',null,['class'=>'form-control','placeholder'=>'Horse Power'])}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pay_load">Pay Load</label>
                        {{Form::text('pay_load',null,['class'=>'form-control','placeholder'=>'Pay Load'])}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type_of_body">Type of Body</label>
                        {{Form::text('type_of_body',null,['class'=>'form-control','placeholder'=>'Type of Body'])}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="no_of_cylinders">Number of Cylinders</label>
                        {{Form::text('no_of_cylinders',null,['class'=>'form-control','placeholder'=>'Number of Cylinders'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bore">Bore</label>
                        {{Form::text('bore',null,['class'=>'form-control','placeholder'=>'Bore'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="stroke">Stroke</label>
                        {{Form::text('stroke',null,['class'=>'form-control','placeholder'=>'Stroke'])}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="carburettor_make_and_type">Carburettor Make and Type</label>
                {{Form::text('carburettor_make_and_type',null,['class'=>'form-control','placeholder'=>'Carburettor Make and Type'])}}
            </div>

            <div class="form-group">
                <label for="">Sizes of Jets</label>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sizes_of_jets_main">Main</label>
                        {{Form::text('sizes_of_jets_main',null,['class'=>'form-control','placeholder'=>'Main'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sizes_of_jets_compensation">Compensation</label>
                        {{Form::text('sizes_of_jets_compensation',null,['class'=>'form-control','placeholder'=>'Compensation'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sizes_of_jets_compensation">Choke</label>
                        {{Form::text('sizes_of_jets_compensation',null,['class'=>'form-control','placeholder'=>'Choke'])}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fuel_injection_pump_make">Fuel Injection Pump Make</label>
                        {{Form::text('fuel_injection_pump_make',null,['class'=>'form-control','placeholder'=>'Fuel Injection Pump Make'])}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fuel_injection_pump_makers_no">Fuel Injection Pump Makes Number</label>
                        {{Form::text('fuel_injection_pump_makers_no',null,['class'=>'form-control','placeholder'=>'Fuel Injection Pump Makes Number'])}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="atomisers_make">Atomiser (Injectors) Make</label>
                {{Form::text('atomisers_make',null,['class'=>'form-control','placeholder'=>'Atomiser (Injectors) Make'])}}
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="coil_or_magneto_make">Coil or Magneto Make</label>
                        {{Form::text('coil_or_magneto_make',null,['class'=>'form-control','placeholder'=>'Coil or Magneto Make'])}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="coil_or_magneto_makers_no">Maker's Number</label>
                        {{Form::text('coil_or_magneto_makers_no',null,['class'=>'form-control','placeholder'=>'Maker\'s Number'])}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="coil_or_magneto_type">Type</label>
                        {{Form::text('coil_or_magneto_type',null,['class'=>'form-control','placeholder'=>'Type'])}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="coil_or_magneto_rotation">Rotation</label>
                        {{Form::text('coil_or_magneto_rotation',null,['class'=>'form-control','placeholder'=>'Rotation'])}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lighting_set_make">Lighting Set Make</label>
                        {{Form::text('lighting_set_make',null,['class'=>'form-control','placeholder'=>'Lighting Set Make'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lighting_set_type">Lighting Set Type</label>
                        {{Form::text('lighting_set_type',null,['class'=>'form-control','placeholder'=>'Lighting Set Type'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lighting_set_voltage">Lighting Set Voltage</label>
                        {{Form::text('lighting_set_voltage',null,['class'=>'form-control','placeholder'=>'Lighting Set Voltage'])}}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Tyres</label>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="tyres_size_front">Front Size</label>
                        {{Form::text('tyres_size_front',null,['class'=>'form-control','placeholder'=>'Front Tyre Size'])}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="tyres_size_rear">Rear Size</label>
                        {{Form::text('tyres_size_rear',null,['class'=>'form-control','placeholder'=>'Rear Tyre Size'])}}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="tyres_pressure_front">Front Pressure</label>
                        {{Form::text('tyres_pressure_front',null,['class'=>'form-control','placeholder'=>'Front Tyre Pressure'])}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="tyres_pressure_rear">Rear Pressure</label>
                        {{Form::text('tyres_pressure_rear',null,['class'=>'form-control','placeholder'=>'Rear Tyre Pressure'])}}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Battery</label>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="battery_dimensions">Dimensions</label>
                        {{Form::text('battery_dimensions',null,['class'=>'form-control','placeholder'=>'Battery Dimensions'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bettery_voltage">Voltage</label>
                        {{Form::text('bettery_voltage',null,['class'=>'form-control','placeholder'=>'Battery Voltage'])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="battery_amperage">Amperage</label>
                        {{Form::text('battery_amperage',null,['class'=>'form-control','placeholder'=>'Battery Amperage'])}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="battery_amperage">Capacity Of</label>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="capacity_of_fuel_tank">Fuel Tank</label>
                        {{Form::text('capacity_of_fuel_tank',null,['class'=>'form-control','placeholder'=>'Capacity of Fuel Tank'])}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="capacity_of_reserve_tank">Reserve Tank</label>
                        {{Form::text('capacity_of_reserve_tank',null,['class'=>'form-control','placeholder'=>'Capacity of Reserve Tank'])}}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="engine_crank_case">Crank Case</label>
                        {{Form::text('engine_crank_case',null,['class'=>'form-control','placeholder'=>'Capacity of Crank Case'])}}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="gear_box">Gear Box</label>
                        {{Form::text('gear_box',null,['class'=>'form-control','placeholder'=>'Capacity of Gear Box'])}}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="rear_axel">Rear Axel</label>
                        {{Form::text('rear_axel',null,['class'=>'form-control','placeholder'=>'Capacity of Rear Axel'])}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="">Oil Specifications</label>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="oil_specifications_engine">Engine</label>
                        {{Form::text('oil_specifications_engine',null,['class'=>'form-control','placeholder'=>'Engine Oil'])}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="oil_specifications_gear_oil">Gear Box Oil</label>
                        {{Form::text('oil_specifications_gear_oil',null,['class'=>'form-control','placeholder'=>'Gear Box Oil'])}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="oil_specifications_">Shock Absorber Fluid</label>
                        {{Form::text('oil_specifications_shock_absorber_fluid',null,['class'=>'form-control','placeholder'=>'Shock Absorber Fluid'])}}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="oil_specifications_differential_oil">Differential Oil</label>
                        {{Form::text('oil_specifications_differential_oil',null,['class'=>'form-control','placeholder'=>'Differential Oil'])}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="date_of_perchase">Date of Purchase</label>
                        {{Form::date('date_of_perchase',null,['class'=>'form-control','placeholder'=>'Date of Purchase'])}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="perchase_price">Purchase Price</label>
                        {{Form::text('perchase_price',null,['class'=>'form-control','placeholder'=>'Purchase Price'])}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="documents">Upload Documents</label>
                        {{Form::file('documents[]',['id'=>'documentsInput','multiple'])}}
                    </div>
                    <div>
                        <table class="table table-bordered">
                            <tbody id="table">
                                @if($documents)
                                    @foreach($documents as $document)
                                        <tr>
                                            <td><a href="{{asset($document->path)}}">{{$document->name}}</a></td>
                                            <td><a href="{{url('/vehicle/document/'.$document->id.'/delete')}}" class="btn btn-sm btn-danger">-</a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <p id="file_preview"></p>
                </div>
            </div>

            <div class="form-group">
                {{Form::submit('Update', ['class'=>'btn btn-success'])}}
                {{Form::submit('Back', ['class'=>'btn btn-warning'])}}
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/jscolor.js')}}"></script>
    <script>
        //  Vehicle image loading when user select a image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgVehicle').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(function () {
            $('#imgVehicleInput').change(function () {
                readURL(this);
            })
        });

        $(function () {
            $('#documentsInput').change(function () {
                var lenght = document.getElementById('documentsInput').files.length;
                var rows = '';
                for(var i=0;i<lenght;i++)
                {
                    var ext = document.getElementById('documentsInput').files[i].name.split('.').pop();
                    var logo = '<i class="fa fa-file-o"></i>';
                    if(ext=='doc'||ext=='docx'){
                        logo = "<i class=\"fa fa-file-word-o\"></i>";
                    }else if(ext=='pdf'){
                        logo = "<i class=\"fa fa-file-pdf-o\"></i>";
                    }
                    rows += "" +
                        "<tr>\n" +
                        "    <td>" + i + "</td>\n" +
                        "    <td>" + document.getElementById('documentsInput').files[i].name + "</td>\n" +
                        "    <td><span class=\"badge bg-red\"></span>" + logo
                        + "</td>\n" +
                        "</tr>";
                }

                $('#table').append(rows);
            })
        })
    </script>
@endsection