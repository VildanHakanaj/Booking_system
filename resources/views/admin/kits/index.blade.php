@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            <h1 class="text-muted">Kits</h1>
            <a href="{{route('reason.create')}}" class="btn btn-success mb-3">Add New Kit</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Kit Name</th>
                <th scope="col">Bookable</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @if($kits->count() > 0)
                @foreach($kits as $kit)
                    <tr>
                        <th scope="row">#{{$kit->id}}</th>
                        <td><a href="{{route('kits.show', $kit->id)}}">{{$kit->title}}</a></td>
                        <td>{{$kit->active == 1 ? 'Active' : 'Not Active'}}</td>
                        <td><a href="{{route('kits.edit', $kit->id)}}" class="btn btn-outline-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            @else
                No Reasons in the table
            @endif
            </tbody>
            {{$kits->links()}}
        </table>
    </div>
@endsection