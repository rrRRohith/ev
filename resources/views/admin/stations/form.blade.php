<div class="modal stationModal" data-bs-backdrop="static" data-bs-keyboard="false" id="stationModal" tabindex="-1"
    role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-fullscreen-md-down" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <div>
                    <p class="mb-0 fs-5 fw-semibold modal-title" data-update="Edit station" data-modal="true"
                        data-store="Create station">Create station</p>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.stations.store') }}"
                    data-destroy="{{ route('admin.stations.destroy', ['station' => 'stationID']) }}"
                    data-store="{{ route('admin.stations.store') }}"
                    data-update="{{ route('admin.stations.update', ['station' => 'stationID']) }}" method="post"
                    class="ajax" data-callback="" id="stationForm" autocomplete="off">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-12 m-auto text-center">
                            <div class="form-group mb-2">
                                <label for="imageUpload" class="cursor-pointer">
                                    <img width="140" height="140" src="{{ asset('uploads/default.png') }}" class="image border border-3 border-primary rounded-circle object-fit-cover" data-default="{{ asset('uploads/default.png') }}" alt="">
                                    <input hidden type="file" id="imageUpload" accept="image/*">
                                </label>
                                <input hidden type="hidden" form="stationForm" name="image" id="image">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label for="name" class="fw-semibold">Name</label>
                                <input type="text" form="stationForm" name="name" id="name"
                                    placeholder="eg. Shell" value="" autocomplete="off"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label for="charger_type" class="fw-semibold">Charger type</label>
                                <input type="text" form="stationForm" name="charger_type" id="charger_type"
                                    placeholder="eg. Type 2" value="" autocomplete="off"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="address" class="fw-semibold">Address</label>
                                <input type="text" form="stationForm" name="address" id="address"
                                    placeholder="eg. 3691 E First St Blue Ridge"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label for="latitude" class="fw-semibold">Latitude</label>
                                <input type="text" form="stationForm" name="latitude" id="latitude"
                                    placeholder="eg. 34.870338" value="" autocomplete="off"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <label for="longitude" class="fw-semibold">Longitude</label>
                                <input type="text" form="stationForm" name="longitude" id="longitude"
                                    placeholder="eg. -84.318711" value="" autocomplete="off"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="price" class="fw-semibold">Price</label>
                                <input type="text" form="stationForm" name="price" id="price"
                                    placeholder="eg. £0.35 per kWh"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="charging_speed" class="fw-semibold">Charging speed</label>
                                <input type="text" form="stationForm" name="charging_speed" id="charging_speed"
                                    placeholder="eg. Fast Charger"
                                    class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="description" class="fw-semibold">Description <small
                                        class="fw-normal">Optional</small></label>
                                <textarea type="text" form="stationForm" name="description" id="description"
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
                <button type="submit" form="stationForm" data-default="Save changes"
                    class="border-0 btn p-2 pl-3 pr-3 ps-3 pe-3 rounded-1 continue-btn shadow-none btn-primary border-0 ">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(function() {
            $('.create-station').on('click', function() {
                $('#stationForm').trigger('reset');
                $('.form-group').removeClass('error');
                $('.stationModal').find('.modal-title').text($('.stationModal').find('.modal-title').attr('data-store'));
                $('#stationForm').attr('action', $('#stationForm').attr('data-store'));
                $('input[name="_method"]').val('POST');
                $('.image').attr('src', $('.image').attr('data-default'));
                $('a.destroy').remove();
            })
            $('.row-item').on('click', async function() {
                $('#stationForm').trigger('reset');
                $('.form-group').removeClass('error');
                let station = await JSON.parse($(this).attr('data-item'));
                $('.stationModal').find('.modal-title').text($('.stationModal').find('.modal-title').attr('data-update'));
                $('#stationForm').attr('action', $('#stationForm').attr('data-update').replace(
                    'stationID', station.id));
                $('input[name="_method"]').val('PUT');
                $('.modal-body').append(
                    `<a href="${$('#stationForm').attr('data-destroy').replace('stationID', station.id)}" data-method="delete" class="destroy text-danger text-decoration-none fw-semibold" data-confirm="Are you sure want to delete?">Delete station</a>`
                    )
                $('input#address').val(station.address);
                $('input#name').val(station.name);
                $('input#price').val(station.price);
                $('input#charger_type').val(station.charger_type);
                $('input#charging_speed').val(station.charging_speed);
                $('input#latitude').val(station.latitude);
                $('input#longitude').val(station.longitude);
                $('textarea#description').val(station.description);
                $('input#drive_range').val(station.drive_range);
                $('.image').attr('src', station.image_url);
                $('#stationModal').modal('show');
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
