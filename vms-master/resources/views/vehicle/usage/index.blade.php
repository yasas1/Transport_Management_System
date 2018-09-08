@extends('layouts.master')

@section('title', 'VEHICLE USAGE | VEHICLE MANAGEMENT SYSTEM')

@section('styles')

@endsection

@section('header', 'View Vehicle Usage')

@section('description', 'View vehicle usage.')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Select a Vehicle</h3>

        </div>
        <div class="box-header">
            @include('layouts.errors')
            @include('layouts.success')
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
        </div>
    </div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection