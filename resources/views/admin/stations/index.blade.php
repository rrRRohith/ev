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
                    <li><a class="dropdown-item rounded-1" data-method="post"
                            href="{{ route('admin.stations.export') }}">Export stations</a></li>
                    <li><label for="file" class="dropdown-item rounded-1 cursor-pointer">Import stations</label>
                    </li>
                    <li><a class="dropdown-item rounded-1" href="{{ asset('uploads/stations_example.xlsx') }}"
                            download>Import format</a></li>
                </ul>
            </div>
            <a class="btn btn-primary border-0 shadow-none create-station" data-bs-toggle="modal"
                data-bs-target="#stationModal">Add a station</a>
        </div>
    </div>
    <div class="mt-5">
        @include('admin.stations.table')
    </div>
</section>
<form action="{{ route('admin.stations.import') }}" method="post" class="ajax" id="importForm" enctype="multipart/form-data">
    @csrf
    <input hidden type="file" name="file" id="file">
</form>
@include('admin.stations.form')
@endsection
@push('styles')
@endpush
@push('scripts')
<script>
    $('#file').on('change', function() {
        $('#importForm').submit();
    })
</script>
@endpush
