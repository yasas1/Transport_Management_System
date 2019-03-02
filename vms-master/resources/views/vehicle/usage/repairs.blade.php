@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE REPAIRS')

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> 
        #in_date > span:hover{cursor: pointer;color: blue;}
        #out_date > span:hover{cursor: pointer;color: blue;} 
        #invo_date > span:hover{cursor: pointer;color: blue;} 
        #edit_in_date > span:hover{cursor: pointer;color: blue;}
        #edit_out_date > span:hover{cursor: pointer;color: blue;}
        #edit_invo_date > span:hover{cursor: pointer;color: blue;} 
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
            @if(Auth::user()->canCreateVehicleRepair())
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

                <div class="col-md-2"> </div>

                <div class="col-md-4"> 

                    <h4> <i class="fas fa-place-of-worship"></i> &nbsp Workshop Details  </h4> 
                                                        
                    <div>  
                        {!! Form::textarea('executed_at',null,['class'=>'form-control','placeholder'=>'Executed at ','rows'=>'2'  ]) !!}                    
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
            </div><br><br>

            <div class="row"> 

                <div class="col-md-4"> 

                    <h4> <i class="fas fa-comments-dollar"></i> &nbsp Cost  </h4>  
    
                    <div>  
                        {{Form::number('cost', null,['class'=>'form-control ','placeholder'=>'Cost'])}}                     
                    </div>                      
                </div> 
        
            </div><br>

            <div class="row">
                
                <div class="col-md-6"> 

                    <h4> <i class="fas fa-user-shield"></i> &nbsp Authorized by  </h4> 
                                                        
                    <div>  
                        {{-- {!! Form::text('authorized_by',null,['class'=>'form-control','placeholder'=>'Authorized by' ]) !!}                     --}}
                        {!! Form::hidden('authorized_by', null,['id'=>'txtauthorized_by']); !!}
                        <div class="btn-group dropup col-md-12">
                            <button type="button" class="btn btn-default" id="divDiviHead">Select Divisional Head</button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($divHeads as $divHead)
                                    @if($divHead->head !='')
                                        <li class="cmbDivHead dropdown-item" data-value="{{$divHead->getHead()->first()->emp_initials.'. '.$divHead->getHead()->first()->emp_surname}}">
                                        <span>
                                            {{$divHead->getHead()->first()->emp_initials.'. '.$divHead->getHead()->first()->emp_surname.' ( '.$divHead->dept_name.' )'}}
                                        </span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>

                        </div>
                    </div>
            
                </div>
 
            </div><br>


            <div class="row"> 

                <div class="col-md-4"> 
                    <button type="submit" class="btn btn-success pull-left"> <i class="glyphicon glyphicon-arrow-up"></i>&nbsp SUBMIT </button>  &nbsp
                    {{Form::reset('CLEAR', ['class'=>'btn btn-warning'])}}
                </div>  
            </div>
            {!! Form::close() !!} <br>
            @endif
            <h3 id="table_header" style="text-align:center;display: none;"> </h3> 
            <div class="box box-primary" id="table_box" style="height:400px; overflow: auto; display: none;" data-target="#exampleModalCenter">
                
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

            {{------------   View modal  --------------}}
    <div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <i style="font-size:25px; color:gray" class="fas fa-car"></i>&nbsp  <label class="modal-title" id="view-title" style="font-size:25px; color:gray;"> </label> 

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title" > <i class="far fa-calendar"></i>&nbsp Workshop Date</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fa fa-mail-forward"></i>&nbsp In</h4>
                            <dl class="col-md-offset-2">
                                <label style="font-size:15px" id="view_workshop_in_date"> </label>                              
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fa fa-reply-all"></i>&nbsp Out</h4> 
                            <dl class="col-md-offset-2">
                                <label style="font-size:16px" id="view_workshop_out_date"> </label>                              
                            </dl>
                        </div>
                    </div><br>
                    
                    <h4 class="modal-title" > <i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading</h4>
                    <div class="row">

                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fa fa-mail-forward"></i> &nbsp In</h4>
                            <dl class="col-md-offset-2">
                                <p style="font-size:16px" id="view_meter_reading_in"> in</p>                        
                            </dl>
                        </div>

                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fa fa-reply-all"></i> &nbsp Out</h4>
                            <dl class="col-md-offset-2">
                                <p style="font-size:16px" id="view_meter_reading_out"> out </p>                        
                            </dl>
                        </div>
                    
                    </div><br>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="modal-title" > <i class="fab fa-audible"></i>&nbsp Works Executed and Parts Used</h4>
                                
                            <p style="font-size:16px" class="col-md-offset-2" id="view_works_and_parts"> Test</p>                            
                            
                        </div>                       
                    </div><br>

                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-calculator"></i>&nbsp Invoice No</h4>
                            <dl class="col-md-offset-2">
                                <label style="font-size:16px" id="view_invoice_no"> <label>                        
                            </dl>
                        </div>

                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-calendar-alt"></i>&nbsp Invoice Date</h4>
                            <dl class="col-md-offset-2">
                                <label style="font-size:15px" id="view_invoice_date"> </label>                              
                            </dl>
                        </div>
                    </div>   

                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-user-shield"></i>&nbsp Authorized By</h4>
                            <dl class="col-md-offset-2">
                                <label style="font-size:16px" id="view_authorized_by"> <label>                        
                            </dl>
                        </div>

                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-place-of-worship"></i>&nbsp Executed At (workshop)</h4>
                            <dl class="col-md-offset-2">
                                <label style="font-size:15px" id="view_executed_at"> </label>                              
                            </dl>
                        </div>
                     </div> 
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title" > <i class="fas fa-comments-dollar"></i>&nbsp Cost</h4>
                            <dl class="col-md-offset-2">
                                    <b> Rs. </b><label style="font-size:16px" id="view_cost"> <label>                        
                            </dl>
                        </div>
                        
                    </div><br>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary active" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

            {{-------------  Edit modal  --------------}}
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

                    <form action="{{ URL::to('/vehicle/repair/update')}}" method="POST" id="edit_repaire" enctype="multipart/form-data">
                        {{csrf_field()}}
                    <input type="hidden" name="id" id="repaire_id">  
                    
                    <div class="row">
                
                        <div class="col-md-6"> 
        
                            <h4><i class="far fa-calendar"></i>&nbsp Workshop In Date </h4>
                                                                
                            <div id="edit_in_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input name="workshop_in_date" id="edit_workshop_in_date" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                    
                        </div> 
        
                        <div class="col-md-6"> 
        
                            <h4><i class="far fa-calendar"></i>&nbsp Workshop Out Date </h4>
                                                            
                            <div id="edit_out_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input name="workshop_out_date" id="edit_workshop_out_date" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div> 

                        </div> 

                    </div><br>
        
                    <div class="row">
                        
                        <div class="col-md-6"> 
        
                            <h4><i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading In  </h4>
                                                                
                            <div>  
                                {{Form::number('meter_reading_in', null,['class'=>'form-control ','id'=>'edit_meter_reading_in'])}}                     
                            </div>
                    
                        </div> 
        
                        <div class="col-md-6"> 
        
                            <h4><i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading Out  </h4>
                                                            
                            <div>  
                                {{Form::number('meter_reading_out', null,['class'=>'form-control ','id'=>'edit_meter_reading_out'])}}                     
                            </div> 

                        </div>   
                    </div><br>
        
                    <div class="row"> 
        
                        <div class="col-md-6"> 
        
                            <h4> <i class="fab fa-audible"></i> &nbsp Works And Parts Used </h4>  
            
                            <div>  
                                {!! Form::textarea('works_and_parts',null,['class'=>'form-control','rows'=>'2','id'=>'edit_works_and_parts' ]) !!}                     
                            </div>                      
                        </div> 
        
                    </div><br>
        
                    <div class="row">
                        
                        <div class="col-md-6"> 
        
                            <h4> <i class="fas fa-calculator"></i> &nbsp Invoice No.</h4>
                                                                
                            <div>  
                                {{Form::number('invoice_no', null,['class'=>'form-control','id'=>'edit_invoice_no'])}}                     
                            </div>
                    
                        </div> 
        
                        <div class="col-md-6"> 
        
                            <h4> <i class="far fa-calendar"></i> &nbsp Invoice Date </h4>
                                                            
                            <div id="edit_invo_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input name="invoice_date" id="edit_invoice_date" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>                     
                        </div>  
                         
                    </div><br>
        
                    <div class="row"> 
        
                        <div class="col-md-6"> 
        
                            <h4> <i class="fas fa-comments-dollar"></i> &nbsp Cost  </h4>  
            
                            <div>  
                                {{Form::number('cost', null,['class'=>'form-control ','id'=>'edit_cost'])}}                     
                            </div>                      
                        </div> 
                
                    </div><br>
        
                    <div class="row">
                        
                        <div class="col-md-6"> 
        
                            <h4> <i class="fas fa-user-shield"></i> &nbsp Authorized by  </h4> 
                                                                
                            <div>  
                                {!! Form::text('authorized_by',null,['class'=>'form-control','id'=>'edit_authorized_by' ]) !!}                    
                            </div>
                    
                        </div>
                        
               
        
                        <div class="col-md-6"> 
        
                            <h4> <i class="fas fa-place-of-worship"></i> &nbsp Executed at (workshop)  </h4> 
                                                                
                            <div>  
                                {!! Form::text('executed_at',null,['class'=>'form-control','id'=>'edit_executed_at' ]) !!}                    
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
    $('.cmbDivHead').on('click',function () {
        $('#txtauthorized_by').val($(this).attr('data-value'));
        $('#divDiviHead').html($(this).html());
    });
</script>

<script>

    function readRepairs(vid){     
        $.ajax({
            url: "{{ URL::to('/vehicle/readVehicleRepairs/{id}') }}",
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {  
                $('#repair_info').empty().html(data);
                          
            }
        });
    }

    $('#vid').on('change',function () {
        var vid = $(this).val(); // get vehicle id
        var vehicle = $( "#vid option:selected" ).text();

        $('#table_header').html('<i class="fa fa-car"></i>'+' '+vehicle+" Vehicle Repair History");
        $('#table_header').show(); 

        readRepairs(vid);
        $('#table_box').show(); 
    }); 

    /* one Repair row view click event */
    $(document).on('click','#view',function(e){
        var id = $(this).data('id'); //get annual licence id

        $.ajax({
            url: "{{ URL::to('/vehicle/viewRepair/{id}') }}" ,
            type: 'GET',
            data: { id: id },
            success: function(data)
            {
                    /* set values to html tag for view */  
                $('#view-title').html(data[0].vehicle_name+" ("+data[0].vehicle_reg+") "+"Vehicle Repair" );
                $('#view_workshop_in_date').html(data[0].workshop_in_date );
                $('#view_workshop_out_date').html(data[0].workshop_out_date ); 
                $('#view_meter_reading_in').html(data[0].meter_reading_in );  
                $('#view_meter_reading_out').html(data[0].meter_reading_out);
                $('#view_works_and_parts').html(data[0].works_and_parts);
                $('#view_invoice_no').html(data[0].invoice_no); 
                $('#view_invoice_date').html(data[0].invoice_date);
                $('#view_authorized_by').html(data[0].authorized_by);
                $('#view_executed_at').html(data[0].executed_at); 
                $('#view_cost').html(data[0].cost); 

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

    $(document).on('click','#edit',function(e){
        var id = $(this).data('id');
        var vid;

        $('#repaire_id').val(id);

           /* getting existing data to modal */
        $.ajax({
            url: "{{ URL::to('/vehicle/viewRepair/{id}') }}",
            type: 'GET',
            data: { id: id },
            success: function(data)
            {    
                vid =data[0].vehical_id;

                $('#edit-title').html('<i class="fas fa-car"></i>'+' '+data[0].vehicle_name+" ( "+data[0].vehicle_reg+" ) "+" Vehicle Repair Editing" ); 
                $('#edit_workshop_in_date').val(data[0].workshop_in_date);
                $('#edit_workshop_out_date').val(data[0].workshop_out_date); 
                $('#edit_meter_reading_in').val(data[0].meter_reading_in);  
                $('#edit_meter_reading_out').val(data[0].meter_reading_out);
                $('#edit_works_and_parts').val(data[0].works_and_parts);
                $('#edit_invoice_no').val(data[0].invoice_no); 
                $('#edit_invoice_date').val(data[0].invoice_date);
                $('#edit_authorized_by').val(data[0].authorized_by);
                $('#edit_executed_at').val(data[0].executed_at); 
                $('#edit_cost').val(data[0].cost); 
   
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
            }
        });

        $("#edit-modal").modal('show');

        $('#edit_repaire').on('submit',function(e){
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
                    readRepairs(vid);      
                },
                error: function(xhr, textStatus, error){
                    console.log(xhr.statusText);
                }
            });     
        });

    });

    $(document).on('click','#delete',function(e){
        var id = $(this).data('id');

        var vehicle = $( "#vid option:selected" ).text();

        $('#delete-title').html('<i class="fas fa-car"></i>'+' '+vehicle +" Vehicle Repaire Deleting" );

        $("#delete-modal").modal('show'); 
    
        $("#btn-confirm").on("click", function(){

            $.ajax({
                url:"{{ route('repaire.delete')}}",
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

    $("#edit_in_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }); 
    $("#edit_out_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }); 
    $("#edit_invo_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }); 
 
    
</script>
    
@endsection