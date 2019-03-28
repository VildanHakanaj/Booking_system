@extends('layouts.app')
@section('content')
    @include('layouts.partials.modal')
    <div class="container">
        @include('layouts.messages.success')
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => 'bookings.search', 'method' => 'POST']) !!}
                <div class="row offset-4">
                    {!! Form::text('search', null, ['placeholder' => 'Title', 'class' => 'form-control col-md-3']) !!}
                    {!! Form::submit('Search', ['class' => 'btn btn-sm btn-primary col-md-1']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div>
            <h1 class="text-muted"><a href="{{route('bookings.index')}}">Bookings</a></h1>
        </div>
        @if($bookings->count() > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">User Email</th>
                    <th scope="col">Kit</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Picked Up</th>
                    <th scope="col">Return</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <th scope="row">#1</th>
                        <td><a href="">vildanhakanaj@trentu.ca</a></td>
                        <td>Kit Canon</td>
                        <td>{{now()}}</td>
                        <td>{{now()}}</td>
                        <td>Yes</td>
                        <td>No</td>
                        <td>
                            <a href="{{route('kits.destroy', $booking->id)}}" class="btn btn-sm btn-outline-danger deleteKit">Cancel</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @else
                    No kits created
                @endif
                {{$bookings->links()}}
            </table>
    </div>
@endsection