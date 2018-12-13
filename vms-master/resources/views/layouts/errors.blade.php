@if(!$errors->isEmpty())
    <div class="alert alert-error alert-dismissable fade in" id="errorMessage">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('errors'))
    <div class="alert alert-error alert-dismissable fade in" id="successMessage"> 
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong></strong> {{session('errors')}}
    </div>
@endif