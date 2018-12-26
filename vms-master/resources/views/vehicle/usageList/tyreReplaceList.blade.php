@foreach ($tyreReplaces as $tyreReplace)

<tr id="{{$tyreReplace->id}}">        
        <td> {{$tyreReplace->date}} </td>
        <td> {{$tyreReplace->position}} </td> 
        <td> {{$tyreReplace->size}} </td>
        <td> {{$tyreReplace->type}} </td>
        <td> {{$tyreReplace->meter_reading}} </td>
        <td> 
            <a href="#" class="btn btn-success btn-sm" id="view" data-id="{{$tyreReplace->id}}"><i class="fa fa-eye"></i></a>
            <a href="#" class="btn btn-warning btn-sm" id="edit" data-id="{{$tyreReplace->id}}"><i class="fa fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-sm" id="delete" data-id="{{$tyreReplace->id}}"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    
@endforeach