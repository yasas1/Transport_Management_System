@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE ACCIDENTS')

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> 
        /* label{margin-left: 20px;}
        #datepicker{ margin: 0 20px 20px 20px;} */
        #date > span:hover{cursor: pointer;color: blue;}
        #edit_sevdate > span:hover{cursor: pointer;color: blue;}
    </style>
@endsection

@section('header', 'Vehicle Accidents')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
    <div class="flash-message" id="flash-message" ></div>
  
    <div class="box box-primary">
    
        <div class="box-body">

            <div class="row"> 
                {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeAccidents','files'=>true]) !!}
                <div class="col-md-3"> 

                    <h4><i class="fas fa-car-crash"></i> Vehicles </h4>
                    <div>             
                        {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                    </div>                  
                </div>
                <div class="col-md-2"> </div>
    
                <div class="col-md-3"> 
    
                    <h4><i class="fa fa-calendar"></i> Date </h4>
                                                        
                    <div id="date" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="date" name="date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
            
                </div> 

            </div> <br>
            
            <div class="row"> 

                <div class="col-md-3"> 

                    <h4><i class="fas fa-map-marker-alt"></i> Place</h4>  
    
                    <div>  
                        {!! Form::text('place',null,['class'=>'form-control','placeholder'=>'Place' ]) !!}                      
                    </div>                      
                </div>   
            </div><br>

            <div class="row"> 

                <div class="col-md-3"> 

                    <h4><i class="fa fa-money"></i> Driver </h4>  
    
                    <div>  
                        {{Form::select('driver_id',$drivers,null,['class'=>'form-control ','placeholder'=>'Select Driver'])}}                     
                    </div>                      
                </div>

                <div class="col-md-2"> </div>

                <div class="col-md-4"> 

                    <h4><i class="fas fa-shield-alt"></i> Police Station where Entry Lodged </h4>  
    
                    <div>  
                        {!! Form::text('police_station',null,['class'=>'form-control','placeholder'=>'Police Station ','rows'=>'2'  ]) !!}                      
                    </div>                      
                </div> 

            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 

                    <h4><i class="fas fa-shield-alt"></i> Description of Damage</h4>  
    
                    <div>  
                        {!! Form::textarea('description_of_damage',null,['class'=>'form-control','placeholder'=>'Description','rows'=>'2'  ]) !!}                      
                    </div>                      
                </div> 

            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 
                    {{Form::submit('SUBMIT', ['class'=>'btn btn-success pull-left'])}} &nbsp
                    {{Form::reset('CLEAR', ['class'=>'btn btn-warning'])}}
                </div>  
            </div>
            {!! Form::close() !!} <br>

            <div class="box box-primary" id="table_box" style="height:400px; overflow: auto;" data-target="#exampleModalCenter">
            
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

    $("#date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    setTimeout(function() {
        $('#successMessage').fadeOut('slow');       
    }, 3000); 
    
</script>


    
@endsection