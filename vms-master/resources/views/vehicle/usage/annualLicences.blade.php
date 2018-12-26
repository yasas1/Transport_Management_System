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
        #edit_lic_date > span:hover{cursor: pointer;color: blue;} 

        #view-title,#amount,#period-from,#period-to { font-weight:normal; }

    </style>
@endsection

@section('header', 'Vehicle Annual Licences')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')
    <div class="flash-message" id="flash-message" ></div>
  
    <div class="box box-primary">
    
        <div class="box-body"  >

            <div class="row"> 
                {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeAnnualLicenc','files'=>true]) !!}
                <div class="col-md-4"> 

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
                
                <div class="col-md-4"> 
                    <h4><i class=""></i> From </h4> 

                    <div id="from_date" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="date" name="from" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                </div>

                <div class="col-md-2">
                </div>

                <div class="col-md-4"> 
                    <h4><i class=""></i> To </h4> 

                    <div id="to_date" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="date" name="to" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">

                <div class="col-md-4"> 

                    <h4> <i class="glyphicon glyphicon-list-alt"></i>&nbsp Licensing Authority </h4>  
    
                    <div >  
                        {!! Form::text('licensing_authority',null,['class'=>'form-control','placeholder'=>'Licensing Authority' ]) !!}
                    </div> 

                </div> 
                

            </div><br>

            <div class="row">

                <div class="col-md-4"> 

                    <h4> <i class="fas fa-check-double"></i>&nbsp Vehicle Licence Number </h4>  
    
                    <div>  
                        {{Form::number('licence_no', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Enter Licence Number'])}}                      
                    </div>                      
                </div> 

                <div class="col-md-2">
                    </div>

                <div class="col-md-4"> 

                    <h4> <i class="fas fa-calendar-alt"></i> &nbsp Licence Date </h4>
                                                        
                    <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                        <input id="date" name="licence_date" class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                
                </div>

            </div><br>
            
            <div class="row"> 
                <div class="col-md-4"> 
                    <h4><i class="fa fa-money"></i>&nbsp Amount </h4>  

                    <div>  
                        {{Form::number('amount', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Amount'])}}                      
                    </div> 
                </div>
                  
            </div><br>

            <div class="row">

                <div class="col-md-4"> 

                    <h4> <i class="fas fa-award"></i>&nbsp Emission Test Details </h4>  
    
                    <div >  
                        {!! Form::textarea('emission_test_details',null,['class'=>'form-control','placeholder'=>'Emission Test Details','rows'=>'2' ]) !!}
                    </div> 

                </div> 
                
                <div class="col-md-2">
                </div>

                <div class="col-md-4">
                    <h4> <i class="glyphicon glyphicon-upload"></i>&nbsp Annual Licence File Upload </h4>  

                    <div>
                        {{Form::file('licence_file',['class'=>'btn btn-default'])}}  
                    
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

            <h3 id="table_header"style="text-align:center;display: none;"> </h3> 
            <div class="box box-primary" id="table_box" style="height:400px; overflow: auto; display: none;" data-target="#exampleModalCenter">
            
                <table id="table" class="table table-sm table-hover table-sm table-striped">
                    <thead class="table-dark">  
                        <tr >                          
                            <th scope="col"> From </th>
                            <th scope="col"> To</th> 
                            <th scope="col"> Licensing Authority</th>
                            <th scope="col"> Vehicle Licence Number</th>
                            <th scope="col"> Licence Date</th>
                            <th scope="col"> Amount (Rs.)</th>
                            <th scope="col"> Emisiion Test Details</th>
                            <th scope="col"> Action </th>
                        </tr>
                    </thead>
                    <tbody id="licence_info">

                    </tbody>
                </table>
            
            </div>
          
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

                    <form action="{{ URL::to('/vehicle/annualLicence/update')}}" method="POST" id="edit_Licence" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="licence_id">
                        
                    <div> 
                        <h4><i class="fas fa-tachometer-alt"></i>&nbsp Period </h4> 
                    </div>
        
                    <div class="row">
                        
                        <div class="col-md-6"> 
                            <h4>From </h4> 
        
                            <div id="edit_from_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="edit_licFrom" name="from" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
        
                        
        
                        <div class="col-md-6"> 
                            <h4> To </h4> 
        
                            <div id="edit_to_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="edit_licTo" name="to" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <br>
        
        
                    <div class="row">
        
                        <div class="col-md-6"> 
        
                            <h4> <i class="glyphicon glyphicon-list-alt"></i>&nbsp Licensing Authority </h4>  
            
                            <div >  
                                {!! Form::text('licensing_authority',null,['class'=>'form-control','id'=>'edit_licensing_authority','placeholder'=>'Licensing Authority' ]) !!}
                            </div> 
        
                        </div> 
                        
                        {{-- <div class="col-md-9">
                        </div> --}}
        
                    </div><br>
        
                    <div class="row">
        
                        <div class="col-md-6"> 
        
                            <h4> <i class="fas fa-check-double"></i>&nbsp Vehicle Licence Number </h4>  
            
                            <div>  
                                {{Form::number('licence_no', null,['class'=>'form-control ','id'=>'edit_licence_no','placeholder'=>'Enter Licence Number'])}}                      
                            </div>                      
                        </div> 
        
                        {{-- <div class="col-md-2">
                            </div> --}}
        
                        <div class="col-md-6"> 
        
                            <h4> <i class="fas fa-calendar-alt"></i> &nbsp Licence Date </h4>
                                                                
                            <div id="edit_lic_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="edit_licDate" name="licence_date" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        
                        </div>
        
                    </div><br>
                    
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <h4><i class="fa fa-money"></i>&nbsp Amount </h4>  
        
                            <div>  
                                {{Form::number('amount', null,['class'=>'form-control ','id'=>'edit_amount','placeholder'=>'Amount'])}}                      
                            </div> 
                        </div>
                            
                    </div><br>
                    
                    <div class="row">
                        <div class="col-md-6"> 
                            <h4> <i class="fas fa-award"></i>&nbsp Emission Test Details </h4>  
                            <div >  
                                {!! Form::text('emission_test_details',null,['class'=>'form-control','id'=>'edit_emission_test_details' ]) !!}
                            </div> 
                        </div> 

                        <div class="col-md-6">
                            <h4> <i class="glyphicon glyphicon-upload"></i>&nbsp Annual Licence File Upload </h4>  
                            <div>
                                <input type="file" name="licence_file" class="btn btn-default" id="edit_file" > <br>
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
<script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        /* read annual licence for given vehicle and display in the table */
    function readAnnualLicenc(vid){ 
        $.ajax({
            url: '/vehicle/readAnnualLicenc/{id}',
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {
                //console.log(data);   
                $('#licence_info').empty().html(data);
                // $(data).each(function (i,value) {                
                
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
                //     $('#licence_info').append(tr);              
                // });             
            }
        });
    }

    $('#vid').on('change',function () {
        var vid = $(this).val(); // get vehicle id
        var vehicle = $( "#vid option:selected" ).text();
        
        $('#table_header').html('<i class="fa fa-car"></i>'+' '+vehicle+" Vehicle Annual Licences History");
        $('#table_header').show();
     
        readAnnualLicenc(vid);
        $('#table_box').show();
    });  

        /* one licence edit click event */
    $(document).on('click','#edit',function(e){
        var id = $(this).data('id');
        var vid;

        $('#licence_id').val(id);

           /* getting existing data to modal */

        $.ajax({
            url: '/vehicle/viewAnnualLicenc/{id}',
            type: 'GET',
            data: { id: id },
            success: function(data)
            {    
                vid =data[0].vehical_id;

                $('#edit-title').html(data[0].vehicle_name+" ( "+data[0].vehicle_reg+" ) "+" Annual Licence Editing" ); 
                $('#edit_licFrom').val(data[0].from);
                $('#edit_licTo').val(data[0].to);    licensing_authority
                $('#edit_licDate').val(data[0].licence_date);
                $('#edit_amount').val(data[0].amount);
                $('#edit_licence_no').val(data[0].licence_no);
                $('#edit_licensing_authority').val(data[0].licensing_authority); 
                $('#edit_emission_test_details').val(data[0].emission_test_details);
   
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
            }
        });

        $("#edit-modal").modal('show');

        $('#edit_Licence').on('submit',function(e){
            e.preventDefault();
           // var data = $(this).serialize();
            var url = $(this).attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(this),
                cache:false,
                contentType:false,
                processData:false,
                success: function(data)
                {    
                    //console.log(data);           
                    $('#edit-modal').modal('hide');  
                    $('#flash-message').html(data);
                        /* refresh data table in the view */
                    readAnnualLicenc(vid);      
                    $("#edit_file").val("");
                },
                error: function(xhr, textStatus, error){
                    console.log(xhr.statusText);
                }
            });     
        });

    });
    
        /* for clear previously selected file */
    $('#close_edit').on('click',function(e){
        $("#edit_file").val("");
    });
    
           /* one licence view click event */
    $(document).on('click','#view',function(e){
        var id = $(this).data('id'); //get annual licence id

        $.ajax({
            url: '/vehicle/viewAnnualLicenc/{id}',
            type: 'GET',
            data: { id: id },
            success: function(data)
            {
                    /* set values to html tag for view */  
                $('#view-title').html(data[0].vehicle_name+" ("+data[0].vehicle_reg+") "+"Annual Licence" );
                $('#period-from').html(data[0].from );
                $('#period-to').html(data[0].to ); 
                $('#licensing_authority').html(data[0].licensing_authority );  
                $('#licence_no').html(data[0].licence_no);
                $('#licence_date').html(data[0].licence_date);
                $('#amount').html(data[0].amount); 
                $('#view_emission_test_details').html(data[0].emission_test_details);

                    /* check that is there a document for licence */
                if(data[0].annual_licence_doc_id == null){
                    $('#document_view').hide(); //hide document download button
                }
                else{
                    $('#document_view').show(); //show document download button__(there is a document)
                    $('#document_download').attr("href","/"+data[0].doc_path);
                    $('#document_download').attr("download",data[0].doc_name);
                    $('#doc_name').html(data[0].doc_name);
                }
   
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
            /* one licence delete click event */
    $(document).on('click','#delete',function(e){
        var id = $(this).data('id');

        var vehicle = $( "#vid option:selected" ).text();

        $('#delete-title').html('<i class="fa fa-car"></i>'+' '+vehicle +" Annual Licence Deleting" );

        $("#delete-modal").modal('show'); 
    
        $("#btn-confirm").on("click", function(){

            $.ajax({
                url:"{{ route('annLicence.delete')}}",
                method: "POST",
                data: { id: id },
                success: function(data)
                {   
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

    // $('#pdf').on('click',function(e){
    //     e.preventDefault();
    //     showAjaxPdf('documents/licenceFile/707ffd9771de94ff24d776ba6fc7d4b3.pdf');
        
    // });

    // function showAjaxPdf(file_path)
    // {    
    //     //window.location.href = file_path;
    //     var file_path = file_path.replace(/\\/g,"/");
    //     //var file_path = 'documents/licenceFile/707ffd9771de94ff24d776ba6fc7d4b3.pdf';
    //     //9f6c7d32988603167c7cf539587a052a
    //     $.ajax({
    //         type: "POST",
    //         data: 'file_path=' + file_path,
    //         url: "/vehicle/annualLicence/test",
    //         success: function(response)
    //         {
    //             console.log(response);
    //             $('#test').val(response);

    //         },
    //         error: function(xhr, textStatus, error){
    //             console.log(xhr.statusText);
    //         }

    //     });
    // }

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


</script>
    

@endsection