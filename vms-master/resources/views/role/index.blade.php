@extends('layouts.master')

@section('title', 'Privilege | Vehicle Management System')

@section('styles')

@endsection

@section('header', 'User Role Management')

@section('description', 'Managing user role.')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        @include('layouts.success')
        @include('layouts.errors')
    </div>
    <div class="col-md-8 col-md-offset-2">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Role List</h3>
                <a href="{{url('/user/role/create')}}" class="btn btn-success pull-right">Create New User Role</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">

                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <span class="hidden">{{$counter = 0}}</span>
                    @if($roles)
                        @foreach($roles as $role)
                            <span class="hidden">{{$counter++}}</span>
                            <div class="panel box box-default">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" class="{{$counter==1?'':'collapsed '}}" href="#{{$role->id}}" aria-expanded="{{$counter==1?'true':'false '}}" class="">
                                            {{$role->name}} <i class="fa fa-angle-down"></i>

                                        </a>
                                    </h4>
                                    @if($role->name!=='User')
                                        <button class="btn btn-sm btn-danger pull-right btnDeleteRole" url="{{url('/user/role/'.$role->id.'/delete')}}"><i class="fa fa-trash"></i></button>
                                    @endif
                                </div>
                                <div id="{{$role->id}}" class="panel-collapse collapse {{$counter==1?'in':''}}" aria-expanded="false" style="{{$counter==1?'':'height: 0px;'}}">
                                    <div class="box-body">
                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th>Module</th>
                                                <th>Permissions</th>
                                                <th width="100px"></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if($role->privileges)
                                                @foreach($role->privileges as $privilege)
                                                    <tr>
                                                        <td>{{$privilege->module?$privilege->module->name:'N/A'}}</td>
                                                        <td>
                                                        @foreach($privilege->permissions as $permission)
                                                           <span class="badge bg-aqua">{{$permission->name}}</span>
                                                        @endforeach
                                                        </td>
                                                        <td>
                                                            <a href="{{url('/user/role/'.$role->id.'/module/'.$privilege->module->id.'/edit')}}" class="btn btn-xs btn-success"> <i class="fa fa-edit"></i> </a>
                                                            <a href="{{url('/user/role/privilege/'.$privilege->id.'/delete')}}" class="btn btn-xs btn-danger"> <i class="fa fa-trash"></i> </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if(!count($role->privileges))
                                                <tr>
                                                    <td class="pull-right">No permissions assigned </td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                        <hr>
                                        <a href="{{url('/user/role/'.$role->id.'/module/assign')}}" class="btn btn-success btn-xs pull-right">Assign New Module</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(function () {
            $('.btnDeleteRole').on('click',function () {
                url = $(this).attr('url');
                $.confirm({
                    title: 'Confirmation!',
                    content: 'Are you sure you want to delete this role ? If there is user accounts assigned to this role, those account\'s role will be assigned to \"User\" role',
                    buttons: {
                        formSubmit: {
                            text: 'Confirm',
                            btnClass: 'btn-red',
                            action: function () {

                                window.location.replace(url);

                            }
                        },
                        cancel: function () {
                            //close
                        },
                    }
                });
            });
        })
    </script>
@endsection