@extends('layouts.app')
@include('layouts.messages.success')
@section('content')

    <div class="container">
        <h1>Settings</h1>
        <div class="row"> <!-- FIRST ROW -->
            <div class="col-md-6">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="monday">Monday</label>
                                <input type="checkbox" class="align-middle " name="monday" id="monday" class="">
                            </div>
                            <div class="form-group">
                                <label for="monday">Tuesday</label>
                                <input type="checkbox" class="align-middle " name="monday" id="monday" class="">
                            </div>
                            <div class="form-group">
                                <label for="monday">Wednesday</label>
                                <input type="checkbox" class="align-middle " name="monday" id="monday" class="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="monday">Thursday</label>
                                <input type="checkbox" class="align-middle " name="monday" id="monday" class="">
                            </div>
                            <div class="form-group">
                                <label for="monday">Friday</label>
                                <input type="checkbox" class="align-middle " name="monday" id="monday" class="">
                            </div>
                            <div class="form-group">
                                <label for="monday">Saturday</label>
                                <input type="checkbox" class="align-middle " name="monday" id="monday" class="">
                            </div>
                            <div class="form-group">
                                <label for="monday">Sunday</label>
                                <input type="checkbox" class="align-middle " name="monday" id="monday" class="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 card p-3">

                <div class="form-group">
                    <label for="times">Number of times</label>
                    <input type="number" name="times" class="form-control" placeholder="2">
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="startTime">Start</label>
                        <input placeholder="" type="time" name="startTime" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="endTime">End</label>
                        <input type="time" name="endTime" class="form-control">
                    </div>
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
    </div>

@endsection