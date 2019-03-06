@extends('layouts.app')
@section('content')
    <div class="container">

        <h3 class="text-primary"><a href="{{route('products.index')}}"><< Go Back</a></h3>
        @include('layouts.messages.success')
        <div class="card bg-light mb-3 list-group">
            <div class="card-header"><h1 class="text-muted">{{$product->title}}</h1></div>
            <div class="card-body">
                <li class="list-group-item">Title: {{$product->title}}</li>
                <li class="list-group-item">Brand: {{$product->brand}}</li>
                <li class="list-group-item">Status: {{ $product->status == 1 ? 'active' : 'Not active' }}</li>
                <li class="list-group-item">Description: {{$product->desc}}</li>
                <li class="list-group-item">Notes: {{$product->notes ?? 'N/A'}}</li>
                <li class="list-group-item">Created At: {{$product->created_at}}</li>
                <li class="list-group-item">Updated At: {{$product->updated_at}}</li>
            <div class="d-block text-center w-100 my-3">
                <a href="{{route('products.edit', $product->id)}}" class="btn btn-primary btn-lg w-100">Edit</a>
            </div>
        </div>
    </div>
@endsection