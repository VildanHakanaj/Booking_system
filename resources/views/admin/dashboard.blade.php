@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-black-50">Dashboard</h1>
        <div class="row mt-5">
            <div class="col-md-6">
                @include('layouts.partials.todaysBookings')
            </div>
            <div class="col-md-6">
                @include('layouts.partials.upComingBookings')
            </div>
        </div>
    </div>
@endsection
