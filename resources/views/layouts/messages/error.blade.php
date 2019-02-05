@if(Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{{Session::get('error') }}</li>
        </ul>
    </div>
@endif