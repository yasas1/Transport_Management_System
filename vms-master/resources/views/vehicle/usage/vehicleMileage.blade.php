@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE MILEAGE')

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> 
        #datepicker > span:hover{cursor: pointer;color: blue;}
    </style>
@endsection

@section('header', 'Vehicle Mileage')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
    <div class="flash-message" id="flash-message" ></div>
  
    <div class="box box-primary">
    
        <div class="box-body">

            <div class="row"> 
                {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeVehicleMileage']) !!}
                <div class="col-md-4"> 

                    <h4><i class="fa fa-car"></i> Vehicle </h4>
                    <div>             
                        {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                    </div>                  
                </div>
                <div class="col-md-2"> </div>

            </div> <br>

            <div class="row"> 

                <div class="col-md-4"> 
    
                    <h4><i class="fa fa-calendar"></i> Date </h4>
                                                        
                    <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="date" name="date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
            
                </div>                 
                
            </div><br>
        
            <h4 class="modal-title" > <i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading &nbsp (km)</h4>
            <div class="row">

                <div class="col-md-4">
              
                    <h4> <i class="glyphicon glyphicon-log-out"></i> &nbsp Begin Of The Day</h4>
                    <dl>
                        {{Form::number('meter_reading_day_begin', null,['class'=>'form-control meterfields','id'=>'input_begin','placeholder'=>'Begin of the day'])}}                       
                    </dl>

                </div>

                <div class="col-md-2"> </div>

                <div class="col-md-4">

                    <h4> <i class="glyphicon glyphicon-log-in"></i> &nbsp End of The Day</h4>
                    <dl>
                        {{Form::number('meter_reading_day_end', null,['class'=>'form-control meterfields','id'=>'input_end','placeholder'=>'End of the day'])}}                       
                    </dl>

                </div>
            
            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 
    
                    <h4> <i class="fa fa-car"></i>&nbsp Meter Reading Mileage &nbsp (km) </h4>
                    
                    <input id="input_meter_reading_mileage" name="meter_reading_mileage" class="form-control" type="text" readonly />
            
                </div>                 
                    
            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 
    
                    <h4> <i class="fa fa-road"></i>&nbsp Journey Mileage &nbsp (km) </h4>
                    
                    <input id="input_journey_mileage" name="journey_mileage" class="form-control" type="text" readonly />
            
                </div>                 
                    
            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 
                    <button type="submit" class="btn btn-success pull-left"> <i class="glyphicon glyphicon-arrow-up"></i>&nbsp SUBMIT </button> &nbsp  
                    {{Form::reset('CLEAR', ['class'=>'btn btn-warning'])}}
                </div>  
                <div class="col-md-offset-10"> 
                    <a href="{{ url('/vehicle/mileage') }}" class="btn btn-info" role="button">Vehicle Fuel Usage</a>
                </div>  
            </div>
            {!! Form::close() !!} <br>

            <h3 id="table_header"style="text-align:center;display: none;"> </h3> 
            <div class="box box-primary" id="table_box" style="height:400px; overflow: auto; display: none;" data-target="#exampleModalCenter">
            
                <table id="table" class="table table-sm table-hover table-sm table-striped"> 

                    <thead class="table-dark">  
                        <tr > 
                            <th scope="col"> Date </th>
                            <th scope="col"> Meter Reading</th>
                            <th scope="col"> Details </th>
                            <th scope="col"> Cost (Rs.) </th>
                            <th scope="col"> Action</th>
                        </tr>
                    </thead>
                    <tbody id="servicing_info">

                    </tbody>
                </table>
            
            </div>
                    

        </div>  
    </div>

 
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#datepicker").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $('#input_out, #input_in').keyup(function(){

        var meter_begin = $('#input_begin').val();
        var meter_end = $('#input_end').val();
        var meter_reading_mileage= meter_end - meter_begin ;

        console.log(meter_reading_mileage);
        $('#input_meter_reading_mileage').val(meter_reading_mileage); 
        
        // input_journey_mileage

    });

</script>
    
@endsection