@extends('layouts.app')
@section('content')
    <div class="row col-md-6 offset-3">
        @include('layouts.messages.success')
        <h1>Edit {{$kit->title}} kit</h1>
        {!! Form::model($kit, ['route' => ['kits.update', $kit->id], 'method' => 'PUT', 'class' => 'w-100']) !!}

        <div class="form-group">
            {!! Form::label('title', 'Kit name') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Kit 1 or Canon Kit']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('booking_window', 'Booking window') !!}
            {!! Form::number('booking_window', null, ['class' => 'form-control', 'placeholder' => '2 Days', 'min' => 0]) !!}
            <small class="text-muted">The booking windows will be in days so enter a number of days</small>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                {!! Form::checkbox('status', null) !!}
                {!! Form::label('status', 'Allow the kit to be booked') !!}
            </div>
            <div class="form-group col-md-5">
                {!! Form::checkbox('back_to_back', null) !!}
                {!! Form::label('back_to_back', 'Allow to check the kit back to back') !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::submit('Edit Kit', ['class' => 'btn btn-lg w-100 btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>

@endsection