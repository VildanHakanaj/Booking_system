@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">

            <div class="col">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Users
                        <span class="badge badge-primary badge-pill">{{$userCount}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Products
                        <span class="badge badge-primary badge-pill">32</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Morbi leo risus
                        <span class="badge badge-primary badge-pill">1</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
