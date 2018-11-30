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

        var map;
        var marker;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 6.847278, lng:79.926605},
                zoom: 10
            });

             marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: {lat: 6.847278, lng: 79.926605}
            });
            
            //marker.addListener('click', toggleBounce);
            

        }

        
    
     //AIzaSyBImn3Uma343O6GuhhbBTvsdA6lMb8bd8s
    </script>  
 
    {{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEUlmbMLmmJqhiNZZ8he1_muiSTRkWins&callback=initMap"
    type="text/javascript"></script> --}}
    


@endsection