@foreach ($tyrePositionChanges as $tyrePositionChange)

<tr id="posChange{{$tyrePositionChange->id}}">        
        <td> {{$tyrePositionChange->date}} </td>
        <td> {{$tyrePositionChange->meter_reading}} </td>
        <td> {{$tyrePositionChange->remarks}} </td>
        <td> 
            @if(Auth::user()->canUpdateTyrePositionChange())
                <a href="#" class="btn btn-success btn-sm" id="edit_posChange" data-id="{{$tyrePositionChange->id}}"><i class="fa fa-edit"></i></a>
            @endif
            @if(Auth::user()->canDeleteTyrePositionChange())
                <a href="#" class="btn btn-danger btn-sm" id="delete_posChange" data-id="{{$tyrePositionChange->id}}"><i class="fa fa-trash"></i></a>
            @endif
        </td>
    </tr>
    
@endforeach