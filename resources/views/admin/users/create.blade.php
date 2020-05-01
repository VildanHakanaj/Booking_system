@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-muted my-5 col-md-8 offset-2">Add a new user</h1>

        @include('layouts.messages.alert')

        {!! Form::open(['route' => 'users.store', 'class' => 'col-md-8 offset-2', 'files' => true]) !!}
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-muted">User</h3>
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['value' => old('name'), 'class' => 'form-control', 'placeholder' => 'First Name Last Name']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('stdn', 'Student Number') !!}
                    {!! Form::text('stdn', null, ['class' => 'form-control', 'placeholder' => '#0592373']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email@mail.com']) !!}
                </div>
            </div>
            <div class="col-md-6">
                {{-- REASON --}}
                <h3 class="text-muted">Reason</h3>
                <div class="form-group">

                    {!! Form::label('reasons', 'Choose a reason') !!}

                    <select name="reasons" id="reasons" class="form-control">
                        @if($reasons->count() > 0)
                            <option value="other">Other</option>
                            @foreach($reasons as $reason)
                                @if($reason->title != 'other')
                                    <option value="{{$reason->title}}">{{$reason->title}}</option>
                                @endif();
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        {!! Form::label('roster', 'Add roster') !!}
                        {!! Form::file('roster', null, ['class' => 'custom-file-input']) !!}
                    </div>
                </div>
            </div>
        </div>

        {!! Form::submit('Add User', ['class' => 'btn btn-primary btn-lg d-block w-100']) !!}
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