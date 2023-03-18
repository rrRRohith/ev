@extends('admin.layouts.wrapper')
@section('contents')
@section('title', 'Dashboard | Admin')
<section>
    <p class="fs-3">Welcome back! {{ auth()->user()->name }}</p>
    <p class="fs-semibold fs-5">Here what you can do with {{ $app->name }} admin dashboard.</p>
    <div class="mt">
        <a class="btn btn-primary border-0 shadow-none create-station" data-bs-toggle="modal" data-bs-target="#stationModal" href="#">Add a charging station</a>
        <a class="btn btn-primary border-0 shadow-none ms-auto create-model" data-bs-toggle="modal" data-bs-target="#carModal">Add a EV model</a>
    </div>
</section>
@endsection
@include('admin.cars.form')
@include('admin.stations.form')
@push('styles')
@endpush
@push('scripts')
@endpush
