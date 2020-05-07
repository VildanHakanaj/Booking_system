@extends('layouts.app')
@section('content')

    <div class="container">
        @include('layouts.messages.success')
        @include('layouts.messages.error')
        @include('layouts.messages.alert')
        <h1 class="text-muted mb-3 col-md-8 offset-2">Edit Booking</h1>
        {!! Form::model($booking, ['route' => ['bookings.update', $booking->id], 'method' => 'PUT', 'class' => 'col-md-8 offset-2']) !!}
        <div class="form-group">
            {!! Form::hidden('user_id', $booking->user_id) !!}
            {!! Form::text('user_name', $booking->user->name, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('User Email') !!}
            {!! Form::text('user_email', $booking->user->email, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Kit') !!}
            {!! Form::text('kit', $booking->kit->title, ['class' => 'form-control']) !!}
            {!! Form::hidden('kit_id', $booking->kit_id) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Start Date') !!}
            {!! Form::date('start_date', $booking->start_date, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('End Date') !!}
            {!! Form::date('end_date', $booking->end_date, ['class' => 'form-control']) !!}
        </div>
        {!! FOrm::submit('Save Bookings', ['class' => 'btn btn-info text-white w-100']) !!}
        {!! Form::close() !!}
    </div>

@endsection