@extends('layouts.master')

@section('title', 'Vehicle Management | User')

@section('styles')

@endsection

@section('header', 'User Account Management')

@section('description', 'Managing user accounts.')

@section('content')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Current Users List</h3>
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
                    <th>Designation</th>
                    <th>Division</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status of the account</th>
                    @if(Auth::user()->canUpdateUser())
                        <th width="20px"></th>
                    @endif
                </tr>
                </thead>
                <tbody>

                @if($users)
                    @foreach($users as $user)
                        <tr>
                            <td>
                                @if($user->user && $user->user->avatar)
                                    {!! '<img height="40px" src="'.$user->user->avatar.'" alt="">' !!}
                                @elseif($user->emp_gender === 'male')
                                    <img height="40px" src="img/user/male.jpg" alt="">
                                @elseif($user->emp_gender === 'female')
                                    <img height="40px" src="img/user/female.jpg" alt="">
                                @endif
                            </td>
                            <td>{{$user?$user->shortName:'N/A'}}</td>
                            <td>{{$user->designation?$user->designation->des_name:''}}</td>
                            <td>{{$user->division?$user->division->dept_name:''}}</td>
                            <td>{{$user->emp_email?$user->emp_email.'@ucsc.cmb.ac.lk':''}}</td>
                            <td>{{$user->user?$user->user->role->name:'User'}}</td>
                            <td>
                                @if($user->emp_state)
                                    @if($user->emp_state=='active')
                                        {!! '<span class="badge bg-green">Active</span>' !!}
                                    @else
                                        {!! '<span class="badge bg-orange">Not Active</span>' !!}
                                    @endif
                                @endif
                            </td>

                            @if(Auth::user()->canUpdateUser())
                                <td><a href="{{url('/user/'.$user->emp_id.'/edit')}}" class="btn btn-primary">Edit</a></td>
                            @endif

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
        $(document).ready(function() {
            $('.table').DataTable();
        } );
    </script>
@endsection