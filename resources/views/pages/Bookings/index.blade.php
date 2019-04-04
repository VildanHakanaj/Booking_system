@extends('layouts.app')
@section('content')
    <div class="container">
        {{--Seach nav--}}
        <div class="jumbotron">
            <h3>Welcome to the booking station {{auth()->user()->name}}</h3>
        </div>
        <div class="row">
            {{--Shows the errors--}}
            @include('layouts.messages.alert')
            @include('layouts.messages.error')
            <div class="col-md-12">
                <h3 class="text-muted">Booking Section</h3>
                <form action="{{ route('kits.checkAvailability') }}" method="POST"
                      class="col-md-12 justify-content-center">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="kit">Choose a kit</label>~
                                <select id="indexSearch" type="text" name="kit" class="form-control">
                                    @if($kits->count() > 0)
                                        <option value="all">All</option>
                                        @foreach($kits as $kit)
                                            <option value="{{$kit->id}}">{{$kit->title}}</option>
                                        @endforeach
                                    @else
                                    @endif
                                    <option value="all"></option>

                                </select>
                                <small class="small text-muted">
                                    Leave empty to see whats available
                                </small>
                            </div>
                            <div class="col-md-5">
                                <label for="start_date">Start Date</label>
                                <input value="{{old('start_date')}}" type="date" name="start_date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <input type="submit" name="submit" value="Check Availability"
                                       class="mt-4 w-100 btn btn-success">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table mb-5">
                    <thead>
                    <tr>
                        <th scope="col">Kit Title</th>
                        <th scope="col">Items in the kit</th>
                        <th scope="col">Available</th>
                    </tr>
                    </thead>
                    @if(Session::has('kitsForBooking'))
                        @if(Session::get('kitsForBooking')->count() > 0)
                            <tbody>
                            @foreach(Session::get('kitsForBooking') as $kit)
                                <tr>
                                    <th scope="row">{{$kit->title}}</th>
                                    <td>
                                        @foreach($kit->products() as $product)
                                            <ul class="list-group">
                                                <li class="list-group-item">{{$product->title}}</li>
                                            </ul>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-success">Available</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                    @endif
                </table>
            </div>
            {{--Sidebar previous booking--}}
            <div class="row col-md-12">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3>Current Bookings</h3>
                        </div>
                        <ul class="list-group">
                            @if(auth()->user()->bookings->count() > 0)
                                @foreach(auth()->user()->bookings as $currentBooking)
                                    <li class="list-group-item">
                                        Kit: {{$currentBooking->kit->title}} | Start Date: {{$currentBooking->start_date}}| End Date: {{$currentBooking->end_date}}
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item list-group-item-warning">You don't have any bookings
                                    currently
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    @include('layouts.partials.previousBooking')
                </div>
            </div>

        </div>
        {{--Sidebar for new addition--}}

    </div>
@endsection