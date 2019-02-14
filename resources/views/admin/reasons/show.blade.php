@extends('layouts.app')
@section('content')
    <div class="container">

        <h3 class="text-primary"><a href="{{route('reason.index')}}">< Go Back</a></h3>
        @include('layouts.messages.success')
        <div class="card bg-light mb-3 list-group">
            <div class="card-header"><h1 class="text-muted">{{$reason->name}}</h1></div>
            <div class="card-body">
                <li class="list-group-item">Title: {{$reason->title}}</li>
                <li class="list-group-item">Description: {{$reason->description}}</li>
                <li class="list-group-item">Status: {{$reason->active == 1 ? 'Active' : 'Not Active'}}</li>
                <li class="list-group-item">Created At: {{$reason->created_at}}</li>
                <li class="list-group-item">Updated At: {{$reason->updated_at}}</li>
            </div>
            <div class="d-block text-center w-100 my-3">
                <a href="{{route('reason.edit', $reason->id)}}" class="btn btn-primary w-25">Edit</a>
            </div>
        </div>
    </div>
@endsection