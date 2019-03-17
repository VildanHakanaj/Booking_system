@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => 'users.search', 'method' => 'POST']) !!}
                <div class="row offset-4">
                    {!! Form::text('search', null, ['placeholder' => 'Name, Email', 'class' => 'form-control col-md-3']) !!}
                    {!! Form::submit('Search', ['class' => 'btn btn-sm btn-primary col-md-1']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div>
            <h1 class="text-muted"><a href="{{route('users.index')}}">Users</a></h1>
            <a href="{{route('users.create')}}" class="btn btn-success mb-3">Add new user</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Type</th>
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
                        <td>{{$user->admin == 1 ? 'Admin' : 'User'}}</td>
                        <td><a href="{{route('users.edit', $user->id)}}" class="btn btn-outline-primary">Edit</a></td>
                    </tr>
                @endforeach
            @else
                No users in the table
            @endif
            </tbody>
            {{$users->links()}}
        </table>
    </div>
@endsection