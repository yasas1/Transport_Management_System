@foreach ($tyrePositionChanges as $tyrePositionChange)

<tr id="{{$tyrePositionChange->id}}">        
        <td> {{$tyrePositionChange->date}} </td>
        <td> {{$tyrePositionChange->position}} </td> 
        <td> {{$tyrePositionChange->meter_reading}} </td>
        <td> {{$tyrePositionChange->remarks}} </td>
        <td> 
            <a href="#" class="btn btn-warning btn-sm" id="edit" data-id="{{$tyrePositionChange->id}}"><i class="fa fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-sm" id="delete" data-id="{{$tyrePositionChange->id}}"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    
@endforeach