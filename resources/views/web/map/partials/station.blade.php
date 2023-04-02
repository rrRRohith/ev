<div class="modal stationModal" data-bs-backdrop="static" data-bs-keyboard="false" id="stationModal"
    tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xm modal-fullscreen-md-down" role="document">
        <div class="modal-content border-0">
            <div class="modal-body">
                <div class="station">

                </div>
                <form action="#" id="planForm">
                    <div class="form-group mb-2 mt-2 position-relative">
                        <input type="hidden" id="start_point_lat" readonly hidden>
                        <input type="hidden" id="start_point_lng" readonly hidden>
                        <input id="start_point"
                            placeholder="Search your starting point." autocomplete="off"
                            class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-4 hover-shadow'>
                            <div class="startCurrentLocation cursor-pointer text-primary position-absolute"><i class="fa-solid fa-location-crosshairs"></i></div>
                    </div>
                    <div class="form-group mb-0">
                        <input type="hidden" id="end_point_lat" readonly hidden>
                        <input type="hidden" id="end_point_lng" readonly hidden>
                        <input id="end_point"
                            placeholder="Destination." autocomplete="off"
                            class='form-control shadow-none border-gray rounded-1 p-2 pl-3 pr-3 ps-3 pe-3 hover-shadow'>
                    </div>
                </form>
                <div class="mt-3 startCurrentLocation cursor-pointer text-primary d-none">Current location <i class="fa-solid fa-location-crosshairs"></i></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button"
                    class="btn rounded-1 border-0 shadow-none btn-secondary btn-light p-2 pl-3 pr-3 ps-3 pe-3 border-gray "
                    data-bs-dismiss="modal">Close</button>
                <button type="button"
                    class="btn rounded-1 border-0 shadow-none btn-primary btn-primary p-2 pl-3 pr-3 ps-3 pe-3 border-gray start-journy">Plan route</button>
            </div>
        </div>
    </div>
</div>
<div class="modal addstationModal" data-bs-backdrop="static" data-bs-keyboard="false" id="addstationModal"
    tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xm modal-fullscreen-md-down" role="document">
        <div class="modal-content border-0">
            <div class="modal-header border-0">
                <p class="mb-0 fs-5 fw-semibold">Plan your route</p>
            </div>
            <div class="modal-body">
                <div class="stationselection ps-3">

                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button"
                    class="btn rounded-1 border-0 shadow-none btn-secondary btn-light p-2 pl-3 pr-3 ps-3 pe-3 border-gray "
                    data-bs-dismiss="modal">Close</button>
                <button style="display:none" type="button"
                    class="add-station btn rounded-1 border-0 shadow-none btn-primary btn-primary p-2 pl-3 pr-3 ps-3 pe-3 border-gray start-plan">Plan route</button>
            </div>
        </div>
    </div>
</div>