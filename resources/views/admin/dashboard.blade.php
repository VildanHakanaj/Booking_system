@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="{{route('')}}"></a></li>
            <li class="list-group-item">Add new user</li>
            <li class="list-group-item">View all products</li>
            <li class="list-group-item">Add a new products</li>
        </ul>
    </div>
</div>
@endsection
