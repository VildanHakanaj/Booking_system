@if($errors->any())
    <div class="alert alert-danger col-md-8 offset-2" role="alert">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif