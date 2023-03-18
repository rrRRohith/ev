<nav class="navbar navbar-expand fixed-top navbar-light bg-white shadow-none" id="mainHeader">
    <div class="container d-flex align-items-center">
        <a class="app-brand text-dark text-decoration-none mb-0 me-auto fw-bolder text-lowercase fs-2"
            href="{{ route('home') }}">{{ $app->name }} </a>
        <div class="collapse navbar-collapse ms-auto">
            <ul class="navbar-nav align-items-center me-0 ms-auto h6">
                <li class="nav-item">
                    <div class="dropdown profile-dropdown">
                        <div class="cursor-pointer" data-bs-toggle="dropdown">
                            <a class="nav-link active fw-semibold" aria-current="page" href="#">Menu</a>
                        </div>
                        <ul class="dropdown-menu border-0 dropdown-menu-end shadow-sm mt-3 p-0">
                            @admin
                            <li><a class="dropdown-item p-2 rounded-1" href="{{ route('admin.index') }}">Dashboard</a></li>
                            @endadmin
                            
                            @guest
                            <li><a class="dropdown-item p-2 rounded-1 login" href="#">Login</a></li>
                            @else
                            <li><a class="dropdown-item p-2 rounded-1" data-method="post" href="{{ route('auth.logout') }}">Logout</a></li>
                            @endif
                            <li><a class="dropdown-item p-2 rounded-1" href="#">About us</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
@guest
@include('web.layouts.login')
@endif
@push('scripts')
    <script>
        $('document').ready(function() {
            $('.login').on('click', function(){
                popLogin()
            });
        });
    </script>
@endpush
