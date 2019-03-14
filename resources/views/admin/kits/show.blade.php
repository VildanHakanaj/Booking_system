@extends('layouts.app')
@section('content')
    <div class="container">

        <h3 class="text-primary"><a href="{{route('reason.index')}}">< Go Back</a></h3>
        @include('layouts.messages.success')
        <div class="card bg-light mb-3 list-group">
            <div class="card-header"><h1 class="text-muted">{{$kit->tilte}}</h1></div>
            <div class="card-body">
                <li class="list-group-item">Bookable: {{ $kit->status == 1 ? 'Active' : 'Not Active' }}</li>
                <li class="list-group-item">Booking window: {{$kit->booking_window}} day(s)</li>
                <li class="list-group-item">
                    Products
                    @if($products->count() > 0)
                        <ul>
                            @foreach($products as $product)
                                <li>{{$product->title}}</li>
                            @endforeach
                            @else
                                <li class="my-3">No products shown <a href="{{route('kits.show', $kit->id)}}" class="btn btn-sm btn-success">Add product</a></li>

                            @endif
                        </ul>
                </li>
                <li class="list-group-item">Created At: {{$kit->created_at}}</li>
                <li class="list-group-item">Updated At: {{$kit->updated_at}}</li>
            </div>
            <div class="d-block text-center w-100 my-3">
                <a href="{{route('kits.edit', $kit->id)}}" class="btn btn-primary w-25">Edit</a>
            </div>
        </div>
    </div>
@endsection
