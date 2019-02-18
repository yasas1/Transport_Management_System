@foreach ($tyreReplaces as $tyreReplace)

<tr id="replace{{$tyreReplace->id}}">        
        <td> {{$tyreReplace->date}} </td>
        <td> {{$tyreReplace->position}} </td> 
        <td> {{$tyreReplace->size}} </td>
        <td> {{$tyreReplace->type}} </td>
        <td> {{$tyreReplace->meter_reading}} </td>
        <td> {{$tyreReplace->remarks}} </td>
        <td> 
            <a href="#" class="btn btn-success btn-sm" id="view_replace" data-id="{{$tyreReplace->id}}"><i class="fa fa-eye"></i></a>
            @if(Auth::user()->canUpdateTyreReplacement())
                <a href="#" class="btn btn-warning btn-sm" id="edit_replace" data-id="{{$tyreReplace->id}}"><i class="fa fa-edit"></i></a>
            @endif
            @if(Auth::user()->canDeleteTyreReplacement())
                <a href="#" class="btn btn-danger btn-sm" id="delete_replace" data-id="{{$tyreReplace->id}}"><i class="fa fa-trash"></i></a>
            @endif
        </td>
    </tr>
    
@endforeach