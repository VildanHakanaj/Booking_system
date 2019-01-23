@extends('layouts.app')
@section('content')
    <div class="container">
        {!! Form::open(['route' => ['auth.', $user->id], 'method' => 'PUT', 'class' => 'col-md-8 offset-2') !!}
            <div class="form-group">
                {!! From::label('home_address', 'Home Address') !!}
                {!! Form::text('home_address', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! From::label('phone_number', 'Phone Number') !!}
                {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! From::label('password', 'Password') !!}
                {!! Form::password('password', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! From::label('password_confirmation', 'Confirm Password') !!}
                {!! Form::text('password_confirmation', null, ['class' => 'form-control']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection