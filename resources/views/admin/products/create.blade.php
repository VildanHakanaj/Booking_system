@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-muted my-5 col-md-8 offset-2">Add a new product</h1>

        @include('layouts.messages.alert')

        {!! Form::open(['route' => 'products.store', 'class' => 'col-md-8 offset-2']) !!}
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-muted">Products</h3>
                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', null, ['value' => old('title'), 'class' => 'form-control', 'placeholder' => 'Canon Pixma S1215']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('brand', 'Brand') !!}
                    {!! Form::text('brand', null, ['class' => 'form-control', 'placeholder' => 'Canon']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('desc', 'Email') !!}
                    {!! Form::textarea('desc', null, ['class' => 'form-control', 'placeholder' => 'Enter a description for the equipment']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('serial_number', 'Serial Number') !!}
                    {!! Form::text('serial_number', null, ['class' => 'form-control', 'placeholder' => '12546F454A64GG']) !!}
                </div>

                <div class="form-group">
                    <input type="checkbox" name="bookable" id="bookable">
                    <label for="bookable">
                        Bookable
                    </label>
                </div>
                <div class="form-group">
                    <select name="kit_name" id="kit_name" disabled>
                        <option value="1">Single</option>
                        <option value="2">kit 1</option>
                        <option value="3">Kit 2</option>
                        <option value="4">Kit 3</option>
                    </select>
                </div>


                {{--<div class="form-group">--}}
                    {{--{!! Form::checkbox('bookable', null) !!}--}}
                    {{--{!! Form::label('bookable', 'Bookable')!!}--}}
                {{--</div>--}}
            </div>
        </div>

        {!! Form::submit('Add product', ['class' => 'btn btn-primary btn-lg d-block w-100']) !!}
        {!! Form::close() !!}
    </div>
@endsection

