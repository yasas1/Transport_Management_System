@extends('layouts.master')

@section('title', 'User | Vehicle Management System')

@section('styles')

@endsection

@section('header', 'User Account Management')

@section('description', 'Change user account details.')

@section('content')
    <div class="col col-sm-8 col-md-offset-2">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit user account</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @include('layouts.errors')
            @if(session('success'))
                <div class="box-body">
                    <div class="alert alert-success alert-dismissable fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{session('success')}}
                    </div>
                </div>
            @endif
            <div class="box-body">



                <div class="row">
                    <div class="col-md-6">
                        <dl class="dl-horizontal">
                            <dt>
                                @if($user->avatar)
                                    {!! '<img height="80px" src="'.$user->avatar.'" alt="">' !!}
                                @endif
                            </dt>
                            <dd></dd>
                            <br>
                            <dt class="text-light-blue">User Name : </dt>
                            <dd>{{$user->name}}</dd>
                            <dt class="text-light-blue">Email : </dt>
                            <dd>{{$user->email}}@ucsc.cmb.ac.lk</dd>
                            <dt class="text-light-blue">Role : </dt>
                            <dd>{{$user->role->name}}</dd>
                            <dt class="text-light-blue">Status of the Account: </dt>
                            <dd>
                                @if($user->is_active)
                                    @if($user->is_active=='1')
                                        {!! '<span class="badge bg-green">Active</span>' !!}
                                    @else
                                        {!! '<span class="badge bg-orange">Not Active</span>' !!}
                                    @endif
                                @endif
                            </dd>
                        </dl>
                    </div>
                </div>


                {!! Form::model($user,['method' => 'PATCH','action'=>'UserController@update']) !!}

                <div class="form-group">
                    {{Form::hidden('id')}}
                    <label for="is_active">Status of The Account</label>
                    {{Form::select('is_active',array(1=>'Active',2=>'Not Active'),null,['class'=>'form-control','placeholder'=>'Select a Status','required'])}}
                </div>

                <div class="form-group">
                    <label for="role_id">Role</label>
                    {{Form::select('role_id',$roles,null,['class'=>'form-control','placeholder'=>'Select a Role','required'])}}
                </div>

                <div class="form-group">
                    {{Form::submit('Update', ['class'=>'btn btn-success'])}}
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection