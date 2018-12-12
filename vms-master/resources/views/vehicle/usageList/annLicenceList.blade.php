@foreach ($licences as $licence)

    <tr> 
        <td> {{$licence->vehicle_name}} </td>
        <td> {{$licence->from}} </td>
        <td> {{$licence->to}} </td>
        <td> {{$licence->licence_no}} </td>
        <td> {{$licence->licence_date}} </td>
        <td> {{$licence->amount}} </td>
    </tr>
    
@endforeach