@foreach ($fuelUsages as $fuelUsage)

<tr id="{{$fuelUsage->id}}">        
        <td> {{$fuelUsage->date}} </td>
        <td> {{$fuelUsage->meter_reading}} </td> 
        <td> {{$fuelUsage->fuel_liter}}</td>
        <td> {{$fuelUsage->cost}} </td> 
        <td> 
            @if(Auth::user()->canUpdateVehicleFuelUsage())
                <a href="#" class="btn btn-warning btn-sm" id="edit" data-id="{{$fuelUsage->id}}"><i class="fa fa-edit"></i></a>
            @endif
            @if(Auth::user()->canDeleteVehicleFuelUsage())
                <a href="#" class="btn btn-danger btn-sm" id="delete" data-id="{{$fuelUsage->id}}"><i class="fa fa-trash"></i></a>
            @endif
        </td>
    </tr>
    
@endforeach