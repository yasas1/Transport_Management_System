@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE SERVICING')

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    
    <style> 
        /* label{margin-left: 20px;}
        #datepicker{ margin: 0 20px 20px 20px;} */
        #datepicker > span:hover{cursor: pointer;color: blue;}
    </style>
@endsection

@section('header', 'Vehicle Servicing')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
  
    <div class="box box-primary">
    
        <div class="box-body">

            <div class="row"> 
                {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeServicing','files'=>true]) !!}
                <div class="col-md-3"> 

                    <h4><i class="fa fa-car"></i> Vehicle </h4>
                    <div>             
                        {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                    </div>                  
                </div>
                <div class="col-md-2"> </div>
    
                <div class="col-md-3"> 
    
                    <h4><i class="fa fa-calendar"></i> Date </h4>
                                                        
                    <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="date" name="date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
            
                </div> 

            </div> <br>
            
            <div class="row"> 

                <div class="col-md-3"> 

                    <h4><i class="fas fa-tachometer-alt"></i> Meter Reading </h4>  
    
                    <div>  
                        {{Form::number('meter_reading', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Enter Meter Reading'])}}                      
                    </div>                      
                </div>   
            </div><br>

            <div class="row"> 

                <div class="col-md-3"> 

                    <h4><i class="fas fa-tachometer-alt"></i> Cost </h4>  
    
                    <div>  
                        {{Form::number('cost', null,['class'=>'form-control ','placeholder'=>'Cost of Service'])}}                      
                    </div>                      
                </div>

                <div class="col-md-2"> </div>

                <div class="col-md-4"> 

                    <h4><i class="fas fa-tachometer-alt"></i> Deatils </h4>  
    
                    <div>  
                        {!! Form::textarea('details',null,['class'=>'form-control','placeholder'=>'Service Details','rows'=>'2'  ]) !!}                      
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

    $('#vid').on('change',function () {
        var vid = $(this).val();
        console.log(vid);

        $.ajax({
            url: '/vehicle/readServicing/{id}',
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {
                console.log(data);   
                //$('#servicing_info').empty();            
                $(data).each(function (i,value) {                
                    //servicing_info 
                    var tr = $("<tr/>");
                    tr.append($("<td/>",{
                        text :value.vehicle_name+" ("+value.vehicle_reg+")"
                    })).append($("<td/>",{
                        text :value.date
                    })).append($("<td/>",{
                        text :value.meter_reading
                    }))
                    $('#servicing_info').append(tr);              
                }); 
               
            }
        });

    });
 
    $("#datepicker").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $('.date').on('change',function () {
        var x = $("#datepicker").data('datepicker').getFormattedDate('yyyy-mm-dd');
        console.log(x);     
    }); 

    setTimeout(function() {
        $('#successMessage').fadeOut('slow');       
    }, 3000); 

</script>
    

@endsection