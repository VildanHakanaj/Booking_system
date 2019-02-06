@if(Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{{Session::get('success')}}</li>
        </ul>
    </div>
    @endif