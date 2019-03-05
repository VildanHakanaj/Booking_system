@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            <h1 class="text-muted">Reasons To Book</h1>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">User</th>
                <th scope="col">Reason Title</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            {{--If there are any users--}}
            @if($reasonsToBook->count() > 0)
                {{--Go through all of them--}}
                @foreach($reasonsToBook as $reason)
                    <tr>
                        <th scope="row">#{{$reason->id}}</th>
                        <td><a href="{{route('reason.show', $reason->id)}}">{{$reason->title}}</a></td>
                        <td>{{$reason->reason_id}}</td>
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