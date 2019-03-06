@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-muted my-5 col-md-8 offset-2">Edit Product</h1>
        @include('layouts.messages.alert')
        {!! Form::open(['route' => ['products.update', $product->id], 'method' => 'PUT', 'class' => 'col-md-8 offset-2']) !!}

        <div class="form-group">
            {!! Form::label('title', 'Reason Title')!!}
            {!! Form::text('title', $product->title, ['class' => 'form-control', 'placeholder' => 'COIS-3420H-A-W01']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('brand', 'Brand') !!}
            {!! Form::text('brand', $product->brand, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('desc', 'Description') !!}
            {!! Form::textarea('desc', $product->desc, ['class' => 'form-control', 'rows'=> '3']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('serial_number', 'Serial Number') !!}
            {!! Form::text('serial_number', $product->serial_number, ['class' => 'form-control', 'placeholder' => '1231243EEED']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('maintenance', 'Notes') !!}
            {!! Form::date('maintenance', $product->maintenance, ['class' => 'form-control', 'rows' => '3', 'placeholder'=> 'Notes...']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('notes', 'Notes') !!}
            {!! Form::textarea('notes', $product->notes, ['class' => 'form-control', 'rows' => '3', 'placeholder'=> 'Notes...']) !!}
        </div>

        <div class="form-group">
            <input type="checkbox" name="status" id="status" class="form-ch" @if($product->status == 1) checked @endif>
            {!! Form::label('status', 'Active', ['class' => 'form-label-checkbox']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update Reason', ['class' => 'btn btn-primary btn-lg d-block w-100']) !!}
        </div>

        {!! Form::close() !!}

    </div>
@endsection
@section('scripts')
    <script>
        new Vue({
            el: #app,
            data: {
                isActive: true,

            }
        });
    </script>
@endsection