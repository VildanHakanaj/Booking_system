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
                            <div class="col-md-3">
                                <label for="">Product</label>
                                <select id="indexSearch" type="text" class="form-control">
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
                            <div class="col-md-3">
                                <label for="">Start Date</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="">End Date</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <input type="submit" name="submit" id="submit" class="btn btn-success w-25 mt-3">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <table class="table mb-5">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
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