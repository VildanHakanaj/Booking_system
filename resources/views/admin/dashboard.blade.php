@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card col-md-6 offset-3" >
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="{{route('users.index')}}">View all users</a></li>
            <li class="list-group-item"><a href="#">Add new user</a></li>
            <li class="list-group-item"><a href="#">View all products</a></li>
            <li class="list-group-item"><a href="#">Add a new products</a></li>
        </ul>
    </div>
</div>
@endsection
