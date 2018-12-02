@extends('layouts.master')

@section('title', 'User | Vehicle Management System')

@section('styles')

@endsection

@section('header', 'User Account Management')

@section('Description', 'Creating new user account.')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        @include('layouts.errors')
    </div>
    @if(session('success'))
        <div class="box-body col-md-8 col-md-offset-2">
            <div class="alert alert-success alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{session('success')}}
            </div>
        </div>
    @endif

   <div class="col col-sm-8 col-md-offset-2">
       <div class="box box-primary">
           <div class="box-header with-border">
               <h3 class="box-title">Creating a new user account</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <div class="box-body">

               {!! Form::open(['method' => 'post','action'=>'UserController@store']) !!}

               <label for="email">Email</label>
               <div class="input-group">
                   {{Form::text('email',null,['class'=>'form-control','placeholder'=>'XXX','required'])}}
                   <span class="input-group-addon">
                       @ucsc.cmb.ac.lk
                    </span>
               </div>
               <br>

               <div class="form-group">
                   <label for="is_active">Status of The Account</label>
                   {{Form::select('is_active',array(1=>'Active',2=>'Not Active'),null,['class'=>'form-control','placeholder'=>'Select a Status','required'])}}
               </div>

               <div class="form-group">
                   <label for="role_id">Role</label>
                   {{Form::select('role_id',$roles,null,['class'=>'form-control','placeholder'=>'Select a Role','required'])}}
               </div>

               <div class="form-group">
                   {{Form::submit('Create', ['class'=>'btn btn-success'])}}
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