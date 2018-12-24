@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE ACCIDENTS')

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> 
        /* label{margin-left: 20px;}
        #datepicker{ margin: 0 20px 20px 20px;} */
        #date, > span:hover{cursor: pointer;color: blue;}
        #recovery_date > span:hover{cursor: pointer;color: blue;} 
        #edit_recovery_date > span:hover{cursor: pointer;color: blue;}
        #edit_date > span:hover{cursor: pointer;color: blue;}
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

                <div class="col-md-4"> 

                    <h4><i class="fas fa-car-crash"></i>&nbsp Vehicle </h4>
                    <div>             
                        {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                    </div>                  
                </div>        

            </div> <br>
          
            <div class="row">
                
                <div class="col-md-4"> 

                    <h4><i class="fa fa-calendar"></i>&nbsp Accident Date </h4>
                                                        
                    <div id="date" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input name="date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
            
                </div> 

                <div class="col-md-2"> </div>

                <div class="col-md-4"> 

                    <h4><i class="fas fa-map-marker-alt"></i>&nbsp Place</h4>  
    
                    <div>  
                        {!! Form::text('place',null,['class'=>'form-control','placeholder'=>'Place' ]) !!}                      
                    </div>                      
                </div>   
            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 

                    <h4><i class="fa fa-user"></i>&nbsp Driver </h4>  
    
                    <div>  
                        {{Form::select('driver_id',$drivers,null,['class'=>'form-control ','placeholder'=>'Select Driver'])}}                     
                    </div>                      
                </div>

                <div class="col-md-2"> </div>

                <div class="col-md-4"> 

                    <h4><i class="fas fa-shield-alt"></i>&nbsp Police Station where Entry Lodged </h4>  
    
                    <div>  
                        {!! Form::text('police_station',null,['class'=>'form-control','placeholder'=>'Police Station ','rows'=>'2'  ]) !!}                      
                    </div>                      
                </div> 

            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 

                    <h4><i class="fa fa-drivers-license"></i>&nbsp Action Taken Against Driver</h4>  
    
                    <div>  
                        {!! Form::textarea('action_taken_against_driver',null,['class'=>'form-control','placeholder'=>'Action Taken Against Driver','rows'=>'2'  ]) !!}                      
                    </div>                      
                </div> 
    
            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 

                    <h4><i class="fas fa-file-alt"></i>&nbsp  Description of Damage</h4>  
    
                    <div>  
                        {!! Form::textarea('description_of_damage',null,['class'=>'form-control','placeholder'=>'Description','rows'=>'2'  ]) !!}                      
                    </div>                      
                </div> 

            </div><br>

            <div class="row"> 

                <div class="col-md-4"> 

                    <h4><i class="fa fa-user"></i>&nbsp Cost of Repaire </h4>  
    
                    <div>  
                        {{Form::number('cost_of_repaire', null,['class'=>'form-control ','placeholder'=>'Cost of Repaire'])}}                     
                    </div>                      
                </div>

                <div class="col-md-2"> </div>

                <div class="col-md-4"> 

                    <h4><i class="fa fa-calendar"></i>&nbsp Date of Recovery </h4>  
    
                    <div>  
                        <div id="recovery_date" class="input-group date" data-date-format="yyyy-mm-dd">
                            <input name="date_of_recovery" class="form-control" type="text" readonly />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>                     
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
                            <th scope="col"> Date </th>
                            <th scope="col"> Place </th>
                            <th scope="col"> Driver </th>
                            <th scope="col"> Description </th>
                            <th scope="col"> Action</th>
                        </tr>
                    </thead>
                    <tbody id="accident_info">

                    </tbody>
                </table>
            
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
                <button type="button" class="btn btn-danger" id="btn-confirm">Delete</button>
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

                    <i style="font-size:25px; color:gray" class="fas fa-car-crash"></i>&nbsp  <label class="modal-title" id="view-title" style="font-size:25px; color:gray;"> </label> 

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-calendar-alt"></i>&nbsp Accident Date</h4>
                            <dl class="col-md-offset-2">
                                <label style="font-size:15px" id="view_date"> </label>                              
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-map-marker-alt"></i>&nbsp Place</h4>
                            <dl class="col-md-offset-2">
                                <label style="font-size:16px" id="view_place"> </label>                              
                            </dl>
                        </div>
                    </div><br>
                   
                    <div class="row">

                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fa fa-user"></i>&nbsp Driver</h4>
                            <dl class="col-md-offset-2">
                                <p style="font-size:16px" id="view_driver"> test</p>                        
                            </dl>
                        </div>

                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fa fa-drivers-license"></i>&nbsp Action Taken Against Driver</h4>
                            <dl class="col-md-offset-2">
                                <p style="font-size:16px" id="view_action_taken_against_driver"> test </p>                        
                            </dl>
                         </div>
                    
                    </div><br>

                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-shield-alt"></i>&nbsp Police Station (Entry Lodged)</h4>
                                
                            <p style="font-size:16px" class="col-md-offset-2" id="view_police_station"> Test</p>                            
                            
                        </div>                       
                    </div><br>

                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-file-alt"></i>&nbsp Description of Damage</h4>
                            <dl class="col-md-offset-2">
                                <p style="font-size:16px" id="view_description_of_damage"> <p>                        
                            </dl>
                        </div>
                        
                    </div><br>

                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fa fa-money"></i>&nbsp Cost of Repaire</h4>
                            <dl class="col-md-offset-2">
                                <b> Rs. </b><label style="font-size:16px" id="view_cost_of_repaire"> <label>                        
                            </dl>
                        </div>

                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-calendar-alt"></i>&nbsp Date of Recovery</h4>
                            <dl class="col-md-offset-2">
                                <label style="font-size:15px" id="view_date_of_recovery"> </label>                              
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

                    <form action="{{ URL::to('/vehicle/accident/update')}}" method="POST" id="edit_accident" enctype="multipart/form-data">
                        {{csrf_field()}}
                    <input type="hidden" name="id" id="accident_id">            
    
                    <div class="row">
                    
                        <div class="col-md-6"> 
                            <h4 class="modal-title" > <i class="fas fa-calendar-alt"></i>&nbsp Accident Date</h4> 
        
                            <div id="edit_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="edit_acDate" name="date" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>                   
        
                        <div class="col-md-6"> 
                            <h4 class="modal-title" > <i class="fas fa-map-marker-alt"></i>&nbsp Place</h4>
                            {!! Form::text('place',null,['class'=>'form-control','id'=>'edit_place' ]) !!}
                    
                        </div>
                    </div><br> <br>                   
        
                    <div class="row">
        
                        <div class="col-md-6"> 
        
                            <h4 class="modal-title" > <i class="fa fa-user"></i>&nbsp Driver</h4> 
            
                            <div >  
                                {{Form::select('driver_id',$drivers,null,['class'=>'form-control ','id'=>'edit_driver'])}}
                            </div> 
        
                        </div> 

                        <div class="col-md-6"> 
                            <h4 class="modal-title" > <i class="fas fa-shield-alt"></i>&nbsp Police Station (Entry Lodged)</h4> 
                            <div >  
                                {!! Form::text('police_station',null,['class'=>'form-control','id'=>'edit_police_station','rows'=>'2'  ]) !!} 
                            </div> 
                        </div> 

                    </div><br><br>

                    <div class="row">                      

                        <div class="col-md-6"> 
        
                            <h4 class="modal-title" > <i class="fa fa-drivers-license"></i>&nbsp Action Taken Against Driver</h4> 
            
                            <div>  
                                {!! Form::textarea('action_taken_against_driver',null,['class'=>'form-control','id'=>'edit_action_taken_against_driver','rows'=>'2'  ]) !!}                      
                            </div>                      
                        </div> 

                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-file-alt"></i>&nbsp Description of Damage</h4> 
                            <div>
                                {!! Form::textarea('description_of_damage',null,['class'=>'form-control','id'=>'edit_description_of_damage','rows'=>'2'  ]) !!}
                            </div> 
                        </div>
    
                    </div><br> <br>
        
                    <div class="row">
        
                        <div class="col-md-6"> 
                            <h4 class="modal-title" > <i class="fa fa-money"></i>&nbsp Cost of Repaire</h4> 
        
                            <div>  
                                {{Form::number('cost_of_repaire', null,['class'=>'form-control ','id'=>'edit_cost_of_repaire'])}}                      
                            </div> 
                        </div>
        
                        <div class="col-md-6"> 
        
                            <h4 class="modal-title" > <i class="fas fa-calendar-alt"></i>&nbsp Date of Recovery</h4>
                                                                
                            <div id="edit_recovery_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="edit_date_of_recovery" name="date_of_recovery" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
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

@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

<script>

    function readAccidents(vid){ 
        $.ajax({
            url: '/vehicle/readVehicleAccidents/{id}',
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {
                //console.log(data);   
                $('#accident_info').empty().html(data);            
            }
        });
    }

    $('#vid').on('change',function () {
        var vid = $(this).val(); // get vehicle id
        
        readAccidents(vid);
    }); 

    $(document).on('click','#view',function(e){
        var id = $(this).data('id'); //get annual licence id

        $.ajax({
            url: '/vehicle/viewAccident/{id}',
            type: 'GET',
            data: { id: id },
            success: function(data)
            {
                    /* set values to html tag for view */  
                console.log(data);
                $('#view-title').html(data[0].vehicle_name+" ("+data[0].vehicle_reg+") "+" Vehicle Accident" );
                $('#view_date').html(data[0].date );
                $('#view_place').html(data[0].place );
                $('#view_driver').html(data[0].title+" "+data[0].firstname+" "+data[0].surname ); 
                $('#view_action_taken_against_driver').html(data[0].action_taken_against_driver );  
                $('#view_police_station').html(data[0].police_station);
                $('#view_description_of_damage').html(data[0].description_of_damage);
                $('#view_cost_of_repaire').html(data[0].cost_of_repaire); 
                $('#view_date_of_recovery').html(data[0].date_of_recovery);
   
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

    $(document).on('click','#delete',function(e){
        var id = $(this).data('id');
        console.log(id);

        $.ajax({
            url: '/vehicle/viewAccident/{id}',
            type: 'GET',
            data: { id: id },
            success: function(data)
            {    
                $('#delete-title').html(data[0].vehicle_name+" ( "+data[0].vehicle_reg+" ) "+" Vehicle Accident Delete" ); 
   
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
            }
        });

        $("#delete-modal").modal('show'); 
    
        $("#btn-confirm").on("click", function(){
            console.log("confirmed ");

            $.ajax({
                url:"{{ route('accident.delete')}}",
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

    $(document).on('click','#edit',function(e){
        var id = $(this).data('id');
        console.log(id);
        var vid;

        $('#accident_id').val(id);
        console.log(id);

           /* getting existing data to modal */

        $.ajax({
            url: '/vehicle/viewAccident/{id}',
            type: 'GET',
            data: { id: id },
            success: function(data)
            {    
                vid =data[0].vehical_id;

                $('#edit-title').html(data[0].vehicle_name+" ( "+data[0].vehicle_reg+" ) "+" Vehicle Accident Editing" ); 
                $('#edit_acDate').val(data[0].date);
                $('#edit_place').val(data[0].place);    
                $('#edit_driver').val(data[0].driver_id);
                $('#edit_police_station').val(data[0].police_station);
                $('#edit_action_taken_against_driver').val(data[0].action_taken_against_driver);
                $('#edit_description_of_damage').val(data[0].description_of_damage); 
                $('#edit_cost_of_repaire').val(data[0].cost_of_repaire);
                $('#edit_date_of_recovery').val(data[0].date_of_recovery);
   
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
            }
        });

        $("#edit-modal").modal('show');

        $('#edit_accident').on('submit',function(e){
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
                    readAccidents(vid);      
                },
                error: function(xhr, textStatus, error){
                    console.log(xhr.statusText);
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

    $("#date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });  

    $("#recovery_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }); 

    $("#edit_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $("#edit_recovery_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }); 

    setTimeout(function() {
        $('#successMessage').fadeOut('slow');       
    }, 3000); 
    
</script>
    
@endsection