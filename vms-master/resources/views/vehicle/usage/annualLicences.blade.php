@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE SERVICING')

@section('styles')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> 
        /* #datepicker{width:300px; } */
        #datepicker > span:hover{cursor: pointer;color: blue;} 

        #from_date > span:hover{cursor: pointer;color: blue;}

        #to_date > span:hover{cursor: pointer;color: blue;}

        #view-title,#amount,#period-from,#period-to { font-weight:normal; }

    </style>
@endsection

@section('header', 'Vehicle Annual Licences')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
    <div class="flash-message"></div>
  
    <div class="box box-primary">
    
        <div class="box-body"  >

            <div class="row"> 
                {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeAnnualLicenc','files'=>true]) !!}
                <div class="col-md-3"> 

                    <h4><i class="fa fa-car"></i> Vehicle </h4>
    
                    <div >
                        
                        {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                        
                    </div>
                    
                </div>
            </div> <br>

            <div> 
                <h4><i class="fas fa-tachometer-alt"></i>&nbsp Period </h4> 
            </div>

            <div class="row">
                
                <div class="col-md-3"> 
                    <h4><i class=""></i> From </h4> 

                    <div id="from_date" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="date" name="from" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                </div>

                <div class="col-md-2">
                </div>

                <div class="col-md-3"> 
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

                <div class="col-md-3"> 

                    <h4> <i class="glyphicon glyphicon-list-alt"></i>&nbsp Licensing Authority </h4>  
    
                    <div >  
                        {!! Form::text('licensing_authority',null,['class'=>'form-control','placeholder'=>'Licensing Authority' ]) !!}
                    </div> 

                </div> 
                
                <div class="col-md-9">
                </div>

            </div><br>

            <div class="row">

                <div class="col-md-3"> 

                    <h4> <i class="fas fa-check-double"></i>&nbsp Vehicle Licence Number </h4>  
    
                    <div>  
                        {{Form::number('licence_no', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Enter Licence Number'])}}                      
                    </div>                      
                </div> 

                <div class="col-md-2">
                    </div>

                <div class="col-md-3"> 

                    <h4> <i class="fas fa-calendar-alt"></i> &nbsp Licence Date </h4>
                                                        
                    <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="date" name="licence_date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                
                </div>

            </div><br>
            
            <div class="row"> 
                <div class="col-md-3"> 
                    <h4><i class="fa fa-money"></i>&nbsp Amount </h4>  

                    <div>  
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

            <div class="box box-primary" id="table_box" style="height:400px; overflow: auto;" data-target="#exampleModalCenter">
            
                <table id="table" class="table table-sm table-hover table-sm table-striped">
                    <thead class="table-dark">  
                        <tr >                          
                            <th scope="col"> From </th>
                            <th scope="col"> To</th> 
                            <th scope="col"> Licensing Authority</th>
                            <th scope="col"> Vehicle Licence Number</th>
                            <th scope="col"> Licence Date</th>
                            <th scope="col"> Amount (Rs.)</th>
                            <th scope="col"> Action </th>
                        </tr>
                    </thead>
                    <tbody id="servicing_info">

                    </tbody>
                </table>
            
            </div>
          
        </div>

            {{-- Edit Confirmation modal --}}
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

                {{-- {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeAnnualLicenc','files'=>true]) !!} --}}

                <form action="{{ URL::to('/journey/request/confirmAjax')}}" method="POST" id="formConfirmationAjax">
                    {{csrf_field()}}
                <input type="hidden" name="id" id="licence_id">
                    
                <div> 
                    <h4><i class="fas fa-tachometer-alt"></i>&nbsp Period </h4> 
                </div>
    
                <div class="row">
                    
                    <div class="col-md-3"> 
                        <h4>From </h4> 
    
                        <div id="edit_from_date" class="input-group date" data-date-format="yyyy-mm-dd">
                            <input id="date" name="from" class="form-control" type="text" readonly />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
    
                    <div class="col-md-2">
                    </div>
    
                    <div class="col-md-3"> 
                        <h4> To </h4> 
    
                        <div id="edit_to_date" class="input-group date" data-date-format="yyyy-mm-dd">
                            <input id="date" name="to" class="form-control" type="text" readonly />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <br>
    
    
                <div class="row">
    
                    <div class="col-md-3"> 
    
                        <h4> <i class="glyphicon glyphicon-list-alt"></i>&nbsp Licensing Authority </h4>  
        
                        <div >  
                            {!! Form::text('licensing_authority',null,['class'=>'form-control','placeholder'=>'Licensing Authority' ]) !!}
                        </div> 
    
                    </div> 
                    
                    <div class="col-md-9">
                    </div>
    
                </div><br>
    
                <div class="row">
    
                    <div class="col-md-3"> 
    
                        <h4> <i class="fas fa-check-double"></i>&nbsp Vehicle Licence Number </h4>  
        
                        <div>  
                            {{Form::number('licence_no', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Enter Licence Number'])}}                      
                        </div>                      
                    </div> 
    
                    <div class="col-md-2">
                        </div>
    
                    <div class="col-md-3"> 
    
                        <h4> <i class="fas fa-calendar-alt"></i> &nbsp Licence Date </h4>
                                                            
                        <div id="edit_lic_date" class="input-group date" data-date-format="yyyy-mm-dd">
                            <input id="date" name="licence_date" class="form-control" type="text" readonly />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    
                    </div>
    
                </div><br>
                
                <div class="row"> 
                    <div class="col-md-3"> 
                        <h4><i class="fa fa-money"></i>&nbsp Amount </h4>  
    
                        <div>  
                            {{Form::number('amount', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Amount'])}}                      
                        </div> 
                    </div>
                        
                </div><br>
            
                        
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success active" id="update">Update</button>
                {!! Form::close() !!} 
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

            {{-- Delete Confirmation modal --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <b> <h3 class="modal-title" id="delete-title">Confirmation</h3> </b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="modal-title" >Please Confirm Your Action</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary active" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="btn-confirm">Delete</button>
            </div>
            </div>
        </div>
    </div>

            {{-- View modal --}}
    <div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">

                <i style="font-size:27px; color:darkblue;" class="fa fa-car"></i>&nbsp  <label class="modal-title" id="view-title" style="font-size:27px; color:darkblue;"> </label> 

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <h3 class="modal-title" > <i class="fas fa-tachometer-alt"></i>&nbsp Licence Period</h3>
                <div class="row">
                    <div class="col-md-6">
                        <dl class="col-md-offset-3">
                            
                            <label style="font-size:16px" >From: &nbsp</label>
                            <label style="font-size:16px" id="period-from"> </label>
                            
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="col-md-offset-3">
                            
                            <label style="font-size:16px">To: &nbsp</label>
                            <label style="font-size:16px" id="period-to"> </label>
                            
                        </dl>
                    </div>
                </div><br>
                <h3 class="modal-title" > <i class="glyphicon glyphicon-list-alt"></i>&nbsp Licensing Authority</h3>
                <div class="row">
                    <div class="col-md-6">
                        <dl class="col-md-offset-3">
                            <p style="font-size:16px" id="licensing_authority"> </p>                        
                        </dl>
                    </div>
                   
                </div><br>

                
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="modal-title" > <i class="fas fa-check-double"></i>&nbsp Licence Number</h3>
                            
                        <p style="font-size:16px" class="col-md-offset-3" id="licence_no"> </p>                            
                        
                    </div>
                    <div class="col-md-6">
                        <h3 class="modal-title"> <i class="fas fa-calendar-alt"></i>&nbsp Licence Date</h3>
                            
                        <p style="font-size:16px" class="col-md-offset-3" id="licence_date"> </p>                       
                    </div>
                </div><br>

                <h3 class="modal-title" > <i class="fa fa-money"></i>&nbsp Amount</h3>
                <div class="row">
                    <div class="col-md-6">
                        <dl class="col-md-offset-3">
                           <b> Rs. </b><label style="font-size:16px" id="amount"> <label>                        
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
       
    </div>
                    
 
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#vid').on('change',function () {
        var vid = $(this).val();
        console.log(vid);

        $.ajax({
            url: '/vehicle/readAnnualLicenc/{id}',
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {
                //console.log(data);   
                $('#servicing_info').empty().html(data);            
                // $(data).each(function (i,value) {                
                //     //servicing_info 
                //     var tr = $("<tr/>");
                //     tr.append($("<td/>",{
                //         text :value.vehicle_name+" ("+value.vehicle_reg+")"
                //     })).append($("<td/>",{
                //         text :value.from
                //     })).append($("<td/>",{
                //         text :value.to
                //     })).append($("<td/>",{
                //         text :value.licence_no
                //     })).append($("<td/>",{
                //         text :value.licence_date
                //     })).append($("<td/>",{
                //         text :value.amount
                //     }))
                //     $('#servicing_info').append(tr);              
                // }); 
               
            }
        });

    });  


        /* one licence edit click event */
    $(document).on('click','#edit',function(e){
        var id = $(this).data('id');
        console.log(id);

        $.ajax({
            url: '/vehicle/viewAnnualLicenc/{id}',
            type: 'GET',
            data: { id: id },
            success: function(data)
            {    
                $('#edit-title').html(data[0].vehicle_name+" ("+data[0].vehicle_reg+") "+"Annual Licence Edit" );
   
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
            }
        });

        $("#edit-modal").modal('show');

    });

    
           /* one licence view click event */
    $(document).on('click','#view',function(e){
        var id = $(this).data('id');
        console.log(id);

        $.ajax({
            url: '/vehicle/viewAnnualLicenc/{id}',
            type: 'GET',
            data: { id: id },
            success: function(data)
            {
                //console.log(data[0]);    
                $('#view-title').html(data[0].vehicle_name+" ("+data[0].vehicle_reg+") "+"Annual Licence" );
                $('#period-from').html(data[0].from );
                $('#period-to').html(data[0].to ); 
                $('#licensing_authority').html(data[0].licensing_authority );  
                $('#licence_no').html(data[0].licence_no);
                $('#licence_date').html(data[0].licence_date);
                $('#amount').html(data[0].amount);
   
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            }
        });

        $("#view-modal").modal('show');

    });
            /* one licence delete click event */
    $(document).on('click','#delete',function(e){
        var id = $(this).data('id');
        console.log(id);



        $("#delete-modal").modal('show'); 
    
        $("#btn-confirm").on("click", function(){
            console.log("confirmed ");
            $("#mi-modal").modal('hide');

            $.ajax({
                url:"{{ route('annLicence.delete')}}",
                method: "POST",
                data: { id: id },
                success: function(data)
                {
                    console.log(data);   
                    $('div.flash-message').html(data); 
                    $('tr#'+id).remove();
                    
                },
                error: function(xhr, textStatus, error){
                    console.log(xhr.statusText);
                    console.log(textStatus);
                    console.log(error);
                }
            });

        });
 
    });

        /* TIME OUT for success and error message session */
    setTimeout(function() {
        $('div.flash-message').fadeOut('slow');       
    }, 10000);

</script>

<script>

    $("#datepicker").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $("#from_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });
    //.datepicker('update', new Date())

    $("#to_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $("#edit_from_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $("#edit_to_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $("#edit_lic_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    setTimeout(function() {
        $('#successMessage').fadeOut('slow');       
    }, 3000); 

    setTimeout(function() {
        $('#errorMessage').fadeOut('slow');       
    }, 3000); 

</script>
    

@endsection