@foreach ($repaires as $repaire)

<tr id="{{$repaire->id}}">        
        <td> {{$repaire->workshop_in_date}} </td>
        <td> {{$repaire->workshop_out_date}} </td>
        <td> {{$repaire->authorized_by}} </td> 
        <td> {{$repaire->executed_at}}</td>
        <td> {{$repaire->cost}} </td>
        <td> 
            <a href="#" class="btn btn-success btn-sm" id="view" data-id="{{$repaire->id}}"><i class="fa fa-eye"></i></a>
            @if(Auth::user()->canUpdateVehicleRepair())
                <a href="#" class="btn btn-warning btn-sm" id="edit" data-id="{{$repaire->id}}"><i class="fa fa-edit"></i></a>
            @endif
            @if(Auth::user()->canDeleteVehicleRepair())
                <a href="#" class="btn btn-danger btn-sm" id="delete" data-id="{{$repaire->id}}"><i class="fa fa-trash"></i></a>
            @endif
        </td>
    </tr>
    
@endforeach