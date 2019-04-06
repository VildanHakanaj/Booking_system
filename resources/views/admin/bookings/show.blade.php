@extends('layouts.app')
@section('content')
    <div class="col-md-6 offset-3">
        <h1><a href="{{route('bookings.index')}}"><< Go back</a></h1>
        <div class="card">
            <div class="card-header">
                <h1 class="text-muted">Booking for {{$booking->user->name}}</h1>
            </div>
            <ul class="list-group">
                <li class="list-group-item">User: <a href="{{route('users.show', $booking->user->id)}}">{{$booking->user->name}}</a></li>
                <li class="list-group-item">Kit: <a href="{{route('kits.show', $booking->kit->id)}}">{{$booking->kit->title}}</a></li>
                <li class="list-group-item">item 3</li>
            </ul>
            <div class="card-footer">
                <a href="#" class="btn btn-primary">Edit Booking</a>
                <a href="#" class="btn btn-danger">Cancel Booking</a>
            </div>
        </div>
    </div>
@endsection