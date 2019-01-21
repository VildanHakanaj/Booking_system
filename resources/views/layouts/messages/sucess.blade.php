@if(Session::has('sucess'))
    <div class="alert alert-success">
        <ul>
            <li>{{Session::get('sucess') }}</li>
        </ul>
    </div>
    @endif