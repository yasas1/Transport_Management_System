@foreach ($fuelUsages as $fuelUsage)

<tr id="{{$fuelUsage->id}}">        
        <td> {{$fuelUsage->date}} </td>
        <td> {{$fuelUsage->meter_reading}} </td> 
        <td> {{$fuelUsage->fuel_liter}}</td>
        <td> {{$fuelUsage->cost}} </td> 
        <td> 
            <a href="#" class="btn btn-warning btn-sm" id="edit" data-id="{{$fuelUsage->id}}"><i class="fa fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-sm" id="delete" data-id="{{$fuelUsage->id}}"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    
@endforeach