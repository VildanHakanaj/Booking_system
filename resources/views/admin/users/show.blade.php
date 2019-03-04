@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="text-primary"><a href="{{route('users.index')}}">< Go Back</a></h3>
        @include('layouts.messages.success')
        <div class="card bg-light mb-3 list-group">
            <div class="card-header"><h1 class="text-muted">{{$user->name}}</h1></div>
            <div class="card-body">
                <li class="list-group-item">Email: {{$user->email}}</li>
                <li class="list-group-item">Address: {{$user->home_address ?? 'N/A'}}</li>
                <li class="list-group-item">Phone: {{$user->phone_number ?? 'N/A'}}</li>
                <li class="list-group-item">Created At: {{$user->created_at}}</li>
                <li class="list-group-item">Updated At: {{$user->updated_at}}</li>
                <li class="list-group-item">Reasons:
                    <ul>
                        @if(!empty($reasons))
                            @foreach($reasons as $reason)
                                <li id="deactivate" class="w-50 my-2">Title: {{$reason['title']}} -- Status @if($reason['active'] == 1) Active @else Not Active @endif
                                    <a href="#" class="btn btn-sm btn-danger float-right">Disable</a></li>
                            @endforeach
                        @else
                            <p>No Reasons associated with this user</p>
                        @endif
                            <a href="{{ route('reasonToBook.create', $user->id) }}" class="btn btn-success ">Add reasons</a>
                    </ul>
                </li>
            </div>
            <div class="d-block text-center w-100 my-3">
                <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-lg w-50">Edit</a>
                <a href="{{route('users.deactivate', $user->id)}}" class="btn btn-danger btn-lg w-50">Deactivate</a>
            </div>
        </div>
    </div>
@endsection