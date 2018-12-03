@extends('layouts.master')

@section('title', 'Key Management | User')

@section('styles')

@endsection

@section('header', 'User Account Management')

@section('description', 'Change user account details.')

@section('content')
    <div class="col col-sm-6 col-md-offset-3">
        @include('layouts.errors')
        @if(session('success'))
            <div class="box-body">
                <div class="alert alert-success alert-dismissable fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> {{session('success')}}
                </div>
            </div>
        @endif
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit user account</h3>
                <a href="{{url('/user/')}}" class="btn btn-primary pull-right">Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <div class="box-body">

                {!! Form::model($user,['method' => 'PATCH','action'=>'UserController@update']) !!}

                <dl class="dl-horizontal">
                    <dt>
                        @if($user->avatar)
                            {!! '<img height="80px" src="'.$user->avatar.'" alt="">' !!}
                        @endif
                    </dt>
                    <dd></dd>
                    <br>
                    <dt>Email : </dt>
                    <dd>{{$user->employee->emp_email}}@ucsc.cmb.ac.lk</dd>
                    <dt>User Name : </dt>
                    <dd>{{$user->employee->shortName}}</dd>
                    <dt>Role : </dt>
                    <dd>{{$user->role->name}}</dd>
                    <dt>Status of the Account: </dt>
                    <dd>
                        @if($user->employee->emp_state)
                            @if($user->employee->emp_state=='active')
                                {!! '<span class="badge bg-green">Active</span>' !!}
                            @else
                                {!! '<span class="badge bg-orange">Not Active</span>' !!}
                            @endif
                        @endif
                    </dd>
                </dl>

                <div class="form-group">
                    {{Form::hidden('emp_id',$user->emp_id)}}
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