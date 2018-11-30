@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE SERVICING')

@section('styles')
    {{-- <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet"> --}}
@endsection

@section('header', 'Vehicle Servicing')



@section('content')
    @include('layouts.errors')
    @include('layouts.success')
  
    <div class="box box-primary">
    
        <div class="box-body"  >

            <h4><i class="fa fa-car"></i> Vehicle Required</h4>
            
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                    </div>
                </div>
                
            </div>

            <h4><i class="fa fa-calendar"></i> Date </h4>
            <div class="form-group col-md-offset-1">
                <div class="row">
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>

            </div> 

        </div>
               
    </div>
 
@endsection

@section('scripts')

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>




<script>

    $('#vid').on('change',function () {
        var vid = $(this).val();
        console.log(vid);

    });

    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        startDate: '-3d',
        autoclose: true,
    });

    
   

</script>

    

@endsection