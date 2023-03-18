@extends('admin.layouts.wrapper')
@section('contents')
@section('title', 'Stations | Admin')
<section>
    <div class="d-flex align-items-end">
        <p class="fs-3 mb-0">Stations</p>
        <div class="ms-auto d-flex">
            <div class="dropdown me-2">
                <button class="btn btn-light border-0 shadow-none dropdown-toggle" data-bs-toggle="dropdown">
                  Options
                </button>
                <ul class="dropdown-menu border-0 p-0 shadow-sm">
                  <li><a class="dropdown-item rounded-1" href="#">Export stations</a></li>
                  <li><a class="dropdown-item rounded-1" href="#">Import stations</a></li>
                  <li><a class="dropdown-item rounded-1" href="#">Import format</a></li>
                </ul>
              </div>
              <a class="btn btn-primary border-0 shadow-none create-station" data-bs-toggle="modal" data-bs-target="#stationModal">Add a station</a>
        </div>
    </div>
    <div class="mt-5">
        @include('admin.stations.table')
    </div>
</section>
@include('admin.stations.form')
@endsection
@push('styles')
@endpush
@push('scripts')
<script>

</script>
@endpush
