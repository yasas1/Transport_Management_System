@foreach ($licences as $licence)

<tr id="{{$licence->id}}">        
        <td> {{$licence->from}} </td>
        <td> {{$licence->to}} </td> 
        <td> {{$licence->licensing_authority}} </td>
        <td> {{$licence->licence_no}} </td>
        <td> {{$licence->licence_date}} </td>
        <td> {{$licence->amount}} </td>
        <td> {{$licence->emission_test_details}} </td>
        <td> 
            <a href="#" class="btn btn-success btn-sm" id="view" data-id="{{$licence->id}}"><i class="fa fa-eye"></i></a>
            <a href="#" class="btn btn-warning btn-sm" id="edit" data-id="{{$licence->id}}"><i class="fa fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-sm" id="delete" data-id="{{$licence->id}}"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    
@endforeach