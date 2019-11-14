@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="text-primary"><a href="{{route('users.index')}}">< Go Back</a></h3>
        @include('layouts.messages.success')
        <div class="row" id="user-profile">
            <div class="card-deck col-md-6">
                <div class="card">
                    <img class="card-img-top"
                         src="https://picsum.photos/200"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-primary font-weight-bolder">{{$user->name}} <span class="badge badge-pill badge-{{$user->isAdmin() ? 'danger' : 'info'}} text-white">{{$user->isAdmin() ? "Admin" : "Student"}}</span></h5>
                        <a href="{{route('users.edit', $user->id)}}"
                           class="btn btn-info text-white font-weight-bold w-25">Edit</a>
                        <a href="{{route('users.deactivate', $user->id)}}" class="btn btn-danger font-weight-bold mx-1">Deactivate</a>
                        <a href="{{ route('reasonToBook.create', $user->id) }}"
                           class="btn btn-warning font-weight-bolder ">Add reasons</a>
                        <div class="w-100">
                            <ul class="list-group profile-info">
                                <li class="list-group-item mt-2">
                                    <a href="mailto:{{$user->email}}" class=""><i
                                                class="fas fa-envelope mr-3"></i>{{$user->email}}</a>
                                </li>
                                <li class="list-group-item mt-2">
                                    <a href="#" class="w-100 d-block"><i
                                                class="fas fa-phone text-right mr-3"></i>{{$user->phone_number ?? 'Not Available'}}
                                    </a>
                                </li>
                                <li class="list-group-item mt-2">
                                    <a href="#"><i
                                                class="fas fa-map-marked-alt mr-3"></i>{{$user->address ?? 'Not Available'}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">Created On: {{$user->created_at}}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-5 offset-1">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0 justify-content-between">
                                <button class="btn btn-link font-weight-bold text-dark" data-toggle="collapse"
                                        data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                    Reasons To book
                                </button>
                                <span class="badge badge-pill badge-warning text-black">
                                    @if($reasons){{$reasons->count() }} @else 0 @endif
                                </span>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                             data-parent="#accordion">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    @if($reasons->count() > 0)
                                        @foreach($reasons as $reason)
                                            <li class="list-group-item">
                                                <span class="font-weight-bolder">Title: </span>{{ $reason->title }}
                                                <a href="{{route('reasonToBook.deactivate', [$user->id, $reason->id])}}"
                                                   class="@if($reason->active == 1) badge-danger @else badge-success @endif badge-pill float-right">@if($reason->active == 1)
                                                        Disable @else Activate @endif</a>
                                            </li>

                                        @endforeach
                                    @else
                                        <p>No Reasons associated with this user</p>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link font-weight-bold text-dark" data-toggle="collapse"
                                        data-target="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                    Current Bookings
                                </button>
                                <span class="badge badge-pill badge-danger">{{$user->bookings()->count()}}</span>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Kit</th>
                                        <th scope="col">Start</th>
                                        <th scope="col">End</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($user->bookings->count() > 0)
                                        @foreach($user->bookings as $booking)
                                            <tr>
                                                <td>{{$booking->kit->title}}</td>
                                                <td>{{$booking->start_date}}</td>
                                                <td>{{$booking->start_date}}</td>
                                                <td><a href="#" class="btn btn-outline-danger btn-sm">Cancel</a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        This user has no bookings
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link font-weight-bold text-dark " data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    Previous Bookings
                                </button>
                                <span class="badge-pill badge badge-dark">0</span>

                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                             data-parent="#accordion">
                            <div class="card-body">
                                Previous Bookings will soon be here
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection