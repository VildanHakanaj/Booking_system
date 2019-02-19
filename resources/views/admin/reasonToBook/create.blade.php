@extends('layouts.app')
@section('content')

    <div class="row col-md-6 offset-3">

        {!! Form::open(['route' => 'reasonToBook.store', 'method' => 'POST', 'class' => 'w-100']) !!}

        <input type="hidden" name="user_id" value="{{$user->id}}">

        <div class="form-group">

            {!! Form::label('email', 'User Email') !!}
            {!! Form::text('email', $user->email, ['disabled', 'class' => 'form-control']) !!}

        </div>

        <div class="form-group">
            {!! Form::label('reason', 'Reason') !!}
            <select name="reason_id" id="reason_id" class="form-control w-100">
                @foreach($reasons as $reason)
                    @if($reason->title != 'other')

                        <option value="{{$reason->id}}">{{$reason->title}}</option>

                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {!! Form::submit('Add Reason To Book', ['class' => 'btn btn-lg w-100 btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>

@endsection