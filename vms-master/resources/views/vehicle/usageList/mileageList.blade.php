@foreach ($mileages as $mileage)

<tr id="{{$mileage->id}}">        
        <td> {{$mileage->date}} </td>
        <td> {{$mileage->meter_reading_day_begin}} </td> 
        <td> {{$mileage->meter_reading_day_end}}</td>
        <td> {{$mileage->meter_reading_mileage}} </td> 
        <td> {{$mileage->journey_mileage}}</td>
        <td> {{$mileage->remarks}} </td>
        <td> 
            @if(Auth::user()->canUpdateVehicleMileage())
                <a href="#" class="btn btn-warning btn-sm" id="edit" data-id="{{$mileage->id}}"><i class="fa fa-edit"></i></a>
            @endif
            @if(Auth::user()->canDeleteVehicleMileage())
                <a href="#" class="btn btn-danger btn-sm" id="delete" data-id="{{$mileage->id}}"><i class="fa fa-trash"></i></a>
            @endif
        </td>
    </tr>
    
@endforeach