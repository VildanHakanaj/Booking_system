@extends('layouts.app')
@section('content')
@include('layouts.messages.alert')
    <div class="row col-md-6 offset-3">
        <h1>Add a product to {{$kit->title}}</h1>
        {!! Form::open(['route' => 'kitProduct.store', 'method' => 'POST', 'class' => 'w-100']) !!}
        @include('layouts.messages.success')

        <input type="hidden" name="kit_id" value="{{$kit->id}}">

        <div class="form-group">
            {!! Form::label('title', 'Kit Title') !!}
            {!! Form::text('title', $kit->title, ['disabled', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('product', 'Product you want to add') !!}
            <select name="product_id" id="product_id" class="form-control w-100">
                @foreach($products as $product)
                    @if($product->title != 'other')
                        <option value="{{$product->id}}">{{$product->title}} ( {{$product->serial_number}} )</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {!! Form::submit('Add product to kit', ['class' => 'btn btn-lg w-100 btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>

@endsection