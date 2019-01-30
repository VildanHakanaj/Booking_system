<div class="nav-scroller bg-white shadow-sm col-sm-12">
    <nav class="nav nav-underline col-md-8 offset-2">
        <a class="nav-link active" href="{{route("admin.dashboard")}}">Dashboard</a>
        <a class="nav-link" href="{{route('users.index')}}">
            Users
            <span class="badge badge-primary ">{{$users->count()}}</span>
        </a>
        <a class="nav-link" href="#">
            Products
            <span class="badge badge-primary ">50</span>
        </a>
    </nav>
</div>