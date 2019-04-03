@extends('layouts.app')
@section('content')
    <div class="container">
        {{--Seach nav--}}
        <div class="jumbotron">
            <h3>Welcome to the booking station {{auth()->user()->name}}</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-muted">Booking Section</h3>
                <form action="#" method="POST" class="col-md-12 justify-content-center">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="kit">Choose a kit</label>
                                <select id="indexSearch" type="text" name="kit" class="form-control">
                                    <option value="all"></option>
                                    <option value="1">Kit 1</option>
                                    <option value="2">Kit 2</option>
                                    <option value="3">Kit 3</option>
                                    <option value="4">Kit 4</option>
                                    <option value="5">Kit 5</option>
                                </select>
                                <small class="small text-muted">
                                    Leave empty to see whats available
                                </small>
                            </div>
                            <div class="col-md-5">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <input type="submit" value="Check Availability" class="mt-4 w-100 btn btn-success">
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
                    <tbody>
                    <tr>
                        <td>Mark</td>
                        <td>
                            <ul class="list-group">
                                <li class="list-group-item">Item 1</li>
                                <li class="list-group-item">Item 2</li>
                                <li class="list-group-item">Item 3</li>
                                <li class="list-group-item">Item 4</li>
                            </ul>
                        </td>
                        <td>
                            <a href="" class="btn btn-md btn-outline-danger">Not Available</a>
                            <a href="" class="btn btn-md btn-outline-success">Book</a>
                        </td>
                    </tr>
                    </tbody>
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
                            <li class="list-group-item list-group-item-warning">You don't have any bookings
                                currently
                            </li>
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