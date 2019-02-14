@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-muted my-5 col-md-8 offset-2">Add a new reason</h1>
        @include('layouts.messages.alert')
        {!! Form::open(['route' => 'reason.store', 'class' => 'col-md-8 offset-2']) !!}
        {{-- REASON --}}

        <div class="form-group">
            {!! Form::label('title', 'Reason Title')!!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'COIS-3420H-A-W01']) !!}
            {{--<small class="helper">Please enter the correct format</small>--}}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::text('description', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('expires_at', 'Expiry Date') !!}
            {!! Form::date('expires_at', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Add Reason', ['class' => 'btn btn-primary btn-lg d-block w-100']) !!}
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