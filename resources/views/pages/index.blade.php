@extends('layouts.app')
@section('content')
    <div class="container">

        {{--Seach nav--}}
        <div class="col-md-8 offset-2">
            <div class="jumbotron">
                <h1 class="text-muted">Welcome to the booking station {{Auth::user()->name }}</h1>
                <small class="text-muted text-center">This is the section where the user will see the content to book</small>
            </div>
        </div>
        {{--Sidebar previous booking--}}

        {{--Sidebar for new addition--}}


        {{--Main Booking checking--}}

    </div>
    @endsection