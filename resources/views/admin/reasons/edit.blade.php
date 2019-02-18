@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-muted my-5 col-md-8 offset-2">Edit Reason</h1>
        @include('layouts.messages.alert')
        {!! Form::open(['route' => ['reason.update', $reason->id], 'class' => 'col-md-8 offset-2']) !!}

        <div class="form-group">
            {!! Form::label('title', 'Reason Title')!!}
            {!! Form::text('title', $reason->title, ['class' => 'form-control', 'placeholder' => 'COIS-3420H-A-W01']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::text('description', $reason->description, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('expires_at', 'Expiry Date') !!}
            {!! Form::date('expires_at', $reason->expires_at, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Update Reason', ['class' => 'btn btn-primary btn-lg d-block w-100']) !!}
        </div>

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