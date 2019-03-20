@extends('layouts.app')
@section('content')
    {{--@include('layouts.partials.modal')--}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => 'kits.search', 'method' => 'POST']) !!}
                <div class="row offset-4">
                    {!! Form::text('search', null, ['placeholder' => 'Title', 'class' => 'form-control col-md-3']) !!}
                    {!! Form::submit('Search', ['class' => 'btn btn-sm btn-primary col-md-1']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div>
            <h1 class="text-muted"><a href="{{route('kits.index')}}">Kits</a></h1>
            <a href="{{route('kits.create')}}" class="btn btn-success mb-3">Add New Kit</a>
        </div>
        @if($kits->count() > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Kit Name</th>
                    <th scope="col">Bookable</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kits as $kit)
                    <tr>
                        <th scope="row">#{{$kit->id}}</th>
                        <td><a href="{{route('kits.show', $kit->id)}}">{{$kit->title}}</a></td>
                        <td>{{$kit->status == 1 ? 'Active' : 'Not Active'}}</td>
                        <td>
                            <a href="{{route('kits.edit', $kit->id)}}" class="btn btn-sm btn-outline-primary">Edit</a>
                            {!! Form::open( ['route' => ['kits.destroy', $kit->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-sm', 'id' => 'delete', 'data-toggle'=>'modal', 'data-target' => '#exampleModalCenter']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @else
                    No kits created
                @endif
                {{$kits->links()}}
            </table>
    </div>
@endsection