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

    <div class="nav-tabs-custom">
        @include('layouts.errors')
        @include('layouts.success')
        <div class="flash-message" id="flash-message" ></div>

        <ul class="nav nav-tabs">
            <li class="active" id="tabReplacement"><a href="#replacement" data-toggle="tab"><b><i class="fa fa-circle-o-notch"></i>&nbsp Replacement</b></a></li>
            <li id="tabPositionChanges"><a href="#positionChanges" data-toggle="tab"> <b><i class="fas fa-ban"></i>&nbsp Position Changes</b> </a></li>
        </ul>
        <div class="tab-content">

            <div class="active tab-pane" id="replacement">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="number">Registration No <span class="text text-danger">*</span></label>
                            {{Form::text('registration_no',null,['class'=>'form-control','placeholder'=>'Registration Number Of The Vehicle','required'])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="count">Date of Registration</label>
                            {{Form::date('date_of_registration',null,['class'=>'form-control','placeholder'=>'Date Of Registration'])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="make_and_type">Make and Type</label>
                            {{Form::text('make_and_type',null,['class'=>'form-control','placeholder'=>'Make and Type','id'=>'txtMATOnReg'])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="chassis_no">Chassis Number</label>
                            {{Form::text('chassis_no',null,['class'=>'form-control','placeholder'=>'Chassis Number','id'=>'txtChassisNoOnReg'])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="engine_no">Engine Number</label>
                            {{Form::text('engine_no',null,['class'=>'form-control','placeholder'=>'Engine Number','id'=>'txtEngNoOnReg'])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="reg_book">Registration Book</label>
                            {{Form::file('reg_book',['id'=>'regBookInput'])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_card">Vehicle Identity Cart</label>
                            {{Form::file('id_card',['id'=>'idCardInput'])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="documents">Other Documents</label>
                            {{Form::file('documents[]',['id'=>'documentsInput','multiple'])}}
                        </div>
                        <div>
                            <table class="table table-bordered">
                                <tbody id="table">
                                </tbody>
                            </table>
                        </div>
                        <p id="file_preview"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <hr>
                            <div class="pull-right">
                                <a href="#positionChanges" data-toggle="tab"><button class="btn btn-info" id="btnNextRegistration">POSITION CHANGE </button></a>
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

            </div><!-- /.tab-Replacement -->
            
            <div class="tab-pane" id="positionChanges">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="count">Working Name </label>
                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Working Name Of The Vehicle'])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dept_no">Department Number</label>
                            {{Form::text('dept_no',null,['class'=>'form-control','placeholder'=>'Department Number'])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="perchase_price">Purchase Price</label>
                            {{Form::text('perchase_price',null,['class'=>'form-control','placeholder'=>'Purchase Price'])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_perchase">Date of Purchase</label>
                            {{Form::date('date_of_perchase',null,['class'=>'form-control','placeholder'=>'Date of Purchase'])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <hr>
                            <div class="pull-left">
                                <a href="#replacement" data-toggle="tab"><button class="btn btn-info" id="btnNextAcquisition">REPLACEMENT</button></a>
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

        $('#btnNextRegistration').on('click',function () {
            $('#tabRegistration').removeClass('active');
            $('#tabAcquisition').addClass('active');
        });

    })

</script>
    
@endsection