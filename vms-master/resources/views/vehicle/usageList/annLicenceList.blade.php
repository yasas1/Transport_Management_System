@foreach ($licences as $licence)

    <tr>        
        <td> {{$licence->from}} </td>
        <td> {{$licence->to}} </td> 
        <td> {{$licence->licensing_authority}} </td>
        <td> {{$licence->licence_no}} </td>
        <td> {{$licence->licence_date}} </td>
        <td> {{$licence->amount}} </td>
        <td> 
            <a href="#" class="btn btn-info btn-xs" id="view" data-id="{{$licence->id}}">View</a>
            <a href="#" class="btn btn-success btn-xs" id="edit" data-id="{{$licence->id}}">Edit</a>
            <a href="#" class="btn btn-danger btn-xs" id="delete" data-id="{{$licence->id}}">Delete</a>
        </td>
    </tr>
    
@endforeach