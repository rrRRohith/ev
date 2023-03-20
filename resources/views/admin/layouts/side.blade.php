<div class="col-md-3 sidePanel d-none d-md-block">
    <div class="bg-white shadow-none rounded-2">
        <div class="menus d-none d-md-block">
            <ul class="dropdown-menu border-0 show position-relative w-100 p-0">
                <li><a class="dropdown-item p-2 rounded-1 @selected($request->is('admin/') || $request->is('admin'))"
                        href="{{ route('admin.index') }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li><a class="dropdown-item p-2 rounded-1 @selected($request->is('admin/stations*'))"
                        href="{{ route('admin.stations.index') }}"><i class="fa-solid fa-bolt"></i> Stations</a></li>
                <li><a class="dropdown-item p-2 rounded-1 @selected($request->is('admin/cars*'))"
                        href="{{ route('admin.cars.index') }}"><i class="fa-solid fa-car"></i> Cars</a></li>
                <li><a class="dropdown-item p-2 rounded-1" href="{{ route('auth.logout') }}" data-method="post"><i
                            class="fa-solid fa-right-from-bracket" data-confirm="Are you sure want to logout?"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="d-block d-md-none">
    <div class="w-100 m-menus position-fixed z-100 bottom-0 end-0 w-auto p-2 pb-5" style="display:none">
        <ul class="dropdown-menu border-0 show position-relative w-100 p-0 shadow-sm">
            <li><a class="dropdown-item p-2 rounded-1 @selected($request->is('admin/') || $request->is('admin'))" href="{{ route('admin.index') }}"><i
                        class="fa-solid fa-gauge"></i> Dashboard</a></li>
            <li><a class="dropdown-item p-2 rounded-1 @selected($request->is('admin/stations*'))"
                    href="{{ route('admin.stations.index') }}"><i class="fa-solid fa-bolt"></i> Stations</a></li>
            <li><a class="dropdown-item p-2 rounded-1 @selected($request->is('admin/cars*'))"
                    href="{{ route('admin.cars.index') }}"><i class="fa-solid fa-car"></i> Cars</a></li>
            <li><a class="dropdown-item p-2 rounded-1" href="{{ route('auth.logout') }}" data-method="post"><i
                        class="fa-solid fa-right-from-bracket" data-confirm="Are you sure want to logout?"></i> Logout</a></li>
        </ul>
    </div>
</div>
<span class="position-fixed z-50 bottom-0 end-0 w-auto p-2 pb-5 d-block d-md-none">
    <i class="toggler fa-brands fa-elementor display-1 text-primary"></i>
</span>
