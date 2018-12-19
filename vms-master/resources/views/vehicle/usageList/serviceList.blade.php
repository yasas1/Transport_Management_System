@foreach ($services as $service)

<tr id="{{$service->id}}">        
        <td> {{$service->date}} </td>
        <td> {{$service->meter_reading}} </td> 
        <td> {{$service->details}} </td>
        <td> {{$service->cost}} </td>
        <td> 
            <a href="#" class="btn btn-success btn-sm" id="view" data-id="{{$service->id}}"><i class="fa fa-eye"></i></a>
            <a href="#" class="btn btn-warning btn-sm" id="edit" data-id="{{$service->id}}"><i class="fa fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-sm" id="delete" data-id="{{$service->id}}"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    
@endforeach