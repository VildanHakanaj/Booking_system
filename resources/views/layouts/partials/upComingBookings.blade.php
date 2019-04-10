<div class="card">
    <div class="card-header">
        <h1>Up Coming Bookings</h1>
    </div>
    <div class="card-body">
        @if($upComingBookings->count() > 0)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">User</th>
                    <th scope="col">Kit</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($upComingBookings as $upComingBooking)
                    <tr>
                        <th scope="row">{{$upComingBooking->user->name}}</th>
                        <td>{{$upComingBooking->kit->title}}</td>
                        <td>{{$upComingBooking->start_date}}</td>
                        <td>{{$upComingBooking->end_date}}</td>
                        <td><a href="{{route('bookings.show', $upComingBooking->id)}}" class="btn btn-sm btn-info">Details</a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>
        @else
            <ul class="list-group">
                <li class="list-group-item list-group-item-warning">There are no up coming bookings today...</li>
            </ul>
        @endif
    </div>
    <div class="card-footer"></div>
</div>


{{--<ul class="list-group">--}}
{{--    @foreach($upComingBookings as $upComingBooking)--}}
{{--        <li class="list-group-item">--}}
{{--            User: <a href="{{route('users.show', $upComingBooking->user->id)}}">{{$upComingBooking->user->name}}</a> |--}}
{{--            Kit: <a href="{{route('kits.show', $upComingBooking->kit->id)}}">{{$upComingBooking->kit->title}}</a> |--}}
{{--            Start Date: {{$upComingBooking->start_date}} |--}}
{{--            End Date: {{$upComingBooking->end_date}}--}}
{{--            <a href="{{route('bookings.show', $upComingBooking->id)}}" class="btn btn-sm mt-2 ml-5 btn-info">View Details</a>--}}
{{--        </li>--}}
{{--    @endforeach--}}
{{--</ul>--}}