@extends('layouts.app')
@section('content')

    <div class="container">
        @include('layouts.messages.success')
        <h1>Settings</h1>
        <div class="row">
            <div class="card col-md-12">
                @if($days->count() > 0)
                    <ul class="list-group list-group-flush">
                        <h3 class="m-3">Days and times <a href="{{route('checkInTimes.edit')}}" class="btn btn-sm btn-success">Edit</a></h3>
                        @foreach($days as $day)
                            <li class="list-group-item">{{$day->day}} {{$day->hours}}</li>
                        @endforeach
                    </ul>
                @endif
                <ul class="list-group list-group-flush">
                    <h3 class="m-3">Default Days</h3>
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
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