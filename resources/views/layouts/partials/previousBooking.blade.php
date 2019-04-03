<div class="card">
    <div class="card-header">
        <h3>Previous Booking</h3>
    </div>
{{--    {{dd($currentBookings->count())}}--}}
    @if($currentBookings->count() > 0)
        <ul class="list-group">
            <li class="list-group-item">#00001 Kit 1</li>
            <li class="list-group-item">#00002 Kit 2</li>
            <li class="list-group-item">#00003 Kit 3</li>
            <li class="list-group-item">#00004 Kit 4</li>
            <li class="list-group-item">#00005 Kit 5</li>
        </ul>
    @else
        <ul class="list-group">
            <li class="list-group-item list-group-item-warning">You don't have any previous bookings</li>
        </ul>
    @endif

</div>