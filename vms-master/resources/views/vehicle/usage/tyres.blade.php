@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE SERVICING')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> 
        #datepicker > span:hover{cursor: pointer;color: blue;}
        #dateposition > span:hover{cursor: pointer;color: blue;} 
        #edit_replace_date > span:hover{cursor: pointer;color: blue;} 
        #edit_posChange_date > span:hover{cursor: pointer;color: blue;} 
    </style>
@endsection

@section('header', 'Vehicle Tyres')

@section('content')

    @include('layouts.errors')
    @include('layouts.success')
    <div class="flash_message" id="flash_message" ></div>

    <div class="nav-tabs-custom">

        <ul class="nav nav-tabs">
            <li class="active" id="tabReplacement"><a style="font-size:17px" href="#replacement" data-toggle="tab"><i class="fas fa-bullseye"></i> &nbsp Replacement </a></li>
            <li id="tabPositionChanges"><a style="font-size:17px"  href="#positionChanges" data-toggle="tab"> <i class="fas fa-ban"></i> &nbsp Position Changes </a></li>
        </ul>
        <div class="tab-content">

                        <!---------------- Tyre Replacement------------------->
            <div class="active tab-pane" id="replacement">

                <div class="row"> 
                    {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeTyreReplacement','files'=>true]) !!}
                    <div class="col-md-4"> 
    
                        <h4><i class="fa fa-car"></i>&nbsp Vehicle </h4>
                        <div>             
                            {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid_replacement','placeholder'=>'Select a Vehicle'])}}
                        </div>                  
                    </div>

                    <div class="col-md-1"> </div>

                    <div class="col-md-4"> 
        
                        <h4><i class="fa fa-calendar"></i>&nbsp Date </h4>
                                                            
                        <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                            <input id="date" name="date" class="form-control" type="text" readonly />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                
                    </div>   
                
                </div> <br>

                <div class="row"> 
    
                    <div class="col-md-4" > 
        
                        <h4><i class="fas fa-puzzle-piece"></i> &nbsp Position </h4>  
        
                        <div>                           
                            {{Form::select('position',array('front left' => 'Front Left','front right' => 'Front Right','back left' => 'Back Left','Back right' => 'Back Right','spare wheel'=>'Spare Wheel','4 running tyres'=>'4 Running Tyres','5 tyres'=>'5 Tyres'),null,['class'=>'form-control ','placeholder'=>'Select Tyre Position'])}}   
                                        
                        </div>
                
                    </div>                 
                    
                </div><br>

                <div class="row"> 
    
                    <div class="col-md-4"> 
    
                        <h4> <i class="fas fa-arrows-alt-h"></i> &nbsp Tyre Size </h4>  
        
                        <div>  
                            {!! Form::text('size',null,['class'=>'form-control','placeholder'=>'Size','id'=>'input_tyresize' ]) !!}                       
                        </div>                      
                    </div>

                    <div class="col-md-1"> </div>
    
                    <div class="col-md-4"> 
    
                        <h4><i class="fas fa-cube"></i> &nbsp Brand of Tyre </h4>  
        
                        <div>  
                            {!! Form::text('type',null,['class'=>'form-control','placeholder'=>'Type' ]) !!}                      
                        </div>                      
                    </div> 
    
                </div><br>
                
                <div class="row"> 
    
                    <div class="col-md-4"> 
    
                        <h4><i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading </h4>  
        
                        <div>  
                            {{Form::number('meter_reading', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Enter Meter Reading'])}}                      
                        </div>                      
                    </div>   
                </div><br>

                <div class="row"> 

                    <div class="col-md-4"> 

                        <h4><i class="fas fa-comments-dollar"></i>&nbsp Cost </h4>  
        
                        <div>  
                            {!! Form::text('cost',null,['class'=>'form-control','placeholder'=>'Cost' ]) !!}                       
                        </div>

                    </div>
    
                    <div class="col-md-1"> </div>
    
                    <div class="col-md-4"> 
    
                        <h4><i class="fas fa-cube"></i> &nbsp Invoice Number </h4>  
        
                        <div>  
                            {!! Form::text('invoice',null,['class'=>'form-control','placeholder'=>'Invoice Number' ]) !!}                      
                        </div> 
                        
                        <h4> <i class="glyphicon glyphicon-upload"></i>&nbsp Invoice File Upload &nbsp(optional)</h4>  

                        <div>
                            {{Form::file('invoice_file',['class'=>'btn btn-default'])}}  
                        
                        </div> 
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
                        <button type="submit" class="btn btn-success pull-left"> <i class="glyphicon glyphicon-arrow-up"></i>&nbsp SUBMIT </button>  &nbsp  &nbsp 
                        {{Form::reset('CLEAR', ['class'=>'btn btn-warning'])}}
                    </div>  
                </div>
                {!! Form::close() !!} 

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group"> <br>
                            <div class="pull-left">
                                <a href="#positionChanges" data-toggle="tab"><button class="btn btn-primary" id="btnNextPositionChanges"> <i class="fa fa-mail-forward"></i>&nbsp POSITION CHANGE </button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 id="table_header_replacement"style="text-align:center;display: none;"> Table Title</h3> 
                <div class="box box-primary" id="table_replacement" style="height:400px; overflow: auto; display: none;" data-target="#exampleModalCenter">
                
                    <table id="table" class="table table-sm table-hover table-sm table-striped"> 

                        <thead class="table-dark">  
                            <tr > 
                                <th scope="col"> Date </th>
                                <th scope="col"> Position</th>
                                <th scope="col"> size </th>
                                <th scope="col"> type </th>
                                <th scope="col"> Meter Reading </th>
                                <th scope="col"> Remarks</th>
                                <th scope="col"> Action</th>
                            </tr>
                        </thead>
                        <tbody id="replacement_info">

                        </tbody>
                    </table>
                
                </div>

            </div> <!-- /.tab-Replacement -->
                        
                        <!---------------- Tyre Position Change ------------------->
            <div class="tab-pane" id="positionChanges">

                <div class="row">                  

                    {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeTyrePositionChange']) !!}

                    <div>

                        <div class="col-md-4"> 

                            <h4><i class="fa fa-car"></i>&nbsp Vehicle </h4>
                            <div>             
                                {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid_position_changing','placeholder'=>'Select a Vehicle'])}}
                            </div>                  
                        </div>
        
                        <div class="col-md-1"> </div>
    
                        <div class="col-md-4"> 
                
                            <h4><i class="fa fa-calendar"></i>&nbsp Date </h4>
                                                                
                            <div id="dateposition" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="date_position" name="date" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                    
                        </div> 

                    </div>
          
                </div> <br>

                <h4><i class="fas fa-puzzle-piece"></i>&nbsp Position </h4> 
    
                <div class="row field_wrapper"> 

       
                    <div class="col-md-4">  
                        <p>&nbsp Position One Previous </p>                          
                        {{Form::select('position_one_pre',array('Front Left' => 'Front Left','Front Right' => 'Front Right','Back Left' => 'Back Left','Back Right' => 'Back Right','Spare Wheel'=>'Spare Wheel'),null,['class'=>'form-control ','placeholder'=>'Select Tyre Position','required','id'=>'input_position_one_pre'])}} <br> 
                           
                        <p>&nbsp Position Two Previous </p>                          
                        {{Form::select('position_two_pre',array('Front Left' => 'Front Left','Front Right' => 'Front Right','Back Left' => 'Back Left','Back Right' => 'Back Right','Spare Wheel'=>'Spare Wheel'),null,['class'=>'form-control ','placeholder'=>'Select Tyre Position','required','id'=>'input_position_two_pre'])}}

                    </div>
                    
                    <div class="col-md-1">    </div>
                    

                    <div class="col-md-4 ">   
                        <p>&nbsp Position One After </p> 
                        {{Form::select('position_one_after',array('Front Left' => 'Front Left','Front Right' => 'Front Right','Back Left' => 'Back Left','Back Right' => 'Back Right','Spare Wheel'=>'Spare Wheel','Exclude'=>'Exclude'),null,['class'=>'form-control ','placeholder'=>'Select Tyre Position','required','id'=>'input_position_one_after'])}}   <br> 
                        
                        <p>&nbsp Position Two After </p> 
                        {{Form::select('position_two_after',array('Front Left' => 'Front Left','Front Right' => 'Front Right','Back Left' => 'Back Left','Back Right' => 'Back Right','Spare Wheel'=>'Spare Wheel','Exclude'=>'Exclude'),null,['class'=>'form-control ','placeholder'=>'Select Tyre Position','required','id'=>'input_position_two_after'])}}   
                                     
                    </div><br> 

                    {{-- <div class="col-md-1">  
                        <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a> 
                    </div>
                    <br>  <br>  --}}
                        
                </div><br>

                <div class="row"> 
    
                    <div class="col-md-4"> 
    
                        <h4><i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading </h4>  
        
                        <div>  
                            {{Form::number('meter_reading', null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Enter Meter Reading'])}}                      
                        </div>                      
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
                        <button type="submit" class="btn btn-success pull-left"> <i class="glyphicon glyphicon-arrow-up"></i>&nbsp SUBMIT </button>  &nbsp  &nbsp 
                        {{Form::reset('CLEAR', ['class'=>'btn btn-warning'])}}
                    </div>  
                </div>
                {!! Form::close() !!} <br>
                


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="pull-left">
                                <a href="#replacement" data-toggle="tab"><button class="btn btn-primary" id="btnBackReplacement"><i class="fas fa-reply"></i> &nbsp REPLACEMENT</button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 id="table_header_positionChanges"style="text-align:center;display: none;"> Table Title</h3> 
                <div class="box box-primary" id="table_positionChanges" style="height:400px; overflow: auto; display: none;" data-target="#exampleModalCenter">
                
                    <table id="table" class="table table-sm table-hover table-sm table-striped"> 

                        <thead class="table-dark">  
                            <tr > 
                                <th scope="col"> Date </th>
                                <th scope="col"> Meter Reading</th>
                                <th scope="col"> Remarks</th>
                                <th scope="col"> Action</th>
                            </tr>
                        </thead>
                        <tbody id="positionChange_info">

                        </tbody>
                    </table>
                
                </div>
                
            </div><!-- /.tab-PositionChanges -->
            
            
        </div>
        <!-- /.tab-content -->
    </div>

        {{----------------------- Tyre Replacement Edit modal --------------------------}}
    <div class="modal fade" id="replacement_edit_modal" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="edit_replace_title"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ URL::to('/vehicle/tyreReplacement/update')}}" method="POST" id="replacement_edit" enctype="multipart/form-data">
                        {{csrf_field()}}
                    <input type="hidden" name="id" id="replacement_id">

                    <div class="row"> 

                        <div class="col-md-6"> 
            
                            <h4><i class="fa fa-calendar"></i>&nbsp Date </h4>
                                                                
                            <div id="edit_replace_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="edit_date_replace" name="date" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                    
                        </div>
                        
                        <div class="col-md-6"> 
    
                            <h4><i class="fas fa-puzzle-piece"></i>&nbsp Position </h4>  
            
                            <div>  
                                
                                {{Form::select('position',array('front left' => 'Front Left','front right' => 'Front Right','back left' => 'Back Left','Back right' => 'Back Right','spare wheel'=>'Spare Wheel','4 running tyres'=>'4 Running Tyres','5 tyres'=>'5 Tyres'),null,['class'=>'form-control ','id'=>'edit_replace_position'])}}                     
                            </div>
    
                        </div>
                        
                    </div><br>
    
                    <div class="row"> 

                        <div class="col-md-6"> 
        
                            <h4> <i class="fas fa-arrows-alt-h"></i> &nbsp Tyre Size </h4>  
            
                            <div>  
                                {!! Form::text('size',null,['class'=>'form-control','id'=>'edit_replace_size' ]) !!}                       
                            </div>                      
                        </div>
        
                        <div class="col-md-6"> 
        
                            <h4><i class="fas fa-cube"></i> &nbsp Tyre Type/Mode </h4>  
            
                            <div>  
                                {!! Form::text('type',null,['class'=>'form-control','id'=>'edit_replace_type' ]) !!}                      
                            </div>                      
                        </div> 
        
                    </div><br>
                    
                    <div class="row"> 
        
                        <div class="col-md-6"> 
        
                            <h4><i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading </h4>  
            
                            <div>  
                                {{Form::number('meter_reading', null,['class'=>'form-control ','id'=>'edit_replace_meter_reading'])}}                      
                            </div>                      
                        </div>   
                    </div><br>

                    <div class="row"> 

                        <div class="col-md-4"> 
    
                            <h4><i class="fas fa-puzzle-piece"></i>&nbsp Cost </h4>  
            
                            <div>  
                                {!! Form::text('cost',null,['class'=>'form-control','placeholder'=>'Cost','id'=>'edit_cost' ]) !!}                       
                            </div>
    
                        </div>
        
                        <div class="col-md-2"> 
        
                                                
                        </div>
        
                        <div class="col-md-4"> 
        
                            <h4><i class="fas fa-cube"></i> &nbsp Invoice </h4>  
            
                            <div>  
                                {!! Form::text('invoice',null,['class'=>'form-control','placeholder'=>'Invoice Number','id'=>'edit_invoice' ]) !!}                      
                            </div>   

                            <h4> <i class="glyphicon glyphicon-upload"></i>&nbsp Invoice File Upload &nbsp(Optinal)</h4> 
                            <div>
                                <input type="file" name="invoice_file" class="btn btn-default" id="edit_invoice_file" > <br>
                            </div> 

                        </div> 
        
                    </div><br>
    
                    <div class="row"> 
        
                        <div class="col-md-6"> 
        
                            <h4> <i class="fas fa-align-justify"></i> &nbsp Remarks </h4>  
            
                            <div>  
                                {!! Form::textarea('remarks',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2','id'=>'edit_replace_remarks'  ]) !!}                      
                            </div>                      
                        </div>  
    
                    </div><br>
                                            
                                        
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success active" id="update"><i class="glyphicon glyphicon-arrow-up"></i>&nbspUpdate</button>
                    {!! Form::close() !!} 
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="close_edit" >Close</button>
                </div>
            </div>
        </div>
    </div>

        {{----------------------- Tyre Position changing Edit modal --------------------------}}
    <div class="modal fade" id="PositionChange_edit_modal" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="edit_posChange_title"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{ URL::to('/vehicle/tyrePositionChange/update')}}" method="POST" id="PositionChange_edit">
                        {{csrf_field()}}
                    <input type="hidden" name="id" id="PositionChange_id">

                    <div class="row"> 

                        <div class="col-md-6"> 
            
                            <h4><i class="fa fa-calendar"></i>&nbsp Date </h4>
                                                                
                            <div id="edit_posChange_date" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="edit_date_posChange" name="date" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                    
                        </div>
                           
                    </div><br>

                    <h4><i class="fas fa-puzzle-piece"></i>&nbsp Position </h4> 
                    <div class="row"> 

                        <div class="col-md-4 ">  
                            <p>&nbsp Position One Previous </p>                          
                            {{Form::select('position_one_pre',array('front left' => 'Front Left','front right' => 'Front Right','back left' => 'Back Left','Back right' => 'Back Right','spare wheel'=>'Spare Wheel'),null,['class'=>'form-control ','id'=>'edit_pos_one_pre'])}} <br> 
                                
                            <p id="pre_two_id">&nbsp Position Two Previous </p>                          
                            {{Form::select('position_two_pre',array('front left' => 'Front Left','front right' => 'Front Right','back left' => 'Back Left','Back right' => 'Back Right','spare wheel'=>'Spare Wheel'),null,['class'=>'form-control ','id'=>'edit_pos_two_pre','placeholder'=>'Select Tyre Position'])}}
    
                        </div>
                        
                        <div class="col-md-1">    </div>
                        
    
                        <div class="col-md-4 ">   
                            <p>&nbsp Position One After </p> 
                            {{Form::select('position_one_after',array('front left' => 'Front Left','front right' => 'Front Right','back left' => 'Back Left','Back right' => 'Back Right','spare wheel'=>'Spare Wheel','exclude'=>'Exclude'),null,['class'=>'form-control ','id'=>'edit_pos_one_after'])}}   <br> 
                            
                            <p id="after_two_id">&nbsp Position Two After </p> 
                            {{Form::select('position_two_after',array('front left' => 'Front Left','front right' => 'Front Right','back left' => 'Back Left','Back right' => 'Back Right','spare wheel'=>'Spare Wheel','exclude'=>'Exclude'),null,['class'=>'form-control ','id'=>'edit_pos_two_after','placeholder'=>'Select Tyre Position'])}}   
                                            
                        </div><br> 
                        
                    </div><br>
                    
                    <div class="row"> 
        
                        <div class="col-md-6"> 
        
                            <h4><i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading </h4>  
            
                            <div>  
                                {{Form::number('meter_reading', null,['class'=>'form-control ','id'=>'edit_posChange_meter_reading'])}}                      
                            </div>                      
                        </div> 

                    </div><br>
    
                    <div class="row"> 
        
                        <div class="col-md-6"> 
        
                            <h4> <i class="fas fa-align-justify"></i> &nbsp Remarks </h4>  
            
                            <div>  
                                {!! Form::textarea('remarks',null,['class'=>'form-control','rows'=>'2','id'=>'edit_posChange_remarks'  ]) !!}                      
                            </div>                      
                        </div>  
    
                    </div><br>
                   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success active" id="update"> <i class="glyphicon glyphicon-arrow-up"></i>&nbsp Update</button>
                    {!! Form::close() !!} 
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="close_edit" >Close</button>
                </div>
            </div>
        </div>
    </div>

                {{----------------------- Tyre Replacement Delete Confirmation modal --------------------------}}
    <div class="modal fade" id="replacement_delete_modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <b> <h3 class="modal-title" id="delete_replace_title"></h3> </b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="modal-title" >Please Confirm Your Delete Action</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="replacement_delete_confirm"> <i class="fa fa-trash"></i>&nbsp Delete</button>
                <button type="button" class="btn btn-primary active" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
    </div>

                {{----------------------- Tyre Position Changing Delete Confirmation modal --------------------------}}
    <div class="modal fade" id="posChange_delete_modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <b> <h3 class="modal-title" id="delete_posChange_title"></h3> </b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="modal-title" >Please Confirm Your Delete Action</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="posChange_delete_confirm"> <i class="fa fa-trash"></i>&nbsp Delete</button>
                <button type="button" class="btn btn-primary active" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
    </div>

                {{----------------------- Tyre Replacement View modal --------------------------}}
    <div class="modal fade" id="view_modal_replace" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
    
                        <i style="font-size:25px; color:gray" class="fa fa-car"></i>&nbsp  <label class="modal-title" id="view_title_replace" style="font-size:25px; color:gray;"> </label> 
    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
    
                            <div class="row"> 

                                    <div class="col-md-6"> 
                        
                                        <h4><i class="fa fa-calendar"></i>&nbsp Date </h4>
                                                                            
                                        <p class="col-md-offset-2" id="view_replace_date"> </p>   
                                
                                    </div>
                                    
                                    <div class="col-md-6"> 
                
                                        <h4><i class="fas fa-puzzle-piece"></i>&nbsp Position </h4>  
                        
                                        <p class="col-md-offset-2" id="view_replace_position"> </p>   
                
                                    </div>
                                    
                                </div><br>
                
                                <div class="row"> 
            
                                    <div class="col-md-6"> 
                    
                                        <h4> <i class="fas fa-arrows-alt-h"></i> &nbsp Tyre Size </h4>  
                        
                                        <p class="col-md-offset-2" id="view_replace_size"> </p>   

                                    </div>
                    
                                    <div class="col-md-6"> 
                    
                                        <h4><i class="fas fa-cube"></i> &nbsp Brand of Tyre </h4>  
                        
                                        <p class="col-md-offset-2" id="view_replace_type"> </p>                        
                                    </div> 
                    
                                </div><br>
                                
                                <div class="row"> 
                    
                                    <div class="col-md-6"> 
                    
                                        <h4><i class="fas fa-tachometer-alt"></i>&nbsp Meter Reading </h4>  
                        
                                        <p class="col-md-offset-2" id="view_replace_meter_reading"> </p>   

                                    </div>   
                                </div><br>
            
                                <div class="row"> 

                                    <div class="col-md-4"> 
                
                                        <h4><i class="fas fa-cube"></i> &nbsp Invoice Number</h4>  
                        
                                        <p class="col-md-offset-2" id="view_replace_invoice"> </p>    
             
                                        <div id="document_view" >
                                            
                                            <a class="col-md-offset-2" href="" download="" id ="document_download"> 
                                                <button type="button" class="btn btn-success btn-md">
                                                    <i class="glyphicon glyphicon-download-alt"></i>&nbsp <i id="doc_name"></i>
                                                </button>
                                            </a>
                                        </div>
            
                                    </div> 

                                    <div class="col-md-2">                     
                                    </div>
            
                                    <div class="col-md-4"> 
                
                                        <h4><i class="fas fa-comments-dollar"></i>&nbsp Cost </h4>  
                        
                                        <p class="col-md-offset-2" id="view_replace_cost"> </p>   
                
                                    </div>                                  
                    
                                </div><br>
                
                                <div class="row"> 
                    
                                    <div class="col-md-6"> 
                    
                                        <h4> <i class="fas fa-align-justify"></i> &nbsp Remarks </h4>  
                        
                                        <p class="col-md-offset-2" id="view_replace_remarks"> </p>                     
                                    </div>  
                
                                </div><br>
    
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
<script src="{{asset('js/jscolor.js')}}"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function readTyreReplacement(vid){ 
        
        $.ajax({
            url: '/vehicle/readTyreReplacement/{id}',
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {
                //console.log(data);   
                $('#replacement_info').empty().html(data);           
                
            }
        });
    } 

    var pos1;
    var previous1;

    function positionHideOne(){

        if(previous1 != null){
            $("#input_position_one_after option[value='"+previous1+"']").show();
        }
        pos1 = $('#input_position_one_pre').val();
        
        console.log(pos1);  
        $("#input_position_one_after option[value='"+pos1+"']").hide();

        previous1 = pos1;

    }

    $('#input_position_one_pre').on('change',function () {

        positionHideOne();
        
    });

    var pos2;
    var previous2;

    function positionHideSecond(){

        if(previous2 != null){
            $("#input_position_two_after option[value='"+previous2+"']").show();
        }
        pos2 = $('#input_position_two_pre').val();

        console.log(pos2);  
        $("#input_position_two_after option[value='"+pos2+"']").hide();

        previous2 = pos2;

    }

    $('#input_position_two_pre').on('change',function () {

        positionHideSecond();

    });

    $('#input_position_one_after').on('change',function () {

        after1 = $(this).val();
        $('#input_position_two_pre').val(after1);

        positionHideSecond();
        
    });

        /* View Tyre Replacement on the table*/
    $('#vid_replacement').on('change',function () {
        var vid = $(this).val();
        var vehicle = $( "#vid_replacement option:selected" ).text();

        $.ajax({
            url: '/vehicle/vehicleTyre/{id}',
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {
                console.log(data[0].tyres_size_front);   
                $('#input_tyresize').val(data[0].tyres_size_front);                    
                
            }
        });
        
        $('#table_header_replacement').html('<i class="fa fa-car"></i>'+' '+vehicle+" Vehicle Tyre Replacement History");
        $('#table_header_replacement').show();

        readTyreReplacement(vid); 
        $('#table_replacement').show();   



    });
        
    function readTyrePositionChanges(vid){ 
        
        $.ajax({
            url: '/vehicle/readTyrePositionChanges/{id}',
            type: 'GET',
            data: { id: vid },
            success: function(data)
            {
                //console.log(data);   
                $('#positionChange_info').empty().html(data);           
                
            }
        });
    }

        /* View Tyre Position Changing on the table*/
    $('#vid_position_changing').on('change',function () {
        var vid = $(this).val();
        var vehicle = $( "#vid_position_changing option:selected" ).text();
        
        $('#table_header_positionChanges').html('<i class="fa fa-car"></i>'+' '+vehicle+" Vehicle Tyre Position Changed History");
        $('#table_header_positionChanges').show();

        readTyrePositionChanges(vid); 
        $('#table_positionChanges').show();    

    });

        /* Editing Tyre Replacement */
    $(document).on('click','#edit_replace',function(e){
        var id = $(this).data('id');
        var vid;
        $('#replacement_id').val(id);

           /* getting existing data to modal */
        $.ajax({
            url: '/vehicle/viewTyreReplacement/{id}',
            type: 'GET',
            data: { id: id },
            success: function(data)
            {    
                vid =data[0].vehical_id;

                $('#edit_replace_title').html('<i class="fa fa-car"></i>'+' '+data[0].vehicle_name+" ( "+data[0].vehicle_reg+" ) "+" Tyre Replacement Editing" ); 
                $('#edit_date_replace').val(data[0].date);
                $('#edit_replace_position').val(data[0].position);
                $('#edit_replace_meter_reading').val(data[0].meter_reading);
                $('#edit_replace_size').val(data[0].size);
                $('#edit_replace_type').val(data[0].type);
                $('#edit_cost').val(data[0].cost);
                $('#edit_invoice').val(data[0].invoice); 
                $('#edit_replace_remarks').val(data[0].remarks);
   
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
            }
        });

        $("#replacement_edit_modal").modal('show');

        $('#replacement_edit').on('submit',function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            //var data = $(this).serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: new FormData(this),
                cache:false,
                contentType:false,
                processData:false,
                success: function(data)
                {           
                    $('#replacement_edit_modal').modal('hide');  
                    $('#flash_message').html(data);
                        /* refresh data table in the view */
                    readTyreReplacement(vid);    

                    $("#edit_invoice_file").val("");  
                },
                error: function(xhr, textStatus, error){
                    console.log(xhr.statusText);
                }
            });     
        });

    });

        /* one Tyre Replacement view click event */
    $(document).on('click','#view_replace',function(e){
        var id = $(this).data('id'); //get annual licence id

        $.ajax({
            url: '/vehicle/viewTyreReplacement/{id}',
            type: 'GET',
            data: { id: id },
            success: function(data)
            {
                console.log(data);
                    /* set values to html tag for view */  
                $('#view_title_replace').html(data[0].vehicle_name+" ("+data[0].vehicle_reg+") "+"Tyre" );
                $('#view_replace_date').html(data[0].date);
                $('#view_replace_position').html(data[0].position);  
                $('#view_replace_size').html(data[0].size);
                $('#view_replace_type').html(data[0].type);
                $('#view_replace_meter_reading').html(data[0].meter_reading); 
                $('#view_replace_invoice').html(data[0].invoice);
                $('#view_replace_cost').html(data[0].cost);
                $('#view_replace_remarks').html(data[0].remarks);

                    /* check that is there a document for licence */
                if(data[0].tyre_replace_doc_id == null){
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
        $("#view_modal_replace").modal('show');

    });

        /* Editing Tyre Position Changing */
    $(document).on('click','#edit_posChange',function(e){
        var id = $(this).data('id');
        var vid;
        $('#PositionChange_id').val(id);

           /* getting existing data to modal */
        $.ajax({
            url: '/vehicle/viewTyrePositionChange/{id}',
            type: 'GET',
            data: { id: id },
            success: function(data)
            {    
                vid =data[0].vehical_id;

                $('#edit_posChange_title').html('<i class="fa fa-car"></i>'+' '+data[0].vehicle_name+" ( "+data[0].vehicle_reg+" ) "+" Tyre Position Changed Editing" ); 
                $('#edit_date_posChange').val(data[0].date);

                $('#edit_pos_one_pre').val(data[0].position_one_pre);
                $('#edit_pos_one_after').val(data[0].position_one_after);

                if(data[0].position_two_pre != null){
                    $('#edit_pos_two_pre').val(data[0].position_two_pre);
                }
                if(data[0].position_two_after != null){
                    $('#edit_pos_two_after').val(data[0].position_two_after);
                }
                
                $('#edit_posChange_meter_reading').val(data[0].meter_reading);
                $('#edit_posChange_remarks').val(data[0].remarks);
   
            },
            error: function(xhr, textStatus, error){
                console.log(xhr.statusText);
            }
        });

        $("#PositionChange_edit_modal").modal('show');

        $('#PositionChange_edit').on('submit',function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(data)
                {          
                    $('#PositionChange_edit_modal').modal('hide');  
                    $('#flash_message').html(data);
                        /* refresh data table in the view */
                    readTyrePositionChanges(vid);      
                },
                error: function(xhr, textStatus, error){
                    console.log(xhr.statusText);
                }
            });     
        });

    });

    $(document).on('click','#delete_replace',function(e){
        var id = $(this).data('id');

        var vehicle = $( "#vid_replacement option:selected" ).text();

        $('#delete_replace_title').html('<i class="fa fa-car"></i>'+' '+vehicle +" Vehicle Service Deleting" );

        $("#replacement_delete_modal").modal('show'); 
    
        $("#replacement_delete_confirm").on("click", function(){

            $.ajax({
                url:"{{ route('tyreReplacement.delete')}}",
                method: "POST",
                data: { id: id },
                success: function(data)
                {
                    $('#flash_message').html(data); 
    
                    $('tr#replace'+id).remove();
                    $('#replacement_delete_modal').modal('hide');
                },
                error: function(xhr, textStatus, error){
                    console.log(error);
                }
            });

        });
 
    });

    $(document).on('click','#delete_posChange',function(e){
        var id = $(this).data('id');

        var vehicle = $( "#vid_position_changing option:selected" ).text();

        $('#delete_posChange_title').html('<i class="fa fa-car"></i>'+' '+vehicle +" Vehicle Service Deleting" );

        $("#posChange_delete_modal").modal('show'); 
    
        $("#posChange_delete_confirm").on("click", function(){

            $.ajax({
                url:"{{ route('posChange.delete')}}",
                method: "POST",
                data: { id: id },
                success: function(data)
                {   
                    $('#flash_message').html(data); 
    
                    $('tr#posChange'+id).remove();
                    $('#posChange_delete_modal').modal('hide');
                },
                error: function(xhr, textStatus, error){
                    console.log(error);
                }
            });

        });
 
    });


</script>

<script>

    $("#datepicker").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $("#dateposition").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $("#edit_replace_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }); 

    $("#edit_posChange_date").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $(function () {

        $('#btnNextPositionChanges').on('click',function () {
            $('#tabReplacement').removeClass('active');
            $('#tabPositionChanges').addClass('active');
        });

        $('#btnBackReplacement').on('click',function () {
            $('#tabPositionChanges').removeClass('active');
            $('#tabReplacement').addClass('active');
        });

    })

</script>

{{-- <script type="text/javascript">

    $(document).ready(function(){
        var maxField = 5; 
        var addButton = $('.add_button'); 
        var wrapper = $('.field_wrapper'); 
        //var fieldHTML = '<div><input type="text" name="field_name[]" value=""/> &nbsp <a href="javascript:void(0);" class="remove_button"><i class="fa fa-trash" aria-hidden="true"></i></a></div>'; //New input field html 
        //{{Form::select('position',array('front left' => 'Front Left','front right' => 'Front Right','back left' => 'Back Left','Back right' => 'Back Right','spare wheel'=>'Spare Wheel','4 running tyres'=>'4 Running Tyres','5 tyres'=>'5 Tyres'),null,['class'=>'form-control ','placeholder'=>'Select Tyre Position'])}} 
        var fieldHTML = '<div><div class="col-md-4"><select name="position_prev" class="form-control">'+
            '<option value="front left">Front Left</option>'+
            '<option value="front right">Front Right</option>'+
            '<option value="back left">back left</option>'+
            '<option value="back right">back Right</option>'+
            '<option value="spare wheel">Spare Wheel</option>'+ 
            '</select> </div>'+
            '<div class="col-md-1"></div>'+
            '<div class="col-md-4"><select name="position_after" class="form-control">'+
            '<option value="front left">Front Left</option>'+
            '<option value="front right">Front Right</option>'+
            '<option value="back left">back left</option>'+
            '<option value="back right">back Right</option>'+
            '<option value="spare wheel">Spare Wheel</option>'+ 
            '</select></div>'+
            '&nbsp <a href="javascript:void(0);" class="remove_button"><i class="fa fa-trash" aria-hidden="true"></i></a> <div> <br>';
        var x = 1; 
        
        //Once add button is clicked
        $(addButton).click(function(){
            
            if(x < maxField){ 
                x++; 
                $(wrapper).append(fieldHTML); 
            }
        });
        
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); 
            x--;
        });
    });
    
</script> --}}
    
    
@endsection