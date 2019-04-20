@extends('layouts.app')
@section('content')
    <div class="container">
        @include('layouts.messages.error')
        @include('layouts.messages.alert')
        <h1 class="text-muted">Create a booking</h1>
        {!! Form::open(['route' => 'bookings.store', 'method' => 'POST', 'class' => 'col-md-8 offset-2']) !!}
        <div class="form-group">
            {!! Form::label('User') !!}
            <input list="users" name="user_id" class="form-control">
            <datalist id="users">
                @if($users)
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                @endif
            </datalist>
        </div>
        <div class="form-group">
            {!! Form::label('Kit') !!}
            <input list="kits" name="kit_id" class="form-control">
            <datalist id="kits">
                @if($kits)
                    @foreach($kits as $kit)
                        @if($kit->products()->count() > 0)
                            <option value="{{$kit->id}}">{{$kit->title}}</option>
                        @endif
                    @endforeach
                @endif
            </datalist>
        </div>
        <div class="from-group">
            {!! Form::label('start_date', 'Start Date') !!}
            {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
        </div>
        <div class="from-group">
            {!! Form::label('end_date', 'End Date') !!}
            {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Create Booking', ['class'=> 'btn btn-info text-white w-100 mt-3']) !!}
        {!! Form::close() !!}
    </div>
@endsection
