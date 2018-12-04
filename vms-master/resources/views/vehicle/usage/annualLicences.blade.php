@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE SERVICING')

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    
    <style> 
        label{margin-left: 20px;}
        #datepicker{width:300px; }
        #datepicker > span:hover{cursor: pointer;color: blue;} 

        #from_date{width:300px; }
        #from_date > span:hover{cursor: pointer;color: blue;}

        #to_date{width:300px; }
        #to_date > span:hover{cursor: pointer;color: blue;}

    </style>
@endsection

@section('header', 'Vehicle Annual Licences')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
  
    <div class="box box-primary">
    
        <div class="box-body"  >

            <div class="row"> 
                {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeServicing','files'=>true]) !!}
                <div class="col-md-5"> 

                    <h4><i class="fa fa-car"></i> Vehicle </h4>
    
                    <div style="width:300px">
                        
                        {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                        
                    </div>
                    
                </div>
            </div> <br>

            
                <div> 
                    <h4><i class="fas fa-tachometer-alt"></i> Period </h4> 
                </div>

                <div class="row">
                    
                    <div class="col-md-5"> 
                        <h4><i class=""></i> From </h4> 

                        <div id="from_date" class="input-group date" data-date-format="yyyy-mm-dd">
                            <input id="date" name="from" class="form-control" type="text" readonly />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>

                    <div class="col-md-5"> 
                        <h4><i class=""></i> To </h4> 

                        <div id="to_date" class="input-group date" data-date-format="yyyy-mm-dd">
                            <input id="date" name="to" class="form-control" type="text" readonly />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>

            <br>

            {{-- <div class="row">
                <div class="col-md-5"> 
                        <h4><i class="fas fa-tachometer-alt"></i> Licensing Authority </h4> 
                        {{Form::text('vehical_id',null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                </div>

            </div><br> --}}

            <div class="row">

                <div class="col-md-5"> 

                    <h4> <i class="fas fa-check-double"></i> Vehicle Licence Number </h4>  
    
                    <div style="width:300px">  
                        {{Form::number('licence_no', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Enter Licence Number'])}}                      
                    </div>                      
                </div> 

                <div class="col-md-5"> 

                    <h4> <i class="fas fa-calendar-alt"></i> &nbsp Licence Date </h4>
                                                        
                    <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="date" name="licence_date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                
                </div>

            </div><br>
            
            <div class="row"> 
                <div class="col-md-5"> 
                    <h4><i class="fa fa-money"></i> Amount </h4>  

                    <div style="width:300px">  
                        {{Form::number('amount', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Amount'])}}                      
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

            <div class="box box-primary" id="table_box" style="height:400px; overflow: auto;">
            
                <table id="table" class="table table-sm table-hover table-sm table-striped">
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
<script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>

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

    $("#from_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }).datepicker('update', new Date());

    $("#to_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }).datepicker('update', new Date());

    $('#datepicker').on('change',function () {
        var x = $("#datepicker").data('datepicker').getFormattedDate('yyyy-mm-dd');
        console.log(x);     
    }); 

    $('#to_date').on('change',function () {
        var x = $("#to_date").data('datepicker').getFormattedDate('yyyy-mm-dd');
        console.log(x);     
    }); 

    $('#from_date').on('change',function () {
        var x = $("#from_date").data('datepicker').getFormattedDate('yyyy-mm-dd');
        console.log(x);     
    }); 

    setTimeout(function() {
        $('#successMessage').fadeOut('slow');       
    }, 3000); 

</script>
    

@endsection