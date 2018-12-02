@extends('layouts.master')

@section('title', 'User | Vehicle Management System')

@section('styles')

@endsection

@section('header', 'User Account Management')

@section('description', 'Managing user accounts.')

@section('content')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Current Users List</h3>
            <a href="{{url('/user/create')}}" class="btn btn-success pull-right">Create New User</a>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        @include('layouts.success')
        @include('layouts.errors')
        <div class="box-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Photo</th>
                    <th>User Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Status of the account</th>
                    <th width="20px"></th>
                </tr>
                </thead>
                <tbody>

                @if($users)
                    @foreach($users as $user)
                        <tr>
                            <td>
                                @if($user->avatar)
                                    {!! '<img height="40px" src="'.$user->avatar.'" alt="">' !!}
                                @endif
                            </td>
                            <td>{{$user->name?$user->name:'N/A'}}</td>
                            <td>{{$user->role?$user->role->name:''}}</td>
                            <td>{{$user->email?$user->email.'@ucsc.cmb.ac.lk':''}}</td>
                            <td>
                                @if($user->is_active)
                                    @if($user->is_active=='1')
                                        {!! '<span class="badge bg-green">Active</span>' !!}
                                    @else
                                        {!! '<span class="badge bg-orange">Not Active</span>' !!}
                                    @endif
                                @endif
                            </td>

                            <td><a href="{{url('/user/'.$user->id.'/edit')}}" class="btn btn-success">Edit</a></td>

                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>
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