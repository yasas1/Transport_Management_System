@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE FUEL USAGE')

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> 
        #datepicker > span:hover{cursor: pointer;color: blue;}
        #edit_date > span:hover{cursor: pointer;color: blue;}
    </style>
@endsection

@section('header', 'Filling Fuel')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
    <div class="flash-message" id="flash-message" ></div>
  
    <div class="box box-primary">
    
        <div class="box-body">

            <div class="row"> 
                {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeFuelUsage']) !!}
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
    
                    <h4><i class="fa fa-calendar"></i> Date of Filling </h4>
                                                        
                    <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="input_date" name="date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
            
                </div>                 
                
            </div><br>

            <h4> <i class="fas fa-gas-pump"></i>&nbsp Fuel Position</h4> 
            
            <div  class="row">

                <div class="col-md-1"> </div>

                <div class="col-md-4">
            
                    <h4> <i class="fas fa-tachometer-alt"></i> &nbsp Meter Reading</h4>
                    <dl>
                        {{Form::number('meter_reading', null,['class'=>'form-control','step'=>'0.01','id'=>'input_meter_reading','placeholder'=>'Meter Reading'])}}                       
                    </dl>

                </div>

            
            </div> 

            <div class="row"> 

                <div class="col-md-1"> </div>

                <div class="col-md-4"> 
    
                    <h4> <i class="fas fa-fill-drip"></i> &nbsp Fuel Quantity &nbsp(Liter)</h4> 
                    <div>
                        {{Form::number('fuel_liter', null,['class'=>'form-control','step'=>'0.01','placeholder'=>'Drawn Liter'])}}                       
                    </div>
            
                </div>                 
                
            </div><br>

            <div class="row">
                
                <div class="col-md-1"> </div>

                <div class="col-md-4"> 
                    <h4> <i class="fas fa-comments-dollar"></i> &nbsp Cost</h4>
                    <dl>
                        {{Form::number('cost', null,['class'=>'form-control','step'=>'0.01','placeholder'=>'cost'])}}                       
                    </dl>
                </div> 
                
            </div><br> 
            
            <div class="row"> 

                <div class="col-md-4"> 
                    <button type="submit" id="input_submit" class="btn btn-success pull-left"> <i class="glyphicon glyphicon-arrow-up"></i>&nbsp SUBMIT </button> &nbsp  
                    {{Form::reset('CLEAR', ['class'=>'btn btn-warning','id'=>'clear'])}}
                </div>  

                <div class="col-md-offset-10"> 
                    <a href="{{ url('/vehicle/mileage') }}" class="btn btn-info" role="button">Vehicle Mileage</a>
                </div>  
            </div>
            {!! Form::close() !!}

            <br>

            <h3 id="table_header"style="text-align:center;display: none;"> </h3> 
            <div class="box box-primary" id="table_box" style="height:400px; overflow: auto; display: none;" data-target="#exampleModalCenter">
            
                <table id="table" class="table table-sm table-hover table-sm table-striped"> 

                    <thead class="table-dark">  
                        <tr > 
                            <th scope="col"> Date </th>
                            <th scope="col"> Meter Reading</th>
                            <th scope="col"> Fuel Liter </th>
                            <th scope="col"> Cost (Rs.) </th>
                            <th scope="col"> Action</th>
                        </tr>
                    </thead>
                    <tbody id="fuelUsage_info">

                    </tbody>
                </table>
            
            </div>
                    
        </div>  
    </div>

    {{----------------------  Edit modal  -------------------}}
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="edit-title"></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    
                    <div class="modal-body">
    
                        <form action="{{ URL::to('/vehicle/fuelUsage/update')}}" method="POST" id="edit_mileage" enctype="multipart/form-data">
                            {{csrf_field()}}
                        <input type="hidden" name="id" id="fuelUsage_id">            
        
                        <div class="row"> 
    
                            <div class="col-md-6"> 
                
                                <h4><i class="fa fa-calendar"></i> Date of Filling</h4>
                                                                    
                                <div id="edit_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                    <input id="edit_mdate" name="date" class="form-control" type="text" readonly />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                        
                            </div>                 
                            
                        </div><br>
                    
                        <h4> <i class="fas fa-gas-pump"></i>&nbsp Fuel Position</h4> 
            
            <div  class="row">

                <div class="col-md-1"> </div>

                <div class="col-md-4">
            
                    <h4> <i class="fas fa-tachometer-alt"></i> &nbsp Meter Reading</h4>
                    <dl>
                        {{Form::number('meter_reading', null,['class'=>'form-control','step'=>'0.01','id'=>'input_meter_reading','placeholder'=>'Meter Reading'])}}                       
                    </dl>

                </div>

            
            </div> 

            <div class="row"> 

                <div class="col-md-1"> </div>

                <div class="col-md-4"> 
    
                    <h4> <i class="fas fa-fill-drip"></i> &nbsp Fuel Quantity &nbsp(Liter)</h4> 
                    <div>
                        {{Form::number('fuel_liter', null,['class'=>'form-control','step'=>'0.01','placeholder'=>'Drawn Liter'])}}                       
                    </div>
            
                </div>                 
                
            </div><br>

            <div class="row">
                
                <div class="col-md-1"> </div>

                <div class="col-md-4"> 
                    <h4> <i class="fas fa-comments-dollar"></i> &nbsp Cost</h4>
                    <dl>
                        {{Form::number('cost', null,['class'=>'form-control','step'=>'0.01','placeholder'=>'cost'])}}                       
                    </dl>
                </div> 
                
            </div><br> 
                                            
                    </div>
    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success active" id="update">Update</button>
                        {!! Form::close() !!} 
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="close_edit" >Close</button>
                    </div>
                </div>
            </div>
        </div>

 
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script>

    function readFuelUsages(vid){ 
        $.ajax({
            url: "{{ URL::to('/vehicle/readVehicleFule/{id}') }}",
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {
                //console.log(data);   
                $('#fuelUsage_info').empty().html(data);            
            }
        });
    }

    $('#vid').on('change',function () {
        var vid = $(this).val(); // get vehicle id
        var vehicle = $( "#vid option:selected" ).text();
        
        $('#table_header').html('<i class="fas fa-car"></i>'+' '+vehicle+" Vehicle Fuel Usage History");
        $('#table_header').show();
        
        readFuelUsages(vid);
        $('#table_box').show();
    }); 

    $(document).on('click','#edit',function(e){
        var id = $(this).data('id');
        var vid;

        $('#fuelUsage_id').val(id);

           /* getting existing data to modal */
        $.ajax({
            url: "{{ URL::to('/vehicle/viewFuelUsage/{id}') }}",
            type: 'GET',
            data: { id: id },
            success: function(data)
            {    
                vid =data[0].vehical_id;

                $('#edit-title').html('<i class="fas fa-car"></i>'+' '+data[0].vehicle_name+" ( "+data[0].vehicle_reg+" ) "+" Vehicle Mileage Editing" ); 
                // $('#edit_mdate').val(data[0].date);
                // $('#edit_meter_reading_day_begin').val(data[0].meter_reading_day_begin);    
                // $('#edit_meter_reading_day_end').val(data[0].meter_reading_day_end);
                // $('#edit_meter_reading_mileage').val(data[0].meter_reading_mileage);
                // $('#edit_journey_mileage').val(data[0].journey_mileage);
                // $('#edit_remarks').val(data[0].remarks); 
   
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
            }
        });

        $("#edit-modal").modal('show');

        $('#edit_mileage').on('submit',function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(data)
                {               
                    $('#edit-modal').modal('hide');  
                    $('#flash-message').html(data);
                        /* refresh data table in the view */
                    readMileages(vid);      
                },
                error: function(xhr, textStatus, error){
                    console.log(xhr.statusText);
                }
            });     
        });

    });
    

</script>
<script>

    $("#datepicker").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true,
       
    }); 

    $("#edit_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

</script>

@endsection