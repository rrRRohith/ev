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
                  <li><a class="dropdown-item rounded-1" data-method="post" href="{{ route('admin.cars.export') }}">Export models</a></li>
                  <li><label for="file" class="dropdown-item rounded-1 cursor-pointer">Import models</label>
                  <li><a class="dropdown-item rounded-1" href="{{ asset('uploads/models_example.xlsx') }}" download>Import format</a></li>
                </ul>
              </div>
              <a class="btn btn-primary border-0 shadow-none create-model" data-bs-toggle="modal" data-bs-target="#carModal">Add a EV model</a>
        </div>
    </div>
    <div class="mt-5">
        @include('admin.cars.table')
    </div>
  </section>
  <form action="{{ route('admin.cars.import') }}" method="post" class="ajax" id="importForm" enctype="multipart/form-data">
      @csrf
      <input hidden type="file" name="file" id="file">
  </form>
  @include('admin.cars.form')
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