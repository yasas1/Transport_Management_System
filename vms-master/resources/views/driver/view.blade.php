@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="span5">
                <img src="http://build.ford.com/dig/Ford/F-150/2018/BP3TT-FULL-EXT/Image[%7CFord%7CF-150%7C2018%7C1%7C1.%7C300A.W1E.145.J7.LSC.88M.A5GAB.52P.SS5.64F.53B.CCAB.89G.99P.CLO.AWD.XLT.924.50S.595.58B.]/EXT/4/vehicle.png" class="img-polaroid" alt="Lenovo Desktop">
            </div>
            <div class="span7">
                <div class="row">
                    <h2>{{$vehicle->name}}</h2>
                </div>
                <div class="row">
                    <h4 class="muted">{{$vehicle->registration_no}}</h4>
                </div>
                <div class="row">
                    <div class="col-md-4">Price - Rs:{{$vehicle->perchase_price}}</div>
                    <div class="col-md-4">Date of Registration: {{$vehicle->date_of_registration->formatLocalized('%A %d %B %Y')}}</div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row">
                    <p>Purchased At: {{$vehicle->date_of_registration->formatLocalized('%A %d %B %Y')}}</p>
                </div>
                <div class="row">
                    <div class="col-md-4"><p class="muted">Created By:</p></div>
                    <div class="col-md-4"><p class="muted">Updated By:</p></div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row">
                    Dept Number:{{$vehicle->dept_no}}
                </div>
                <div class="row">
                    Make and Type: {{$vehicle->make_and_type}}
                </div>
                <div class="row">
                    <div class="col-md-4">Chassis Number: {{$vehicle->chassis_no}}</div>
                    <div class="col-md-4">Engine Number: {{$vehicle->engine_no}}</div>
                    <div class="col-md-4">Horse Power: {{$vehicle->horse_power}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Pay Load: {{$vehicle->pay_load}}</div>
                    <div class="col-md-4">Type of Body: {{$vehicle->type_of_body}}</div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row">
                    <div class="col-md-4">Number of Cylinders: {{$vehicle->no_of_cylinders}}</div>
                    <div class="col-md-4">Bore: {{$vehicle->bore}}</div>
                    <div class="col-md-4">Stroke: {{$vehicle->stroke}}</div>
                </div>
                <div class="row">
                    Carburettor Make and Type: {{$vehicle->carburettor_make_and_type}}
                </div>
                <div class="row">
                    Sizes of Jets
                </div>
                <div class="row">
                    <div class="col-md-4">Main: {{$vehicle->sizes_of_jets_main}}</div>
                    <div class="col-md-4">Compensation: {{$vehicle->sizes_of_jets_compensation}}</div>
                    <div class="col-md-4">Choke: {{$vehicle->sizes_of_jets_choke}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Fuel Injection Pump Make: {{$vehicle->fuel_injection_pump_make_and_make}}</div>
                    <div class="col-md-4">Fuel Injection Pump Makes Number: {{$vehicle->fuel_injection_pump_makers_no}}</div>
                    <div class="col-md-4"></div>
                </div>
                <div class="row">
                    Atomiser (Injectors) Make: {{$vehicle->atomisers_make}}
                </div>
                <div class="row">
                    <div class="col-md-3">Coil or Magneto Make: {{$vehicle->coil_or_magneto_make}}</div>
                    <div class="col-md-3">Maker's Number: {{$vehicle->coil_or_magneto_makers_no}}</div>
                    <div class="col-md-3">Type: {{$vehicle->coil_or_magneto_type}}</div>
                    <div class="col-md-3">Rotation: {{$vehicle->coil_or_magneto_rotation}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Lighting Set Make: {{$vehicle->lighting_set_make}}</div>
                    <div class="col-md-4">Lighting Set Type: {{$vehicle->lighting_set_type}}</div>
                    <div class="col-md-4">Lighting Set Voltage: {{$vehicle->lighting_set_voltage}}</div>
                </div>
                <div class="row">Tyres</div>
                <div class="row">
                    <div class="col-md-3">Front Size: {{$vehicle->tyres_size_front}}</div>
                    <div class="col-md-3">Rear Size: {{$vehicle->tyres_size_rear}}</div>
                    <div class="col-md-3">Front Pressure: {{$vehicle->tyres_pressure_front}}</div>
                    <div class="col-md-3">Rear Pressure: {{$vehicle->tyres_pressure_rear}}</div>
                </div>
                <div class="row">Battery</div>
                <div class="row">
                    <div class="col-md-4">Dimensions: {{$vehicle->battery_dimensions}}</div>
                    <div class="col-md-4">Voltage: {{$vehicle->bettery_voltage}}</div>
                    <div class="col-md-4">Amperage: {{$vehicle->battery_amperage}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Dimensions: {{$vehicle->battery_dimensions}}</div>
                    <div class="col-md-4">Voltage: {{$vehicle->bettery_voltage}}</div>
                    <div class="col-md-4">Amperage: {{$vehicle->battery_amperage}}</div>
                </div>
                <div class="row">Capacity</div>
                <div class="row">
                    <div class="col-md-3">Fuel Tank: {{$vehicle->capacity_of_fuel_tank}}</div>
                    <div class="col-md-3">Reserve Tank: {{$vehicle->capacity_of_reserve_tank}}</div>
                    <div class="col-md-2">Crank Case: {{$vehicle->engine_crank_case}}</div>
                    <div class="col-md-2">Gear Box: {{$vehicle->gear_box}}</div>
                    <div class="col-md-2">Rear Axel: {{$vehicle->rear_axel}}</div>
                </div>
                <div class="row">Oil Specifications</div>
                <div class="row">
                    <div class="col-md-3">Engine: {{$vehicle->oil_specifications_engine}}</div>
                    <div class="col-md-3">Gear Box Oil: {{$vehicle->oil_specifications_gear_oil}}</div>
                    <div class="col-md-3">Shock Absorber Fluid: {{$vehicle->oil_specifications_shock_absorber_fluid}}</div>
                    <div class="col-md-3">Differential Oil: {{$vehicle->oil_specifications_differential_oil}}</div>
                </div>
                <br>
                <p><a href="#" class="btn btn-success btn-large">Edit Vehicle Details</a></p>
            </div>
        </div>
    </div>
@endsection