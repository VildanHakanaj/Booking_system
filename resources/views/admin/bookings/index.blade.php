@extends('layouts.app')
@section('content')
    @include('layouts.partials.modal')
    <div class="container">
        @include('layouts.messages.success')
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => 'bookings.search', 'method' => 'POST']) !!}
                <div class="row mt-5 mb-5">
                    {!! Form::text('search', null, ['placeholder' => 'Title', 'class' => 'form-control col-md-11']) !!}
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
                        <th scope="row">{{$booking->id}}</th>
                        <td>{{$booking->user->name}}</td>
                        <td>{{$booking->kit->title}}</td>
                        <td>{{$booking->start_date}}</td>
                        <td>{{$booking->end_date}}</td>
                        <td>{{$booking->checked_out == 0 ? 'No' : 'Yes'}}</td>
                        <td>{{$booking->checked_in == 0  ?  'No'  : 'Yes' }}</td>
                        <td>
                            <a href="{{route('kits.destroy', $booking->id)}}" class="btn btn-sm btn-outline-danger cancleBooking">Cancel Booking</a>
                            <a href="{{route('bookings.edit', $booking->id)}}" class="btn btn-sm btn-outline-primary">Edit Booking</a>
                            <a href="{{route('bookings.show', $booking->id)}}" class="btn btn-sm text-white btn-info">Show Details</a>
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