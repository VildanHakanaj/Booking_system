@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => 'products.search', 'method' => 'POST']) !!}
                <div class="row mt-5 mb-5">
                    {!! Form::text('search', null, ['placeholder' => 'Title, Brand, Serial Number', 'class' => 'form-control col-md-11']) !!}
                    {!! Form::submit('Search', ['class' => 'btn btn-sm btn-primary col-md-1']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div>
            <h1 class="text-muted"><a href="{{route('products.index')}}">Products</a></h1>
            <a href="{{route('products.create')}}" class="btn btn-success mb-3">Add new product</a>
        </div>
        @if($products->count() > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Description</th>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Status</th>
                    <th scope="col">Can be booked?</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                {{--If there are any users--}}
                {{--Go through all of them--}}
                @foreach($products as $product)
                    <tr>
                        <th scope="row">#{{ $product->id }}</th>

                        <td><a href="{{route('products.show', $product->id)}}">{{$product->title}}</a></td>

                        <td>{{$product->brand}}</td>

                        <td>{{$product->desc}}</td>

                        <td>{{$product->serial_number}}</td>

                        <td>{{$product->status == 1 ? 'Active' : 'Inactive'}}</td>

                        <td>{{$product->bookable == 1 ? 'Bookable' : 'Un-bookable'}}</td>

                        <td>{{$product->notes}}</td>

                        <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary">Kit</a></td>
                        <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-primary">Edit</a></td>

                    </tr>
                @endforeach
                </tbody>
                {{$products->links()}}
            </table>
        @else
            No products in the table
        @endif
    </div>
@endsection