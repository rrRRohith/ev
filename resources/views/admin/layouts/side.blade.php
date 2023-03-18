<div class="bg-white shadow-none rounded-2">
    <div class="menus">
        <ul class="dropdown-menu border-0 show position-relative w-100 p-0">
            <li><a class="dropdown-item p-2 rounded-1 @selected($request->is('admin/') || $request->is('admin'))" href="{{ route('admin.index') }}">Dashboard</a></li>
            <li><a class="dropdown-item p-2 rounded-1 @selected($request->is('admin/stations*'))" href="{{ route('admin.stations.index') }}">Charging Stations</a></li>
            <li><a class="dropdown-item p-2 rounded-1 @selected($request->is('admin/cars*'))" href="{{ route('admin.cars.index') }}">EV cars</a></li>
            <li><a class="dropdown-item p-2 rounded-1" href="{{ route('auth.logout') }}" data-method="post">Logout</a></li>
        </ul>
    </div>
</div>
