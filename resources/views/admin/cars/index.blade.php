@extends('admin.layouts.wrapper')
@section('contents')
@section('title', 'Cars | Admin')
<section>
    <div class="d-flex align-items-end">
        <p class="fs-3 mb-0">Cars</p>
        <div class="ms-auto d-flex">
            <div class="dropdown me-2">
                <button class="btn btn-light border-0 shadow-none dropdown-toggle" data-bs-toggle="dropdown">
                  Options
                </button>
                <ul class="dropdown-menu border-0 p-0 shadow-sm">
                  <li><a class="dropdown-item rounded-1" href="#">Export models</a></li>
                  <li><a class="dropdown-item rounded-1" href="#">Import models</a></li>
                  <li><a class="dropdown-item rounded-1" href="#">Import format</a></li>
                </ul>
              </div>
              <a class="btn btn-primary border-0 shadow-none create-model" data-bs-toggle="modal" data-bs-target="#carModal">Add a EV model</a>
        </div>
    </div>
    <div class="mt-5">
        @include('admin.cars.table')
    </div>
</section>
@include('admin.cars.form')
@endsection
@push('styles')
@endpush
@push('scripts')
<script>

</script>
@endpush
