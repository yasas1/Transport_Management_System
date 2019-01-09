@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE SERVICING')

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> 
        /* label{margin-left: 20px;}
        #datepicker{ margin: 0 20px 20px 20px;} */
        #datepicker > span:hover{cursor: pointer;color: blue;}
        #edit_sevdate > span:hover{cursor: pointer;color: blue;}
    </style>
@endsection

@section('header', 'Vehicle Servicing')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
    <div class="flash-message" id="flash-message" ></div>

    <div>   
        @foreach ($vehiclesNoti as $vehicle)

            <div id="dis_noti{{$vehicle->id}}" style="display:none" class="alert alert-warning alert-dismissible fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <table>                   
                    <tr>
                      <th>{{$vehicle->registration_no}} &nbsp  <th>
                      <td id="service_noti{{$vehicle->id}}"></td>
                    </tr>              
                </table>
            </div>
        @endforeach
    </div>
  
    <div class="box box-primary">
    
        <div class="box-body">

            <div class="row"> 
                {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeServicing','files'=>true]) !!}
                <div class="col-md-4"> 

                    <h4><i class="fa fa-car"></i>&nbsp  Vehicle </h4>
                    <div>             
                        {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                    </div>                  
                </div>
                <div class="col-md-2"> </div>
    
                

            </div> <br>

            <div class="row"> 

                <div class="col-md-4"> 
    
                    <h4><i class="fa fa-calendar"></i>&nbsp  Date of Service</h4>
                                                        
                    <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="date" name="date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
            
                </div>                 
                
            </div><br>
            
            <div class="row"> 

                <div class="col-md-4"> 

                    <h4><i class="fas fa-tachometer-alt"></i>&nbsp  Meter Reading </h4>  
    
                    <div>  
                        {{Form::number('meter_reading', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Enter Meter Reading'])}}                      
                    </div>                      
                </div>   
            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 

                    <h4><i class="fas fa-comments-dollar"></i>&nbsp  Cost </h4>  
    
                    <div>  
                        {{Form::number('cost', null,['class'=>'form-control ','placeholder'=>'Cost of Service'])}}                      
                    </div>                      
                </div>

                <div class="col-md-2"> </div>

                <div class="col-md-4"> 

                    <h4><i class="glyphicon glyphicon-list-alt"></i>&nbsp  Details </h4>  
    
                    <div>  
                        {!! Form::textarea('details',null,['class'=>'form-control','placeholder'=>'Service Details','rows'=>'2'  ]) !!}                      
                    </div>                      
                </div> 

            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 
                    <button type="submit" class="btn btn-success pull-left"> <i class="glyphicon glyphicon-arrow-up"></i>&nbsp SUBMIT </button> &nbsp  
                    {{Form::reset('CLEAR', ['class'=>'btn btn-warning'])}}
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

        {{-- Edit modal --}}
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

                    <form action="{{ URL::to('/vehicle/service/update')}}" method="POST" id="edit_service">
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="service_id">
                                           
                    <h4><i class="fa fa-calendar"></i>&nbsp Date </h4> 
                    
                    <div class="row">
                        
                        <div class="col-md-6"> 
                            <div id="edit_sevdate" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="edit_date" name="date" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                          
                    </div>
                    <br>
        
                    <div class="row">
        
                        <div class="col-md-6"> 
        
                            <h4> <i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading </h4>  
            
                            <div>  
                                {{Form::number('meter_reading', null,['class'=>'form-control ','id'=>'edit_meter_reading','placeholder'=>'Enter Licence Number'])}}                      
                            </div>                      
                        </div> 
        
                    </div><br>
                    
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <h4><i class="fa fa-money"></i>&nbsp Cost </h4>  
        
                            <div>  
                                {{Form::number('cost', null,['class'=>'form-control ','id'=>'edit_cost','placeholder'=>'Amount'])}}                      
                            </div> 
                        </div>
                            
                    </div><br>
                    
                    <div class="row">
                        <div class="col-md-6"> 
                            <h4> <i class="fas fa-award"></i>&nbsp Emission Test Details </h4>  
                            <div >  
                                {!! Form::text('details',null,['class'=>'form-control','id'=>'edit_details' ]) !!}
                            </div> 
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

        {{-- Delete Confirmation modal --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <b> <h3 class="modal-title" id="delete-title"></h3> </b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="modal-title" >Please Confirm Your Delete Action</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="delete-confirm">Delete</button>
                <button type="button" class="btn btn-primary active" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
    </div>

    {{-- View modal --}}
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

                <h4 class="modal-title" > <i class="fa fa-calendar"></i>&nbsp Service Date</h4>
                <div class="row">
                    <div class="col-md-6">
                        <dl class="col-md-offset-3">
                            
                            <label style="font-size:15px" id="view_date"> </label>
                            
                        </dl>
                    </div>
                    
                </div><br>
                <h4 class="modal-title" > <i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading</h4>
                <div class="row">
                    <div class="col-md-6">
                        <dl class="col-md-offset-3">
                            <p style="font-size:16px" id="view_meter"> </p>                        
                        </dl>
                    </div>
                   
                </div><br>

                <h4 class="modal-title" > <i class="fa fa-money"></i>&nbsp Cost</h4>
                <div class="row">
                    <div class="col-md-6">
                        <dl class="col-md-offset-3">
                           <b> Rs. </b><label style="font-size:16px" id="view_cost"> <label>                        
                        </dl>
                    </div>
                   
                </div>
            
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="modal-title" > <i class="fas fa-award"></i>&nbsp Service Details</h4>
                        <dl class="col-md-offset-3">
                           <p style="font-size:16px" id="view_details"> <p>                        
                        </dl>
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

    $("#edit_sevdate").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    setTimeout(function() {
        $('#successMessage').fadeOut('slow');       
    }, 3000); 
    
</script>

<script>

    function readServicing(vid){ 
        
        $.ajax({
            url: '/vehicle/readServicing/{id}',
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {
                //console.log(data);   
                $('#servicing_info').empty().html(data);           
               
            }
        });
    }

    $('#vid').on('change',function () {
        var vid = $(this).val();
        var vehicle = $( "#vid option:selected" ).text();
        
        $('#table_header').html('<i class="fa fa-car"></i>'+' '+vehicle+" Vehicle Servicing History");
        $('#table_header').show();

        readServicing(vid); 
        $('#table_box').show();    

    });

        /* one service edit click event */
    $(document).on('click','#edit',function(e){
        var id = $(this).data('id');
        var vid;
        $('#service_id').val(id);

           /* getting existing data to modal */
        $.ajax({
            url: "{{ URL::to('/vehicle/viewService/{id}') }}",
            type: 'GET',
            data: { id: id },
            success: function(data)
            {    
                vid =data[0].vehical_id;

                $('#edit-title').html('<i class="fa fa-car"></i>'+' '+data[0].vehicle_name+" ( "+data[0].vehicle_reg+" ) "+" Vehicle Servicing Editing" ); 
                $('#edit_date').val(data[0].date);
                $('#edit_meter_reading').val(data[0].meter_reading);
                $('#edit_details').val(data[0].details);
                $('#edit_cost').val(data[0].cost);
   
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
            }
        });

        $("#edit-modal").modal('show');

        $('#edit_service').on('submit',function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,//new FormData(this),
                success: function(data)
                {             
                    $('#edit-modal').modal('hide');  
                    $('#flash-message').html(data);
                        /* refresh data table in the view */
                    readServicing(vid);      
                },
                error: function(xhr, textStatus, error){
                    console.log(xhr.statusText);
                }
            });     
        });

    });

        /* one service click view event */
    $(document).on('click','#view',function(e){
        var id = $(this).data('id'); //get annual licence id

        $.ajax({
            url: "{{ URL::to('/vehicle/viewService/{id}') }}" ,
            type: 'GET',
            data: { id: id },
            success: function(data)
            {
                    /* set values to html tag for view */  
                $('#view-title').html(data[0].vehicle_name+" ("+data[0].vehicle_reg+") "+" Vehicle Service" );
                $('#view_date').html(data[0].date );
                $('#view_meter').html(data[0].meter_reading ); 
                $('#view_cost').html(data[0].cost );  
                $('#view_details').html(data[0].details);
                

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

        /* one service delete click event */
    $(document).on('click','#delete',function(e){
        var id = $(this).data('id');

        var vehicle = $( "#vid option:selected" ).text();

        $('#delete-title').html('<i class="fa fa-car"></i>'+' '+vehicle +" Vehicle Service Deleting" );

        $("#delete-modal").modal('show'); 
    
        $("#delete-confirm").on("click", function(){

            $.ajax({
                url:"{{ route('service.delete')}}",
                method: "POST",
                data: { id: id },
                success: function(data)
                {
                    $('#flash-message').html(data); 
    
                    $('tr#'+id).remove();
                    $('#delete-modal').modal('hide');
                },
                error: function(xhr, textStatus, error){
                    console.log(error);
                }
            });

        });
 
    });
</script>

<script>

    $(document).ready(function() {

        var services={};

        $.ajax({
            url: "{{ URL::to('/vehicle/serivceNotification') }}",
            type: 'GET',
            success: function(data)
            {   
                services =data;
                console.log(services);

                $.each( services, function( i, value ) {
                    // console.log(value.date);

                    $.ajax({
                        url: "{{ URL::to('/vehicle/distanceCount') }}" ,
                        type: 'GET',
                        data: { vid: value.vehical_id, date: value.date },
                        success: function(data)
                        {
                            console.log(value.vehical_id);
                            console.log(value.date);
                            console.log(data);  
                            console.log(value.mileage_service);
                            if(data >= value.mileage_service){
                               
                                $('#service_noti'+value.vehical_id).html("Vehicle has used more than "+ data + " km since last servicing");
                                $('#dis_noti'+value.vehical_id).show();

                            }  
                            else{
                                $('#dis_noti'+value.vehical_id).hide();
                            }       

                        },
                        error: function(xhr, textStatus, error){
                            console.log(error);
                        }
                    });

                });
            
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            }
        });        

    });


</script>
    
@endsection