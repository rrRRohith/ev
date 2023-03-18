@extends('web.layouts.app')
@section('content')
@include('web.layouts.header')
<main class="main-wrapper py-5">
    <div class="container pt-5">
        @yield('contents')
    </div>
</main>
@include('web.layouts.footer')
@endsection