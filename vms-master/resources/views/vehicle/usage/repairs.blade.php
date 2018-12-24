@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE REPAIRS')

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> 
        #in_date > span:hover{cursor: pointer;color: blue;}
        #out_date > span:hover{cursor: pointer;color: blue;} 
        #invo_date > span:hover{cursor: pointer;color: blue;} 
        /* #edit_in_date > span:hover{cursor: pointer;color: blue;}
        #edit_out_date > span:hover{cursor: pointer;color: blue;}
        #edit_invo_date > span:hover{cursor: pointer;color: blue;}  */
    </style>
@endsection

@section('header', 'Vehicle Repairs')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
    <div class="flash-message" id="flash-message" ></div>
  
    <div class="box box-primary">
    
        <div class="box-body">

            <div class="row"> 
                {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeRepairs']) !!}

                <div class="col-md-4"> 

                    <h4> <i style="font-size:22px;" class="fa fa-car"></i>&nbsp Vehicle </h4>
                    <div>             
                        {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                    </div>                  
                </div>        

            </div> <br>
          
            <div class="row">
                
                <div class="col-md-4"> 

                    <h4><i class="far fa-calendar"></i>&nbsp Workshop In Date </h4>
                                                        
                    <div id="in_date" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input name="workshop_in_date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
            
                </div> 

                <div class="col-md-2"> </div>

                <div class="col-md-4"> 

                    <h4><i class="far fa-calendar"></i>&nbsp Workshop Out Date </h4>
                                                    
                    <div id="out_date" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input name="workshop_out_date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>                     
            </div>   
            </div><br>

            <div class="row">
                
                <div class="col-md-4"> 

                    <h4><i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading In  </h4>
                                                        
                    <div>  
                        {{Form::number('meter_reading_in', null,['class'=>'form-control ','placeholder'=>'Meter Reading In'])}}                     
                    </div>
            
                </div> 

                <div class="col-md-2"> </div>

                <div class="col-md-4"> 

                    <h4><i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading Out  </h4>
                                                    
                    <div>  
                        {{Form::number('meter_reading_out', null,['class'=>'form-control ','placeholder'=>'Meter Reading Out '])}}                     
                    </div>                   
            </div>   
            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 

                    <h4> <i class="fab fa-audible"></i> &nbsp Works And Parts Used </h4>  
    
                    <div>  
                        {!! Form::textarea('works_and_parts',null,['class'=>'form-control','placeholder'=>'Works And Parts Used','rows'=>'2' ]) !!}                     
                    </div>                      
                </div> 

            </div><br>

            <div class="row">
                
                <div class="col-md-4"> 

                    <h4> <i class="fas fa-calculator"></i> &nbsp Invoice No.</h4>
                                                        
                    <div>  
                        {{Form::number('invoice_no', null,['class'=>'form-control ','placeholder'=>'Invoice No.'])}}                     
                    </div>
            
                </div> 

                <div class="col-md-2"> </div>

                <div class="col-md-4"> 

                    <h4> <i class="far fa-calendar"></i> &nbsp Invoice Date </h4>
                                                    
                    <div id="invo_date" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input name="invoice_date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>                     
                </div>   
            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 

                    <h4> <i class="fas fa-comments-dollar"></i> &nbsp Cost  </h4>  
    
                    <div>  
                        {{Form::number('cost', null,['class'=>'form-control ','placeholder'=>'Cost'])}}                     
                    </div>                      
                </div> 
        
            </div><br>

            <div class="row">
                
                <div class="col-md-4"> 

                    <h4> <i class="fas fa-user-shield"></i> &nbsp Authorized by  </h4> 
                                                        
                    <div>  
                        {!! Form::text('authorized_by',null,['class'=>'form-control','placeholder'=>'Authorized by' ]) !!}                    
                    </div>
            
                </div>
                
                <div class="col-md-2"> </div>

                <div class="col-md-4"> 

                    <h4> <i class="fas fa-place-of-worship"></i> &nbsp Executed at (workshop)  </h4> 
                                                        
                    <div>  
                        {!! Form::text('executed_at',null,['class'=>'form-control','placeholder'=>'Executed at ' ]) !!}                    
                    </div>
                
                </div>
 
            </div><br>


            <div class="row"> 

                <div class="col-md-4"> 
                    {{Form::submit('SUBMIT', ['class'=>'btn btn-success pull-left'])}} &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                    {{Form::reset('CLEAR', ['class'=>'btn btn-warning'])}}
                </div>  
            </div>
            {!! Form::close() !!} <br>

            <div class="box box-primary" id="table_box" style="height:400px; overflow: auto;" data-target="#exampleModalCenter">
            
                <table id="table" class="table table-sm table-hover table-sm table-striped"> 

                    <thead class="table-dark">  
                        <tr > 
                            <th scope="col"> In Date </th>
                            <th scope="col"> Out Date </th>
                            <th scope="col"> Authorized by </th>
                            <th scope="col"> Executed at (workshop) </th>
                            <th scope="col"> Cost </th>
                            <th scope="col"> Action</th>
                        </tr>
                    </thead>
                    <tbody id="repair_info">

                    </tbody>
                </table>
            
            </div>

        </div>  
    </div>
  
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script>

    function readRepairs(vid){     
        $.ajax({
            url: '/vehicle/readVehicleRepairs/{id}',
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {
                //console.log(data);   
                $('#repair_info').empty().html(data);
                          
            }
        });
    }

    $('#vid').on('change',function () {
        var vid = $(this).val(); // get vehicle id
     
        readRepairs(vid);
    }); 

</script>

<script>
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#in_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }); 
    $("#out_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }); 
    $("#invo_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });   
 
    
</script>
    
@endsection