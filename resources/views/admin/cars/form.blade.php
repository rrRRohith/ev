<div class="modal fade carModal" data-bs-backdrop="static" data-bs-keyboard="false" id="carModal" tabindex="-1"
    role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <div>
                    <p class="mb-0 fs-5 fw-semibold modal-title" data-update="Edit model" data-modal="true"
                        data-store="Create model">Create model</p>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.cars.store') }}"
                    data-destroy="{{ route('admin.cars.destroy', ['car' => 'carID']) }}"
                    data-store="{{ route('admin.cars.store') }}"
                    data-update="{{ route('admin.cars.update', ['car' => 'carID']) }}" method="post" class="ajax"
                    data-callback="" id="carForm" autocomplete="off">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-12 m-auto text-center">
                            <div class="form-group mb-2">
                                <label for="imageUpload" class="cursor-pointer">
                                    <img src="{{ asset('uploads/default.png') }}" width="140" height="140" class="object-fit-cover image border border-3 border-primary rounded-circle" data-default="{{ asset('uploads/default.png') }}" alt="">
                                    <input hidden type="file" id="imageUpload" accept="image/*">
                                </label>
                                <input hidden type="hidden" form="carForm" name="image" id="image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="make" class="fw-semibold">Make</label>
                                <input type="text" form="carForm" name="make" id="make"
                                    placeholder="eg. Hyundai" value="" autocomplete="off"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="name" class="fw-semibold">Model name</label>
                                <input type="text" form="carForm" name="name" id="name"
                                    placeholder="eg. Ioniq 5" value="" autocomplete="off"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="trim" class="fw-semibold">Trim</label>
                                <input type="text" form="carForm" name="trim" id="trim"
                                    placeholder="eg. Sport" value="" autocomplete="off"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="charger_type" class="fw-semibold">Charger type</label>
                                <input type="text" form="carForm" name="charger_type" id="charger_type"
                                    placeholder="eg. Type 2" value="" autocomplete="off"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="drive_range" class="fw-semibold">Range <small class="fw-normal">In
                                        kms</small></label>
                                <input type="text" form="carForm" name="drive_range" id="drive_range"
                                    placeholder="eg. 400" value="" autocomplete="off"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="charging_time" class="fw-semibold">Time <small class="fw-normal">In
                                        m</small></label>
                                <input type="text" form="carForm" name="charging_time" id="charging_time"
                                    placeholder="eg. 120" value="" autocomplete="off"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="description" class="fw-semibold">Description <small
                                        class="fw-normal">Optional</small></label>
                                <textarea type="text" form="carForm" name="description" id="description"
                                    placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
                                    value="" autocomplete="off"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button"
                    class="btn rounded-1 border-0 shadow-none btn-secondary btn-light p-2 pl-3 pr-3 ps-3 pe-3 border-gray "
                    data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="carForm" data-default="Save changes"
                    class="border-0 btn p-2 pl-3 pr-3 ps-3 pe-3 rounded-1 continue-btn shadow-none btn-primary border-0 ">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(function() {
            $('.create-model').on('click', function() {
                $('#carForm').trigger('reset');
                $('.form-group').removeClass('error');
                $('.modal-title').text($('.modal-title').attr('data-store'));
                $('#carForm').attr('action', $('#carForm').attr('data-store'));
                $('input[name="_method"]').val('POST');
                $('.image').attr('src', $('.image').attr('data-default'));
                $('a.destroy').remove();
            })
            $('.row-item').on('click', async function() {
                $('#carForm').trigger('reset');
                $('.form-group').removeClass('error');
                let car = await JSON.parse($(this).attr('data-item'));
                $('.modal-title').text($('.modal-title').attr('data-update'));
                $('#carForm').attr('action', $('#carForm').attr('data-update').replace('carID', car
                    .id));
                $('input[name="_method"]').val('PUT');
                $('.modal-body').append(
                    `<a href="${$('#carForm').attr('data-destroy').replace('carID', car.id)}" data-method="delete" class="destroy text-danger text-decoration-none fw-semibold">Delete model</a>`
                )
                $('input#make').val(car.make);
                $('input#name').val(car.name);
                $('input#trim').val(car.trim);
                $('input#charger_type').val(car.charger_type);
                $('input#charging_time').val(car.charging_time);
                $('textarea#description').val(car.description);
                $('input#drive_range').val(car.drive_range);
                $('.image').attr('src', car.image_url);
                $('#carModal').modal('show');
            });
            $(document).on("change", "#imageUpload", function() {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return;
                if (/^image/.test(files[0].type)) {
                    var reader = new FileReader();
                    reader.readAsDataURL(files[0]);
                    reader.onloadend = function() {
                        $('.image').attr('src', this.result);
                        $('#image').val(this.result);
                        uploadFile.val('');
                    }
                }
            });
        })
    </script>
@endpush
