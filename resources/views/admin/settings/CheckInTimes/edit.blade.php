@extends('layouts.app')
@section('content')
    <div class="container">
        @include('layouts.messages.alert')
        {!! Form::open(['route' => 'checkInTimes.store', 'method' => 'POST']) !!}
        <h1>Check In Times</h1>
        <div class="row">
            <div class="card">
                <div class="form-group p-3">
                    <label for="monday">Monday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="monday" id="monday">
                    <label for="tuesday">Tuesday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="tuesday" id="tuesday">
                    <label for="wednesday">Wednesday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="wednesday" id="wednesday">
                    <label for="thursday">Thursday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="thursday" id="thursday">
                    <label for="friday">Friday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="friday" id="friday">
                    <label for="saturday">Saturday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="saturday" id="saturday">
                    <label for="sunday">Sunday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="sunday" id="sunday">
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="card">
                <div class="card-header">
                    <h3>Monday</h3>
                </div>
                <textarea name="monday_time" id="monday_time" cols="30" rows="5"></textarea>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>tuesday</h3>
                </div>
                <textarea name="tuesday_time" id="tuesday_time" cols="30" rows="5"></textarea>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>wednesday</h3>
                </div>
                <textarea name="wednesday_time" id="wednesday_time" cols="30" rows="5"></textarea>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>thursday</h3>
                </div>
                <textarea name="thursday_time" id="thursday_time" cols="30" rows="5"></textarea>
            </div></div>
        <div class="row mt-5">
            <div class="card">
                <div class="card-header">
                    <h3>friday</h3>
                </div>
                <textarea name="friday_time" id="friday_time" cols="30" rows="5"></textarea>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Saturday</h3>
                </div>
                <textarea name="saturday_time" id="saturday_time" cols="30" rows="5"></textarea>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Sunday</h3>
                </div>
                <textarea name="sunday_time" id="sunday_time" cols="30" rows="5"></textarea>
            </div>
        </div>
        {!! Form::submit('submit', ['class' => 'btn btn-success w-100 mt-4']) !!}
        {!! Form::close() !!}
    </div>
@endsection