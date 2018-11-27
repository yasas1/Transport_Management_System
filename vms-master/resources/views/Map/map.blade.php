@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE')

@section('styles')
<style>
    #map{
        height: 500px;
        margin: 0 auto;
    }
</style>
@endsection

@section('header', 'View Map')

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
            
             <div id="map"> </div>
            
        </div>
               
    </div>
        
    
@endsection

@section('scripts')
    
    <script>

        // $(document).ready(function(){

        //     var map = new google.maps.Map(document.getElementById('map'), {
        //             center: {lat: -34.397, lng: 150.644},
        //             zoom: 8
        //         });
        // });
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 31.565600, lng: -110.249180},
            zoom: 8
        });
      }
     
    </script>  

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBImn3Uma343O6GuhhbBTvsdA6lMb8bd8s&callback=initMap"
    type="text/javascript"></script>


@endsection