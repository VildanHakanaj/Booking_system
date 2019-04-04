@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">Welcome to the booking system {{auth()->user()->name}}</h1>
        <div class="row justify-content-center mt-5">
            <a href="{{route('booking.exploreKits')}}" class="btn btn-lg btn-outline-primary mr-2">Explore kits</a>
            <a href="{{route('booking')}}"class="btn btn-lg btn-outline-danger ml-5 mr-5">Book a kit</a>
        </div>
        </div>
    </div>
@endsection
