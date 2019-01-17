@foreach ($accidents as $accident)

<tr id="{{$accident->id}}">        
        <td> {{$accident->date}} </td>
        <td> {{$accident->place}} </td> 
        <td> {{$accident->title.' '.$accident->firstname.' '.$accident->surname}}</td>
        <td> {{$accident->description_of_damage_and_remarks}} </td>
        <td> 
            <a href="#" class="btn btn-success btn-sm" id="view" data-id="{{$accident->id}}"><i class="fa fa-eye"></i></a>
            <a href="#" class="btn btn-warning btn-sm" id="edit" data-id="{{$accident->id}}"><i class="fa fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-sm" id="delete" data-id="{{$accident->id}}"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
    
@endforeach