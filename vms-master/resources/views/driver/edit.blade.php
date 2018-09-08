@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | DRIVER')

@section('styles')

@endsection

@section('header', 'Driver Details')

@section('description', 'Edit a existing driver.')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Editing a existing driver</h3>

                </div>
                <div class="box-header">
                    @include('layouts.errors')
                    @include('layouts.success')
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">

                    {!! Form::model($driver,['method' => 'PATCH','files'=>true,'action'=>['DriverController@update',$driver->id]]) !!}

                    {{--<div class="form-group">--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-md-6">--}}
                    {{--<label>Upload Image</label>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-md-2">--}}
                    {{--<div class="form-group">--}}
                    {{--<img id="imgVehicle" class="img-responsive pull-left"--}}
                    {{--src="{{asset('images/van.png')}}"--}}
                    {{--alt="Vehicle Sample Image"><br>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-4">--}}
                    {{--<div class="form-group">--}}
                    {{--{!! Form::label('photo', 'Vehicle Photo',['class' => 'control-label']) !!}--}}
                    {{--{{Form::file('photo',['id'=>'imgVehicleInput'])}}--}}
                    {{--<p class="help-block">Select a driver photo (max 500kb)</p>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title <span class="text text-danger">*</span></label>
                                {{Form::select('title_id',$titles,null,['class'=>'form-control','placeholder'=>'Select a Title','required'])}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">First Name <span class="text text-danger">*</span></label>
                                {{Form::text('firstname',null,['class'=>'form-control','placeholder'=>'First Name','required'])}}
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surname">Surname <span class="text text-danger">*</span></label>
                                {{Form::text('surname',null,['class'=>'form-control','placeholder'=>'Surname','required'])}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="initials">Initials <span class="text text-danger">*</span></label>
                                {{Form::text('initials',null,['class'=>'form-control','placeholder'=>'Initials','required'])}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nic">NIC Number <span class="text text-danger">*</span></label>
                                {{Form::text('nic',null,['class'=>'form-control','placeholder'=>'NIC Number','required'])}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile">Mobile Number <span class="text text-danger">*</span></label>
                                {{Form::text('mobile',null,['class'=>'form-control','placeholder'=>'Mobile Number','required'])}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="licence_no">Licence Number <span class="text text-danger">*</span></label>
                                {{Form::text('licence_no',null,['class'=>'form-control','placeholder'=>'Licence Number','required'])}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="licence_expire_date">Licence Expire Date</label>
                                {{Form::date('licence_expire_date',null,['class'=>'form-control'])}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::submit('UPDATE', ['class'=>'btn btn-success'])}}
                                {{Form::reset('RESET', ['class'=>'btn btn-warning'])}}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        //  Vehicle image loading when user select a image
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgVehicle').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(function () {
            $('#imgVehicleInput').change(function () {
                readURL(this);
            })
        });

        $(function () {
            $('#documentsInput').change(function () {
                var lenght = document.getElementById('documentsInput').files.length;
                var rows = '';
                for(var i=0;i<lenght;i++)
                {
                    var ext = document.getElementById('documentsInput').files[i].name.split('.').pop();
                    var logo = '<i class="fa fa-file-o"></i>';
                    if(ext=='doc'||ext=='docx'){
                        logo = "<i class=\"fa fa-file-word-o\"></i>";
                    }else if(ext=='pdf'){
                        logo = "<i class=\"fa fa-file-pdf-o\"></i>";
                    }
                    rows += "" +
                        "<tr>\n" +
                        "    <td>" + i + "</td>\n" +
                        "    <td>" + document.getElementById('documentsInput').files[i].name + "</td>\n" +
                        "    <td><span class=\"badge bg-red\"></span>" + logo
                        + "</td>\n" +
                        "</tr>";
                }

                $('#table').append(rows);
            })
        })
    </script>
@endsection