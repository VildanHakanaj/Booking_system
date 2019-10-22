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
                    <input class="mr-3  align-middle" type="checkbox" name="monday" id="monday"
                           @foreach($checkInTime as $day)@if($day->day === 'monday')) checked @endif @endforeach>
                    <label for="tuesday">Tuesday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="tuesday" id="tuesday"
                           @foreach($checkInTime as $day)@if($day->day === 'tuesday')) checked @endif @endforeach>
                    <label for="wednesday">Wednesday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="wednesday" id="wednesday"
                           @foreach($checkInTime as $day)@if($day->day === 'wednesday')) checked @endif @endforeach>
                    <label for="thursday">Thursday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="thursday" id="thursday"
                           @foreach($checkInTime as $day)@if($day->day === 'thursday')) checked @endif @endforeach>
                    <label for="friday">Friday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="friday" id="friday"
                           @foreach($checkInTime as $day)@if($day->day === 'friday')) checked @endif @endforeach>
                    <label for="saturday">Saturday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="saturday" id="saturday"
                           @foreach($checkInTime as $day)@if($day->day === 'saturday')) checked @endif @endforeach>
                    <label for="sunday">Sunday</label>
                    <input class="mr-3  align-middle" type="checkbox" name="sunday" id="sunday"
                           @foreach($checkInTime as $day)@if($day->day === 'sunday')) checked @endif @endforeach>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="card">
                <div class="card-header">
                    <h3>Monday</h3>
                </div>
                <textarea name="monday_time" id="monday_time" cols="30" rows="5">@foreach($checkInTime as $day)@if($day->day === 'monday'){{$day->hours}} @endif @endforeach
                </textarea>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Tuesday</h3>
                </div>
                <textarea name="tuesday_time" id="tuesday_time" cols="30" rows="5">@foreach($checkInTime as $day)@if($day->day === 'tuesday'){{$day->hours}} @endif @endforeach

                </textarea>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Wednesday</h3>
                </div>
                <textarea name="wednesday_time" id="wednesday_time" cols="30" rows="5">@foreach($checkInTime as $day)@if($day->day === 'wednesday'){{$day->hours}} @endif @endforeach

                </textarea>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Thursday</h3>
                </div>
                <textarea name="thursday_time" id="thursday_time" cols="30" rows="5">@foreach($checkInTime as $day)@if($day->day === 'thursday'){{$day->hours}} @endif @endforeach

                </textarea>
            </div>
        </div>
        <div class="row mt-5">
            <div class="card">
                <div class="card-header">
                    <h3>Friday</h3>
                </div>
                <textarea name="friday_time" id="friday_time" cols="30" rows="5">@foreach($checkInTime as $day)@if($day->day === 'friday'){{$day->hours}} @endif @endforeach

                </textarea>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Saturday</h3>
                </div>
                <textarea name="saturday_time" id="saturday_time" cols="30" rows="5">@foreach($checkInTime as $day)@if($day->day === 'saturday'){{$day->hours}} @endif @endforeach

                </textarea>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Sunday</h3>
                </div>
                <textarea name="sunday_time" id="sunday_time" cols="30" rows="5">@foreach($checkInTime as $day)@if($day->day === 'sunday'){{$day->hours}} @endif @endforeach

                </textarea>
            </div>
        </div>
        <div class="row mt-5">
            {!! Form::label('end_date', 'End Date') !!}
            {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
            <small class="small">Generate the calendar until this date!</small>
        </div>
        {!! Form::submit('submit', ['class' => 'btn btn-success w-100 mt-4']) !!}
        {!! Form::close() !!}
    </div>
@endsection