@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-muted my-5 col-md-8 offset-2">Add a new user</h1>
        @if($errors->any())
        <div class="alert alert-danger col-md-8 offset-2" role="alert">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </div>
        @endif
        {!! Form::open(['route' => 'users.store', 'class' => 'col-md-8 offset-2']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['value' => old('name'), 'class' => 'form-control', 'required', 'placeholder' => 'First Name Last Name']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('stdn', 'Student Number') !!}
            {!! Form::text('stdn', null, ['class' => 'form-control', 'required', 'placeholder' => '#0592373']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder' => 'email@mail.com']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '***']) !!}
            <small class="form-text text-muted"> Leave empty for password to be auto generated</small>
        </div>
        <div class="form-group">
            {!! Form::select('type',[
            'Students' => ['C' => 'Current Student', 'I' => 'Intern'],
            'Other' => ['F' => 'Faculty', 'A' => 'Alumni'],
            ])!!}
        </div>

        <div class="form-group">
            {!! Form::label('admin', 'Admin') !!}
            {!! Form::checkbox('admin') !!}
        </div>
        {!! Form::submit('Add User', ['class' => 'btn btn-primary btn-lg d-block w-100']) !!}
        {!! Form::close() !!}
    </div>
@endsection