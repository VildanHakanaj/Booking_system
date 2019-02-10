@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            <h1 class="text-muted">Reasons</h1>
            <a href="{{route('reason.create')}}" class="btn btn-success mb-3">Add New Reason</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Title</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            {{--If there are any users--}}
            @if($reasons->count() > 0)
                {{--Go through all of them--}}
                @foreach($reasons as $reason)
                    <tr>
                        <th scope="row">#{{$reason->id}}</th>
                        <td><a href="{{route('reason.show', $reason->id)}}">{{$reason->title}}</a></td>
                        <td>{{$reason->active == 1 ? 'Active' : 'Not Active'}}</td>
                        <td><a href="{{route('reason.edit', $reason->id)}}" class="btn btn-outline-primary">Edit</a></td>
                    </tr>
                @endforeach
            @else
                No Reasons in the table
            @endif
            </tbody>
            {{$reasons->links()}}
        </table>
    </div>
@endsection