@if(Session::has('sucess'))
    <div class="alert alert-success">
        <ul>
            <li>{{Session::get('message') }}</li>
        </ul>
    </div>
    @endif