@extends('layouts.app')
@include('layouts.messages.success')
@section('content')

    <div class="container">
        <h1>Settings</h1>
        <div class="row settings">
            <div class="card">
                <div class="row m-3">
                    <div class="form-group mr-3">
                        <label for="monday">Monday</label>
                        <input type="checkbox" name="monday" id="monday">
                    </div>
                    <div class="form-group mr-3">
                        <label for="monday">Tuesday</label>
                        <input type="checkbox" name="monday" id="monday">
                    </div>
                    <div class="form-group mr-3">
                        <label for="monday">Wednesday</label>
                        <input type="checkbox" name="monday" id="monday">
                    </div>
                    <div class="form-group mr-3">
                        <label for="monday">Thursday</label>
                        <input type="checkbox" name="monday" id="monday">
                    </div>
                    <div class="form-group mr-3">
                        <label for="monday">Friday</label>
                        <input type="checkbox" name="monday" id="monday">
                    </div>
                    <div class="form-group mr-3">
                        <label for="monday">Saturday</label>
                        <input type="checkbox" name="monday" id="monday">
                    </div>
                    <div class="form-group mr-3">
                        <label for="monday">Sunday</label>
                        <input type="checkbox" name="monday" id="monday">
                    </div>
                </div>
            </div>
        </div>
        {{--END OF TOP ROW--}}

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card p-3">
                    @include('admin.settings.calendar')
                </div>
            </div>
        </div>
    </div>
    </form>
    @include('layouts.partials.ckeditor')
@endsection