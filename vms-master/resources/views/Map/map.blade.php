@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')
    {{-- <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet"> --}}
@endsection

@section('header', 'View Backlog Journey')

@section('description', 'Select a journey request to approve.')

@section('content')
    @include('layouts.errors')
    @include('layouts.success')

    {{-- for Other Divisional heads' journey requests --}}
    <div class="box box-primary">

        <div class="box-header with-border">
            <h2 class="box-title"> <strong> Map Journeys </strong> </h2>
        </div>
        
        <div class="box-body" style=" height:700px; overflow: auto;" >
            
             
            
        </div>
               
    </div>
        
    
@endsection

@section('scripts')

    <script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>

    <script async defer
 src="https://maps.googleapis.com/maps/api/js?client=YOUR_CLIENT_ID&v=quarterly&callback=initMap"></script>

    
    <script>
     
    </script>

@endsection