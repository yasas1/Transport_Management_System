@foreach ($licences as $licence)

    <tr>        
        <td> {{$licence->from}} </td>
        <td> {{$licence->to}} </td>
        <td> {{$licence->licence_no}} </td>
        <td> {{$licence->licence_date}} </td>
        <td> {{$licence->amount}} </td>
        <td> 
            <a href="#" class="btn btn-info btn-xs">View</a>
            <a href="#" class="btn btn-success btn-xs">Edit</a>
            <a href="#" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
    
@endforeach