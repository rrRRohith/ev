@extends('web.layouts.app')
@section('content')
@include('web.layouts.header')
<main class="main-wrapper">
    <div class="container py-5">
        @yield('contents')
    </div>
</main>
@include('web.layouts.footer')
@endsection