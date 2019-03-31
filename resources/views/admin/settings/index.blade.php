@extends('layouts.app')
@include('layouts.messages.success')
@section('content')

    <div class="container">
        <h1>Settings</h1>
        {!! Form::open(['route' => 'bookingSettings.store', 'method' => 'POST']) !!}
            <div class="row settings">
                <div class="card">
                    <div class="row m-3">
                        <div class="form-group mr-3">
                            {!! Form::label('Monday') !!}
                            {!! Form::checkbox('monday') !!}
                        </div>
                        <div class="form-group mr-3">
                            {!! Form::label('tuesday') !!}
                            {!! Form::checkbox('tuesday') !!}
                        </div>
                        <div class="form-group mr-3">
                            {!! Form::label('Wednesday') !!}
                            {!! Form::checkbox('wednesday') !!}
                        </div>
                        <div class="form-group mr-3">
                            {!! Form::label('Thursday') !!}
                            {!! Form::checkbox('thursday') !!}
                        </div>
                        <div class="form-group mr-3">
                            {!! Form::label('Friday') !!}
                            {!! Form::checkbox('friday') !!}
                        </div>
                        <div class="form-group mr-3">
                            {!! Form::label('Saturday') !!}
                            {!! Form::checkbox('saturday') !!}
                        </div>
                        <div class="form-group mr-3">
                            {!! Form::label('Sunday') !!}
                            {!! Form::checkbox('sunday') !!}
                        </div>
                    </div>
                </div>
            </div>
            {{--END OF TOP ROW--}}
            <div class="row mt-3">
                <div class="col-md-4">

                    <div class="card">
                        <div class="card-header">
                            <h3>Monday Times</h3>
                        </div>
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card p-3">
                        @include('admin.settings.calendar')
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    @include('layouts.partials.ckeditor')
@endsection