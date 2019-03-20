@extends('layouts.app')
@section('content')
    <div class="container">
        <h3 class="text-primary"><a href="{{route('kits.index')}}">< Go Back</a></h3>
        @include('layouts.messages.success')
        <div class="card bg-light mb-3 list-group">
            <div class="card-header"><h1 class="text-muted">{{$kit->title}}</h1></div>
            <div class="card-body">
                <li class="list-group-item">Bookable: {{ $kit->status == 0 ? 'Active' : 'Not Active' }}</li>
                <li class="list-group-item">Booking window: {{$kit->booking_window}} day(s)</li>
                <li class="list-group-item">
                    Products
                    <ul>
                        @if($products->count() > 0)
                            @foreach($products as $product)
                                <li class="mb-2 d-flex justify-content-between">{{$product->title}} <a href="{{route('kitProduct.removeProduct', $product->id)}}" class="btn btn-sm btn-danger">Remove</a></li>
                            @endforeach
                        @else
                            <li class="my-3">No products in this kit</li>
                        @endif
                        <div>
                            <a href="{{route('kitProduct.create', $kit->id)}}" class="btn btn-sm btn-success">Add
                                product</a>
                            <a href="{{route( 'kitProduct.removeAll', $kit->id )}}" class="btn btn-sm btn-danger">Remove all</a>
                        </div>
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
