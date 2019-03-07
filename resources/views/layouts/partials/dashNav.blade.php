<div class="nav-scroller bg-white shadow-sm col-sm-12">
    <nav class="nav nav-underline col-md-8 offset-2">
        <a class="nav-link active" href="{{route("admin.dashboard")}}">Dashboard</a>
        <a class="nav-link" href="{{route('users.index')}}">
            Users
            <span class="badge badge-primary ">{{$users->count()}}</span>
        </a>
        <a class="nav-link" href="{{route('products.index')}}">
            Products
            <span class="badge badge-primary ">{{$products->count()}}</span>
        </a>
        <a class="nav-link" href="{{route('reason.index')}}">
            Reasons
            <span class="badge badge-primary ">{{$reasons->count()}}</span>
        </a>
        <a class="nav-link" href="{{route('kits.index')}}">
            Kits
            <span class="badge badge-primary ">{{$kits->count()}}</span>
        </a>
    </nav>
</div>