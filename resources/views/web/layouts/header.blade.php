<nav class="navbar navbar-expand fixed-top navbar-light bg-white shadow-none" id="mainHeader">
    <div class="container d-flex align-items-center">
        <div class="d-flex align-items-center">
            <a class="app-brand text-dark text-decoration-none mb-0 me-auto fw-bolder text-lowercase fs-2"
                href="{{ route('home') }}">{{ $app->name }} </a>
            <a href="{{ route('map.index') }}" class="text-primary text-decoration-none ms-2 mt-2 plan-route">Plan a route
                <i class="fa-solid fa-route"></i></a>
        </div>
        <div class="collapse navbar-collapse ms-auto">
            <ul class="navbar-nav align-items-center me-0 ms-auto h6">
                <li class="nav-item">
                    <div class="dropdown profile-dropdown">
                        <div class="cursor-pointer" data-bs-toggle="dropdown">
                            <a class="nav-link active fw-semibold" aria-current="page" href="#">Menu</a>
                        </div>
                        <ul class="dropdown-menu border-0 dropdown-menu-end shadow-sm mt-3 p-0">
                            @admin
                                <li><a class="dropdown-item p-2 rounded-1" href="{{ route('admin.index') }}">Dashboard</a>
                                </li>
                            @endadmin
                            @guest
                                <li><a class="dropdown-item p-2 rounded-1 login" href="#">Login</a></li>
                            @else
                                <li><a class="dropdown-item p-2 rounded-1 routes" href="#" data-bs-toggle="modal" data-bs-target="#savedModal">Saved routes</a></li>
                                <li><a class="dropdown-item p-2 rounded-1" data-method="post"
                                        href="{{ route('auth.logout') }}" data-confirm="Are you sure want to logout?">Logout</a></li>
                                @endif
                                <li><a class="dropdown-item p-2 rounded-1" href="#">About us</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @auth
    @include('web.partials.saved')
    @else
        @include('web.partials.login')
        @push('scripts')
            <script>
                $('document').ready(function() {
                    $('.login').on('click', function() {
                        popLogin()
                    });
                });
                @if ($request->has('login'))
                    $(function() {
                        popLogin()
                    })
                @endif
                $('.plan-route').on('click', function(e) {
                    e.preventDefault();
                    popLogin();
                })
                $('.auth-modal').on('hidden.bs.modal', function() {
                    $(this).find('form').trigger('reset');
                    $(this).find('.form-group.error').removeClass('error');
                });
                $('.auth-modal').on('shown.bs.modal', function() {
                    $(this).find('form').trigger('reset');
                    $(this).find('.form-group.error').removeClass('error');
                })
            </script>
        @endpush
        @endif
