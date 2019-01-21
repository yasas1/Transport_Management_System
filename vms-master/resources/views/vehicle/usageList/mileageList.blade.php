@foreach ($mileages as $mileage)

<tr id="{{$mileage->id}}">        
        <td> {{$mileage->date}} </td>
        <td> {{$mileage->meter_reading_day_begin}} </td> 
        <td> {{$mileage->meter_reading_day_end}}</td>
        <td> {{$mileage->meter_reading_mileage}} </td> 
        <td> {{$mileage->journey_mileage}}</td>
        <td> {{$mileage->remarks}} </td>
        <td> 
            <a href="#" class="btn btn-warning btn-sm" id="edit" data-id="{{$mileage->id}}"><i class="fa fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-sm" id="delete" data-id="{{$mileage->id}}"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    
@endforeach