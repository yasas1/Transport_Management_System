@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE MILEAGE')

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> 
        #datepicker > span:hover{cursor: pointer;color: blue;}
        #edit_date > span:hover{cursor: pointer;color: blue;}
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
            @if(Auth::user()->canCreateVehicleMileage())
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

                <div class="col-md-1"> </div>

                <div class="col-md-4">
              
                    <h4> <i class="glyphicon glyphicon-log-out"></i> &nbsp Begin Of The Day</h4>
                    <dl>
                        {{Form::number('meter_reading_day_begin', null,['class'=>'form-control meterfields','id'=>'input_begin','placeholder'=>'Begin of the day'])}}                       
                    </dl>

                </div>

                <div class="col-md-1"> </div>

                <div class="col-md-4">

                    <h4> <i class="glyphicon glyphicon-log-in"></i> &nbsp End of The Day</h4>
                    <dl>
                        {{Form::number('meter_reading_day_end', null,['class'=>'form-control meterfields','id'=>'input_end','placeholder'=>'End of the day'])}}                       
                    </dl>

                </div>
            
            </div><br>

            <div class="row"> 

                <div class="col-md-1"> </div>

                <div class="col-md-4"> 
    
                    <h4> <i class="fa fa-car"></i>&nbsp Mileage From Meter Reading &nbsp (km) </h4>
                    
                    <input id="input_meter_reading_mileage" name="meter_reading_mileage" class="form-control" type="text" readonly />
            
                </div>  

                <div class="col-md-1"> </div>
                
                <div class="col-md-4"> 
    
                    <h4> <i class="fa fa-road"></i>&nbsp Mileage From Journey &nbsp (km) </h4>
                    
                    <input id="input_journey_mileage" name="journey_mileage" class="form-control" type="text" readonly /> <!-- readonly -->
            
                </div>  
                    
            </div><br>

            <div class="row"> 
    
                <div class="col-md-6"> 

                    <h4> <i class="fas fa-align-justify"></i> &nbsp Remarks </h4>  
    
                    <div>  
                        {!! Form::textarea('remarks',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2'  ]) !!}                      
                    </div>                      
                </div>  

            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 
                    <button type="submit" class="btn btn-success pull-left"> <i class="glyphicon glyphicon-arrow-up"></i>&nbsp SUBMIT </button> &nbsp  
                    {{Form::reset('CLEAR', ['class'=>'btn btn-warning'])}}
                </div>  
                <div class="col-md-offset-10"> 
                    <a href="{{ url('/vehicle/fuelUsage') }}" class="btn btn-info" role="button">Filling Fuel</a>
                </div>  
            </div>
            {!! Form::close() !!} <br>
            @endif
            <h3 id="table_header" style="text-align:center;display: none;"> </h3> 
            <div class="box box-primary" id="table_box" style="height:400px; overflow: auto; display: none;" data-target="#exampleModalCenter">
            
                <table id="table" class="table table-sm table-hover table-sm table-striped"> 

                    <thead class="table-dark">  
                        <tr > 
                            <th scope="col"> Date </th>
                            <th scope="col"> Meter Reading Begin Of The Day (km)</th>
                            <th scope="col">  Meter Reading End of The Dayy (km) </th>
                            <th scope="col"> Mileage From Meter Reading (km)</th>
                            <th scope="col">  Mileage From Journey (km) </th>
                            <th scope="col"> Remarks </th>
                            <th scope="col"> Action</th>
                        </tr>
                    </thead>
                    <tbody id="mileage_info">

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

                    <form action="{{ URL::to('/vehicle/mileage/update')}}" method="POST" id="edit_mileage" enctype="multipart/form-data">
                        {{csrf_field()}}
                    <input type="hidden" name="id" id="mileage_id">            
    
                    <div class="row"> 

                        <div class="col-md-6"> 
            
                            <h4><i class="fa fa-calendar"></i> Date </h4>
                                                                
                            <div id="edit_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="edit_mdate" name="date" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                    
                        </div>                 
                        
                    </div><br>
                
                    <h4 class="modal-title" > <i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading &nbsp (km)</h4>
                    <div class="row">
        
                        <div class="col-md-1"> </div>
        
                        <div class="col-md-5">
                      
                            <h4> <i class="glyphicon glyphicon-log-out"></i> &nbsp Begin Of The Day</h4>
                            <dl>
                                {{Form::number('meter_reading_day_begin', null,['class'=>'form-control meterfields','id'=>'edit_meter_reading_day_begin','placeholder'=>'Begin of the day'])}}                       
                            </dl>
        
                        </div>
        
                        <div class="col-md-5">
        
                            <h4> <i class="glyphicon glyphicon-log-in"></i> &nbsp End of The Day</h4>
                            <dl>
                                {{Form::number('meter_reading_day_end', null,['class'=>'form-control meterfields','id'=>'edit_meter_reading_day_end','placeholder'=>'End of the day'])}}                       
                            </dl>
        
                        </div>
                    
                    </div><br>
        
                    <div class="row"> 
        
                        <div class="col-md-1"> </div>
        
                        <div class="col-md-4"> 
            
                            <h4> <i class="fa fa-car"></i>&nbsp Mileage From Meter Reading &nbsp (km) </h4>
                            
                            <input id="edit_meter_reading_mileage" name="meter_reading_mileage" class="form-control" type="text" readonly />
                    
                        </div>  
        
                        <div class="col-md-1"> </div>
                        
                        <div class="col-md-4"> 
            
                            <h4> <i class="fa fa-road"></i>&nbsp Mileage From Journey &nbsp (km) </h4>
                            
                            <input id="edit_journey_mileage" name="journey_mileage" class="form-control" type="text" readonly /> <!-- readonly -->
                    
                        </div>  
                            
                    </div><br>
        
                    <div class="row"> 
            
                        <div class="col-md-6"> 
        
                            <h4> <i class="fas fa-align-justify"></i> &nbsp Remarks </h4>  
            
                            <div>  
                                {!! Form::textarea('remarks',null,['class'=>'form-control','id'=>'edit_remarks','rows'=>'2'  ]) !!}                      
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

            {{------------- Delete Confirmation modal -------------------}}
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
                <button type="button" class="btn btn-danger" id="btn-confirm">Delete</button>
                <button type="button" class="btn btn-primary active" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
    </div>
 
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script> 

    function readMileages(vid){ 
        $.ajax({
            url: "{{ URL::to('/vehicle/readVehicleMileage/{id}') }}",
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {
                //console.log(data);   
                $('#mileage_info').empty().html(data);            
            }
        });
    }

    $('#vid').on('change',function () {
        var vid = $(this).val(); // get vehicle id
        var vehicle = $( "#vid option:selected" ).text();
        
        $('#table_header').html('<i class="fas fa-car"></i>'+' '+vehicle+" Vehicle Mileage History");
        $('#table_header').show();
        
        readMileages(vid);
        $('#table_box').show();
    }); 

    $(document).on('click','#edit',function(e){
        var id = $(this).data('id');
        var vid;

        $('#mileage_id').val(id);

           /* getting existing data to modal */
        $.ajax({
            url: "{{ URL::to('/vehicle/viewMileage/{id}') }}",
            type: 'GET',
            data: { id: id },
            success: function(data)
            {    
                vid =data[0].vehical_id;

                $('#edit-title').html('<i class="fas fa-car"></i>'+' '+data[0].vehicle_name+" ( "+data[0].vehicle_reg+" ) "+" Vehicle Mileage Editing" ); 
                $('#edit_mdate').val(data[0].date);
                $('#edit_meter_reading_day_begin').val(data[0].meter_reading_day_begin);    
                $('#edit_meter_reading_day_end').val(data[0].meter_reading_day_end);
                $('#edit_meter_reading_mileage').val(data[0].meter_reading_mileage);
                $('#edit_journey_mileage').val(data[0].journey_mileage);
                $('#edit_remarks').val(data[0].remarks); 
   
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

    $('#vehical_id').add('#date').on('change',function(){

        var vid = $('#vid').val();
        var date = $('#date').val();
        
        console.log(vid);

        $.ajax({
            url: "{{ URL::to('/vehicle/distanceCount') }}",
            type: 'GET',
            data: {vid: vid, date: date},
            success: function(data)
            {
                    /* set values to html tag for view */  
                console.log(data);
                $('#input_journey_mileage').val(data);
   
            },
            error: function(xhr, textStatus, error){
                console.log(error);
            }
        });
        
    });

    $(document).on('click','#delete',function(e){
        var id = $(this).data('id');

        var vehicle = $( "#vid option:selected" ).text();

        $('#delete-title').html('<i class="fas fa-car"></i>'+' '+vehicle +" Vehicle Mileage Deleting" );

        $("#delete-modal").modal('show'); 
    
        $("#btn-confirm").on("click", function(){
            console.log("confirmed ");

            $.ajax({
                url:"{{ route('mileage.delete')}}",
                method: "POST",
                data: { id: id },
                success: function(data)
                {
                    console.log(data);   
                    $('#flash-message').html(data); 
    
                    $('tr#'+id).remove();
                    $('#delete-modal').modal('hide');
                },
                error: function(xhr, textStatus, error){
                    console.log(xhr.statusText);
                    console.log(textStatus);
                    console.log(error);
                }
            });

        });
 
    });

</script>

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

    $("#edit_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $('#input_begin, #input_end').keyup(function(){

        var meter_begin = $('#input_begin').val();
        var meter_end = $('#input_end').val();
        var meter_reading_mileage= meter_end - meter_begin ;

        console.log(meter_reading_mileage);
        $('#input_meter_reading_mileage').val(meter_reading_mileage); 
        
        // input_journey_mileage

    });

    $('#edit_meter_reading_day_begin, #edit_meter_reading_day_end').keyup(function(){

        var meter_begin = $('#edit_meter_reading_day_begin').val();
        var meter_end = $('#edit_meter_reading_day_end').val();
        var meter_reading_mileage= meter_end - meter_begin ;

        console.log(meter_reading_mileage);
        $('#edit_meter_reading_mileage').val(meter_reading_mileage); 

        // input_journey_mileage

    });

</script>
    
@endsection