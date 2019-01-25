@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="col-md-8 offset-2 text-muted">Welcome {{$user->name}}</h1>
        <h3 class="col-md-8 offset-2 text-muted my-5">Complete registration</h3>
        {{--Error messages--}}
        @include('layouts.messages.alert')
        {!! Form::open(['route' => ['verify.update', $user->id], 'method' => 'PUT', 'class' => 'col-md-8 offset-2']) !!}
        <div class="form-group">
            {!! Form::label('home_address', 'Home Address') !!}
            {!! Form::text('home_address', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('phone_number', 'Phone Number') !!}
            {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirm Password') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('submit', ['class' => 'btn btn-primary btn-lg w-100']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection