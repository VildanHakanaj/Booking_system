@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-muted my-5">Users</h1>
    <table class="table table-hover">

        <thead>
        <tr>
            <th scope="col">#ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Home Address</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Type</th>
            <th scope="col">Created at</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        {{--If there are any users--}}
        @if($users->count() > 0)
            {{--Go through all of them--}}
            @foreach($users as $user)
        <tr>
            <th scope="row">#{{$user->id}}</th>
            <td><a href="{{route('users.show', $user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->email}}</td>
            <td>{{$user->home_address ?? 'N/A'}}</td>
            <td>{{$user->phone_number ?? 'N/A'}}</td>
            <td>{{$user->admin == 1 ? 'Admin' : 'User'}}</td>
            <td>{{$user->created_at}}</td>
            <td><a href="#" class="btn btn-outline-primary">Edit</a></td>
            <td><a href="#" class="btn btn-outline-danger">Close</a></td>
        </tr>
        @endforeach
            @else
            No users in the table
        @endif
        </tbody>
    </table>
    </div>
@endsection