@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE SERVICING')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style> 
        #datepicker > span:hover{cursor: pointer;color: blue;}
        #edit_date > span:hover{cursor: pointer;color: blue;}
    </style>
@endsection

@section('header', 'Vehicle Tyres')

@section('content')

    @include('layouts.errors')
    @include('layouts.success')
    <div class="flash-message" id="flash-message" ></div>

    <div class="nav-tabs-custom">

        <ul class="nav nav-tabs">
            <li class="active" id="tabReplacement"><a href="#replacement" data-toggle="tab"><b> <i class="fas fa-bullseye"></i> &nbsp Replacement</b></a></li>
            <li id="tabPositionChanges"><a href="#positionChanges" data-toggle="tab"> <b><i class="fas fa-ban"></i>&nbsp Position Changes</b> </a></li>
        </ul>
        <div class="tab-content">

            <div class="active tab-pane" id="replacement">

                <div class="row"> 
                        {!! Form::open(['method' => 'post','action'=>'VehicleUsageController@storeTyreReplacement']) !!}
                        <div class="col-md-4"> 
        
                            <h4><i class="fa fa-car"></i>&nbsp Vehicle </h4>
                            <div>             
                                {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                            </div>                  
                        </div>
                        <div class="col-md-2"> </div>
            
                        
        
                    </div> <br>
        
                    <div class="row"> 
        
                        <div class="col-md-4"> 
            
                            <h4><i class="fa fa-calendar"></i>&nbsp Date </h4>
                                                                
                            <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input id="date" name="date" class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                    
                        </div>                 
                        
                    </div><br>

                    <div class="row"> 

                        <div class="col-md-4"> 
    
                            <h4><i class="fas fa-puzzle-piece"></i>&nbsp Position </h4>  
            
                            <div>  
                                {!! Form::text('position',null,['class'=>'form-control','placeholder'=>'Position' ]) !!}                       
                            </div>

                        </div>
        
                        <div class="col-md-4"> 
        
                            <h4> <i class="fas fa-arrows-alt-h"></i> &nbsp Size </h4>  
            
                            <div>  
                                {!! Form::text('size',null,['class'=>'form-control','placeholder'=>'Size' ]) !!}                       
                            </div>                      
                        </div>
        
                        <div class="col-md-4"> 
        
                            <h4><i class="fas fa-cube"></i> &nbsp Type </h4>  
            
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
        
                            <h4> <i class="fas fa-align-justify"></i> &nbsp Remarks </h4>  
            
                            <div>  
                                {!! Form::textarea('remarks',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2'  ]) !!}                      
                            </div>                      
                        </div>  

                    </div><br>

                    <div class="row"> 
        
                        <div class="col-md-4"> 
                            {{Form::submit('SUBMIT', ['class'=>'btn btn-success pull-left'])}} &nbsp
                            {{Form::reset('CLEAR', ['class'=>'btn btn-warning'])}}
                        </div>  
                    </div>
                    {!! Form::close() !!} <br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <hr>
                            <div class="pull-right">
                                <a href="#positionChanges" data-toggle="tab"><button class="btn btn-info" id="btnNextPositionChanges">POSITION CHANGE </button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 id="table_header_replacement"style="text-align:center;display: none;"> Table Title</h3> 
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
                        <tbody id="replacement_info">

                        </tbody>
                    </table>
                
                </div>

            </div> <!-- /.tab-Replacement -->
            
            <div class="tab-pane" id="positionChanges">
                


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <hr>
                            <div class="pull-left">
                                <a href="#replacement" data-toggle="tab"><button class="btn btn-info" id="btnBackReplacement">REPLACEMENT</button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 id="table_header_positionChanges"style="text-align:center;display: none;"> Table Title</h3> 
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
                        <tbody id="positionChange_info">

                        </tbody>
                    </table>
                
                </div>
                
            </div><!-- /.tab-PositionChanges -->
            
            
        </div>
        <!-- /.tab-content -->
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
    
@endsection