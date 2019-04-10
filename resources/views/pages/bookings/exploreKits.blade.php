@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            <h1 class="text-muted">Kits</h1>
        </div>
        @if($kits->count() > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Kit Name</th>
                    <th scope="col">Products</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kits as $kit)
                    <tr>
                        <th scope="row">#{{$kit->id}}</th>
                        <td><a href="{{route('kits.show', $kit->id)}}">{{$kit->title}}</a></td>
                        <td>
                            @if($kit->products()->count() > 0)
                                <ul class="list-group">
                                    @foreach($kit->products() as $product)
                                        <li class="list-group-item">{{$product->title}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td><a href="#" class="btn btn-outline-success">Check Availability</a></td>
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