@extends('layouts.master')

@section('title', 'ROLE | DOOR KEY MANAGEMENT SYSTEM')

@section('styles')

@endsection

@section('header', 'Creating a new role')

@section('description', 'Creating a new role.')

@section('content')

    <div class="col-md-6 col-md-offset-3">

        <div class="">
            @include('layouts.errors')
            @include('layouts.success')
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Creating a role</h3>
                <a href="{{url('/user/roles')}}" class="btn btn-primary pull-right">Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['method' => 'post','action'=>'RoleController@store','files'=>true]) !!}
            <div class="box-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>'Role Name'])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Module</th>
                                <th>Permissions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($modules as $module)
                                    <tr>
                                        <td>{{$module->name}}</td>
                                        <td>|
                                            @foreach($module->permissions as $permission)
                                                <input type='checkbox' name='permissions[{{$module->name}}][]' value='{{$permission->id}}'>
                                                {{$permission->name}}|
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group">
                    <hr>
                    {{Form::submit('SAVE', ['class'=>'btn btn-success'])}}
                    {{Form::reset('RESET', ['class'=>'btn btn-warning'])}}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')

@endsection
