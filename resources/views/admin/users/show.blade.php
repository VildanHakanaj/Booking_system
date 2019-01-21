@extends('layouts.app')
@section('content')
<div class="container">
    <h3 class="text-primary"><a href="{{URL::previous()}}">< Go Back</a></h3>
    <div class="card bg-light mb-3 list-group">
        <div class="card-header"><h1 class="text-muted">{{$user->name}}</h1></div>
        <div class="card-body">
            <li class="list-group-item">Email: {{$user->email}}</li>
            <li class="list-group-item">Address: {{$user->home_address ?? 'N/A'}}</li>
            <li class="list-group-item">Phone: {{$user->phone_number ?? 'N/A'}}</li>
            <li class="list-group-item">Created At: {{$user->created_at}}</li>
            <li class="list-group-item">Updated At: {{$user->updated_at}}</li>
        </div>
        <div class="d-block text-center w-100 my-3">
            <a href="#" class="btn btn-primary w-25">Edit</a>
            <a href="#" class="btn btn-danger w-25">Delete</a>
        </div>
    </div>
</div>
@endsection