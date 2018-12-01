@extends('layouts.master')

@section('title', 'VEHICLE MANAGEMENT SYSTEM | VEHICLE SERVICING')

@section('styles')
    {{-- <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet"> --}}
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    
    <style> 
        label{margin-left: 20px;}
        #datepicker{width:300px; margin: 0 20px 20px 20px;}
        #datepicker > span:hover{cursor: pointer;color: blue;}
    </style>
@endsection

@section('header', 'Vehicle Servicing')



@section('content')
    @include('layouts.errors')
    @include('layouts.success')
  
    <div class="box box-primary">
    
        <div class="box-body"  >

            <div class="row"> 

                <div class="col-md-5"> 

                    <h4><i class="fa fa-car"></i> Vehicle Required</h4>
    
                    <div style="width:300px">
                        <div class="form-group">
                            {{Form::select('vehical_id',$vehicles,null,['class'=>'form-control ','id'=>'vid','placeholder'=>'Select a Vehicle'])}}
                        </div>
                    </div>
                    
                </div>
    
                <div class="col-md-5"> 
    
                    <h4><i class="fa fa-calendar"></i> Date </h4>
                                                        
                    <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                        <input class="form-control" type="text" readonly />
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
            
                </div>

            </div>  

        </div>
               
    </div>
 
@endsection

@section('scripts')

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
{{-- <script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script> --}}

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>




<script>

    $('#vid').on('change',function () {
        var vid = $(this).val();
        console.log(vid);

    });

    // $('.datepicker').datepicker({
    //     format: 'mm/dd/yyyy',
    //     startDate: '-3d',
    //     autoclose: true,
    // });

    
    $("#datepicker").datepicker({ 
        autoclose: true, 
        format: 'yyyy-mm-dd',
        todayHighlight: true
    }).datepicker('update', new Date());
    

    
   

</script>

    

@endsection