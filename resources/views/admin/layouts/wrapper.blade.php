@extends('web.layouts.app')
@section('content')
    @include('web.layouts.header')
    <main class="main-wrapper py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-3 sidePanel">
                    @include('admin.layouts.side')
                </div>
                <div class="col-lg-9 mainPanel">
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
</script>
@endpush
