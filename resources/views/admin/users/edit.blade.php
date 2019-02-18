@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-muted col-md-8 offset-2">Edit User</h1>
        @include('layouts.messages.alert')

        {!! Form::open(['route' => ['users.update', $user->id], 'method' => 'PUT', 'class' => 'col-md-8 offset-2']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', $user->name, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'email') !!}
            {!! Form::text('email', $user->email, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('stdn', 'Student Number') !!}
            {!! Form::text('stdn', $user->stdn, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('home_address', 'Home Address') !!}
            {!! Form::text('home_address', $user->home_address, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('phone_number', 'Phone Number') !!}
            {!! Form::text('phone_number', $user->phone_number, ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class'=> 'form-control']) !!}
            <small class="text-muted form-text">Leave password empty if you dont want to change it.</small>
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirm Password') !!}
            {!! Form::password('password_confirmation', ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('admin', 'Admin') !!}
            {!! Form::checkbox('admin', 'checked') !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Save User', ['class' => 'btn btn-lg btn-success']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection