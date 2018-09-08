@extends('layouts.master')

@section('title', 'User | Vehicle Management System')

@section('styles')

@endsection

@section('header', 'User Account Management')

@section('description', 'Assigning new user module to a existing role.')

@section('content')
    <div class="col col-sm-6 col-md-offset-3">
        @include('layouts.errors')
    </div>
    @if(session('success'))
        <div class="box-body col col-sm-6 col-md-offset-3">
            <div class="alert alert-success alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> {{session('success')}}
            </div>
        </div>
    @endif

    <div class="col col-sm-6 col-md-offset-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Assigning new user module to {{$role->name}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['method' => 'post','action'=>'RoleController@storeNewModule']) !!}

                        {{Form::hidden('role_id', $role->id)}}

                        <div class="form-group col-md-6">
                            <label for="module_id">Module</label>
                            <select class="form-control" required="" name="module_id" id="cmbModule">
                                <option selected="selected" value="" url="{{url('/user/role/module/0/permissions')}}">Select a Module</option>
                                @if($modules)
                                    @foreach($modules as $module)
                                        <option value="{{$module->id}}" url="{{url('/user/role/module/'.$module->id.'/permissions')}}" >{{$module->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-12">
                            <p class="lead">Select permissions for {{$role->name}}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tbody id="tblPermissions">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group col-md-12 ">
                            {{Form::submit('Add Module', ['class'=>'btn btn-success pull-right'])}}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>

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

    <script>
        $(function () {
            $('#cmbModule').on('change',function () {
                var url = $( "#cmbModule").find("option:selected").attr('url');
                $.ajax({
                    method:'GET',
                    url:url,
                    success: function (data) {
                        console.log(data);
                        var html = '';
                        $(data).each(function (index,a) {
                            html+=  "<tr>\n" +
                                    "<th style=\"width:50%\">"+a.name+"</th>\n" +
                                    "<td>"+"<input type='checkbox' name='permission_ids[]' value='"+a.id+"'>"+"</td>\n" +
                                    "</tr>";
                        });
                        $('#tblPermissions').html(html);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                })
            })
        })
    </script>
@endsection