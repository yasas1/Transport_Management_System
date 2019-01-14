@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | DRIVER')

@section('styles')

@endsection

@section('header', 'View Drivers')

@section('description', 'View existing drivers.')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Existing Drivers List</h3>

        </div>
        <div class="box-header">
            @include('layouts.errors')
            @include('layouts.success')
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
            @if($drivers)
                <table class="table" id="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>NIC Number</th>
                        <th>Mobile Number</th>
                        <th>Licence Number</th>
                        <th>Licence Expire Date</th>
                        <th width="150px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($drivers as $driver)
                        <tr>
                            <td>{{$driver->initials?$driver->initials.' '.$driver->surname:'N/A'}}</td>
                            <td>{{$driver->nic?$driver->nic:'N/A'}}</td>
                            <td>{{$driver->mobile?$driver->mobile:'N/A'}}</td>
                            <td>{{$driver->licence_no?$driver->licence_no:'N/A'}}</td>
                            <td>{{$driver->licence_expire_date?$driver->licence_expire_date->formatLocalized('%d %B %Y'):'N/A'}}</td>
                            <td width="150px">
                                <button id="{{$driver->id}}" class="btn btn-success btnView"><i class="fa fa-eye"></i></button>
                                <a href="{{url('/driver/'.$driver->id.'/edit')}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                <a href="{{url('/driver/'.$driver->id.'/edit')}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>NIC Number</th>
                        <th>Mobile Number</th>
                        <th>Licence Number</th>
                        <th>Licence Expire Date</th>
                        <th width="150px">Actions</th>
                    </tr>
                    </tfoot>
                </table>

                @foreach($drivers as $driver)
                    <div id="d{{$driver->id}}" hidden="hidden">

                        <div class="card">
                            <div class="card-body" style="margin: auto">
                                @if($driver->photo)
                                    {!! '<img height="50px" class="card-img-top" src="'.$driver->photo->path.'" alt="">' !!}
                                @else
                                    <img  src="data:image/jpeg;base64,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" class="card-img-top" >
                                @endif
                            </div>
                            <div class="card-body">
                                <h3 class="card-title text-center">{{$driver->initials?$driver->initials.' '.$driver->surname:''}}</h3>
                                <h4 class="card-title text-center">Email:&nbsp {{$driver->email?$driver->email.'@ucsc.cmb.ac.lk':''}}</h4>
                                <p class="card-text text-center">NIC:&nbsp {{$driver->nic?$driver->nic:''}}</p>
                                <p class="card-text text-center">Mobile No:&nbsp {{$driver->mobile?$driver->mobile:''}}</p>
                                <p class="card-text text-center">Licence No:&nbsp {{$driver->licence_no?$driver->licence_no:''}}</p>
                                <p class="card-text text-center">Licence Expire Date:&nbsp {{$driver->licence_expire_date?$driver->licence_expire_date->formatLocalized('%d %B %Y').' ( '.$driver->licence_expire_date->diffForHumans().' )':''}}</p>
                                <a href="{{url('/driver/'.$driver->id.'/edit')}}" class="btn btn-success btn-large">Edit Driver Details</a>
                            </div>
                        </div>
                    </div>


                @endforeach

            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('.btnView').on('click',function () {
                $.confirm({
                    title:'Driver Details',
                    content:$('div#d'+$(this).attr('id')).html()
                });
            })
        })
    </script>
@endsection