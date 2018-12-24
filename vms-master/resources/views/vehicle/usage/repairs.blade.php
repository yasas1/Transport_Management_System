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

            {{---------   View modal  ----------}}
    <div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <i style="font-size:25px; color:gray" class="fa fa-car"></i>&nbsp  <label class="modal-title" id="view-title" style="font-size:25px; color:gray;"> </label> 

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4 class="modal-title" > <i class="fas fa-tachometer-alt"></i>&nbsp Licence Period</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="col-md-offset-3">
                                
                                <label style="font-size:15px" >From: &nbsp</label>
                                <label style="font-size:15px" id="period-from"> </label>
                                
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="col-md-offset-3">
                                
                                <label style="font-size:16px">To: &nbsp</label>
                                <label style="font-size:16px" id="period-to"> </label>
                                
                            </dl>
                        </div>
                    </div><br>
                    <h4 class="modal-title" > <i class="glyphicon glyphicon-list-alt"></i>&nbsp Licensing Authority</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="col-md-offset-3">
                                <p style="font-size:16px" id="licensing_authority"> </p>                        
                            </dl>
                        </div>
                    
                    </div><br>

                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-check-double"></i>&nbsp Licence Number</h4>
                                
                            <p style="font-size:16px" class="col-md-offset-3" id="licence_no"> </p>                            
                            
                        </div>
                        <div class="col-md-6">
                            <h4 class="modal-title"> <i class="fas fa-calendar-alt"></i>&nbsp Licence Date</h4>
                                
                            <p style="font-size:16px" class="col-md-offset-3" id="licence_date"> </p>                       
                        </div>
                    </div><br>

                    <h4 class="modal-title" > <i class="fa fa-money"></i>&nbsp Amount</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="col-md-offset-3">
                            <b> Rs. </b><label style="font-size:16px" id="amount"> <label>                        
                            </dl>
                        </div>
                    
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-award"></i>&nbsp Emission Test Details</h4>
                            <dl class="col-md-offset-3">
                            <p style="font-size:16px" id="view_emission_test_details"> <p>                        
                            </dl>
                        </div>
                        <div id="document_view" class="col-md-6">
                            <h4 class="modal-title" > <i class="glyphicon glyphicon-download-alt"></i>&nbsp Annual Licence Document</h4>
                            <a class="col-md-offset-3" href="" download="" id ="document_download"> 
                                <button type="button" class="btn btn-success btn-md">
                                    <i class="glyphicon glyphicon-download-alt"></i>&nbsp <i id="doc_name"></i>
                                </button>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary active" data-dismiss="modal">Close</button>
                </div>
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

    /* one Repair row view click event */
    $(document).on('click','#view',function(e){
        var id = $(this).data('id'); //get annual licence id

        $.ajax({
            url: '/vehicle/viewRepair/{id}',
            type: 'GET',
            data: { id: id },
            success: function(data)
            {
                    /* set values to html tag for view */  
                console.log(data);
                $('#view-title').html(data[0].vehicle_name+" ("+data[0].vehicle_reg+") "+"Annual Licence" );
                // $('#period-from').html(data[0].from );
                // $('#period-to').html(data[0].to ); 
                // $('#licensing_authority').html(data[0].licensing_authority );  
                // $('#licence_no').html(data[0].licence_no);
                // $('#licence_date').html(data[0].licence_date);
                // $('#amount').html(data[0].amount); 
                // $('#view_emission_test_details').html(data[0].emission_test_details);

            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            }
        });
            //show view modal
        $("#view-modal").modal('show');

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