@extends('layouts.app')
@section('content')


    <div class="row col-md-6 offset-3">
        @include('layouts.messages.success')
        <h1>Add a new kit</h1>
        {!! Form::open(['route' => 'kits.store', 'method' => 'POST', 'class' => 'w-100']) !!}

        <div class="form-group">
            {!! Form::label('title', 'Kit name') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Kit 1 or Canon Kit']) !!}
        </div>
            <div class="form-group">
            {!! Form::submit('Add Kit', ['class' => 'btn btn-lg w-100 btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>

@endsection