<div class="card">
    <div class="card-header">
        <h1>Today's Bookings</h1>
    </div>
    <div class="card-body">
        @if($todaysBookings->count() > 0)
            <ul class="list-group">
                @foreach($todaysBookings as $booking)
                    <li class="list-group-item">{{$booking}}</li>
                @endforeach
            </ul>
        @else
            <ul class="list-group">
                <li class="list-group-item list-group-item-warning">There are no bookings today...</li>
            </ul>
        @endif
    </div>
    <div class="card-footer"></div>
</div>