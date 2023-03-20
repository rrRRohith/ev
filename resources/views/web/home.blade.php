@extends('web.layouts.wrapper')
@section('contents')
@section('title', 'EV | Instantly find charging stations nearby')
<div class="row mt-4 flex-md-row flex-column-reverse align-items-center">
    <div class="col-md-5">
        <div class="card border-0 shadow-none">
            <div class="card-body p-4 p-md-5">
                <h2 class="fw-light">Instantly find charging stations nearby</h2>
                <a href="{{ route('map.index') }}" class="d-block mt-3 btn btn-primary btn-lg border-0 plan-route"><i
                        class="fa-solid fa-magnifying-glass"></i> Discover stations</a>
            </div>
        </div>
    </div>
    <div class="col-md-7 mb-md-0 mb-4 text-center">
        <img src="{{ asset('uploads/bg.png') }}" class="w-100">
    </div>
</div>
@endsection
@push('styles')
@endpush
@push('scripts')
<script>
</script>
@endpush
