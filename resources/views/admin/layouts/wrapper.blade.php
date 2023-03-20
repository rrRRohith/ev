@extends('web.layouts.app')
@section('content')
    @include('web.layouts.header')
    <main class="main-wrapper">
        <div class="container py-5">
            <div class="row">
                @include('admin.layouts.side')
                <div class="col-md-9 mainPanel">
                    <div class="p-4 w-100 shadow-none bg-white rounded-2">
                        @yield('contents')
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('web.layouts.footer')
@endsection
@push('scripts')
    <script>
        $(function() {
            $('.sidePanel, .mailPanel').theiaStickySidebar({
                additionalMarginTop: 100
            });
        })
        $('.toggler').on('click', function() {
            $('.m-menus').slideDown();
        })
        $(document).click(function(event) {
            var $target = $(event.target);
            if (!$target.closest('.m-menus').length &&
                $('.m-menus').is(":visible") && !$target.closest('.toggler').length) {
                $('.m-menus').slideUp();
            }
        });
    </script>
@endpush
