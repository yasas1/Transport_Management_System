@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE SERVICING')

@section('styles')
    {{-- <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet"> --}}
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    
    <style> 
        label{margin-left: 20px;}
        #datepicker{width:300px; margin: 0 20px 20px 20px;}
        #datepicker > span:hover{cursor: pointer;color: blue;}
    </style>
@endsection

@section('header', 'Vehicle Servicing')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
  
    <div class="box box-primary">
    
        <div class="box-body" style="height:560px" >

            <div class="row"> 
                {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeServicing','files'=>true]) !!}
                <div class="col-md-5"> 

                    <h4><i class="fa fa-car"></i> Vehicle </h4>
    
                    <div style="width:300px">
                        
                        {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                        
                    </div>
                    
                </div>
    
                <div class="col-md-5"> 
    
                    <h4><i class="fa fa-calendar"></i> Date </h4>
                                                        
                    <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="date" name="date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
            
                </div>

            </div> 
            
            <div class="row"> 

                <div class="col-md-5"> 

                    <h4><i class="fas fa-tachometer-alt"></i> Meter Reading </h4>  
    
                    <div style="width:300px">  
                        {{Form::number('meter_reading', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Enter Meter Reading'])}}                      
                    </div>                      
                </div>   
            </div><br>

            <div class="row"> 

                <div class="col-md-5"> 
                    {{Form::submit('SUBMIT', ['class'=>'btn btn-success pull-left'])}} &nbsp
                    {{Form::reset('CLEAR', ['class'=>'btn btn-warning'])}}
                </div>  
            </div>
            {!! Form::close() !!} <br>

            <div class="col-md-offset-1"> 
                <table class="table table-sm table-hover table-sm table-striped">
                    <thead class="table-dark">  
                        <tr > 
                            <th scope="col"> Vehicle </th>
                            <th scope="col"> Date </th>
                            <th scope="col"> Meter Reading</th>
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
                $('#servicing_info').empty();            
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
    }).datepicker('update', new Date());

    $('.date').on('change',function () {
        var x = $("#datepicker").data('datepicker').getFormattedDate('yyyy-mm-dd');
        console.log(x);     
    });  

   
    

</script>

    

@endsection