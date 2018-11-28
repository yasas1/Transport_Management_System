@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE SERVICING')

@section('styles')
    {{-- <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet"> --}}
@endsection

@section('header', 'Vehicle Servicing')

@section('description', 'Select a journey request to approve.')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')

    
    <div class="box box-primary">

        <div class="box-header with-border">
            <h2 class="box-title"> <strong> Vehicle Servicing </strong> </h2>
        </div>
        
        <div class="box-body"  >
    
        </div>
               
    </div>
 
@endsection

@section('scripts')

    

@endsection