@extends('web.layouts.wrapperStreched')
@section('contents')
@section('title', 'Plan a route | Instantly find charging stations nearby')
<div class="position-relative map-container">
    @include('web.map.plan')
    <section class="w-100 map-section position-relative" id="map"></section>
</div>
@include('web.map.partials.model')
@include('web.map.partials.station')
@endsection
@push('styles')
@endpush
@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{ $app->map_key }}"></script>
<script>
    const mapDefault = {
        zoom: 10,
        range: 8,
        maxZoom: 22,
    }
    const radius = (mapDefault.maxZoom - mapDefault.zoom) * (mapDefault.range) // max zoom - current zoom * range;
    let stateSettings = {
        zoom: 10,
        radius: radius,
        latitude: null,
        longitude: null,
        userLat: null,
        userLng: null,
        city: null,
    }
</script>
<script src="{{ asset('resources/js/map.js') }}"></script>
<script>
    $(document).ready(function() {
        let start_point, end_point;
        start_point = new google.maps.places.Autocomplete((document.getElementById('start_point')), {
            types: ['(cities)'],
        });
        google.maps.event.addListener(start_point, 'place_changed', async function() {
            loadLocation(start_point.getPlace(), 'start_point');
        });

        end_point = new google.maps.places.Autocomplete((document.getElementById('end_point')), {
            types: ['(cities)'],
        });
        google.maps.event.addListener(end_point, 'place_changed', async function() {
            loadLocation(end_point.getPlace(), 'end_point');
        });

        const loadLocation = function(place, point) {
            if (planType == 'journy') {
                localStorage.setItem('epLat', place.geometry.location.lat());
                localStorage.setItem('epLng', place.geometry.location.lng());
                startDirection();
            } else {
                if (point == 'end_point') {
                    $('#end_point_lat').val(place.geometry.location.lat());
                    $('#end_point_lng').val(place.geometry.location.lng());
                } else {
                    $('#start_point_lat').val(place.geometry.location.lat());
                    $('#start_point_lng').val(place.geometry.location.lng());
                }
                if ($('#start_point_lat').val() && $('#start_point_lng').val() && $('#end_point_lat')
                    .val() && $('#end_point_lng').val()) {
                    $('.start-journy').show().removeClass('disabled');
                }
            }
        }
    });
    /**
     * Render nearby stations in search wayout
     * @param {array} wayout 
     */
    const renderNearby = async function(wayout) {
        let points = [];
        await wayout.forEach(p => {
            points.push({
                lat: p.lat(),
                lng: p.lng()
            })
        });
        $('.add-station').hide();
        $('.stationselection').empty();
        $.ajax({
            type: 'POST',
            url: '{{ route('map.stations') }}',
            data: {
                wayouts: points
            },
            success: function(data) {
                if (!data.length) {
                    toast("Couldn't find any charging stations this route", "error");
                } else {
                    data.forEach(function(station) {
                        setMarker(station, false);
                        $('.stationselection').append(`<div class="form-check form-check-lg mb-2">
                            <input data-lat="${station.latitude}" data-lng="${station.longitude}" class="form-check-input shadow-none hover-shadow cursor-pointer" name="station" type="checkbox" value="" id="station__${station.id}">
                            <label class="form-check-label ms-2" for="station__${station.id}_label">
                                <div class="d-flex align-items-center">
                                    <div class="row-image me-2">
                                        <img width="40" height="40" class="rounded-circle object-fit-cover" src="${station.image_url}" alt="">
                                    </div>
                                    <div class="">
                                        <div class="fw-semibold text-overflow">${station.name} <span class="fw-normal small">${station.address}</span></div>
                                        <p class="m-0 text-overflow">${station.charger_type} | ${station.price}</p>
                                    </div>
                                </div>
                                
                            </label>
                            </div>`)
                    });
                    $('.add-station').show();
                }
            },
            error: function(data) {
                toast('Opps, something went wrong.', 'error');
            }
        });
    }
</script>
<script>
    const loadModels = function() {
        $.getJSON(`{{ route('map.models') }}?q=${$('input#q').val()}`, function(data) {
            if (data.length) {
                $('.modelResult').empty();
                data.forEach(function(model) {
                    $('.modelResult').append(`<div class="mb-2 d-flex align-items-center cursor-pointer selectEV" data-ev='${JSON.stringify(model)}'>
                        <div class="row-image me-2">
                            <img width="40" height="40" class="rounded-circle object-fit-cover" src="${model.image_url}" alt="">
                        </div>
                        <div class="">
                            <div class="fw-semibold text-overflow"><span class="fw-normal small">${model.make}</span> ${model.name}<span class="fw-normal small">(${model.trim})</span></div>
                            <p class="m-0 text-overflow">${model.drive_range}km | ${model.charging_time}min | ${model.charger_type}</p>
                        </div>
                    </div>`)
                });
            } else {
                $('.modelResult').html('<p class="mb-0">No result found</p>')
            }
        });
    }
    $('input#q').on('keyup', loadModels)
    $(loadModels);
    $(document).on('click', '.selectEV', async function(){
        let model = await JSON.parse($(this).attr('data-ev'));
        localStorage.setItem('model', JSON.stringify(model));
        $('#modelModal').modal('hide');
        toast('EV model changed successfully', 'success');
    });
</script>
@endpush
