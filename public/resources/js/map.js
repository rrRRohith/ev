/**
 * define map as global to update peopls
 * Initialize map for setting up stations
 */

let map;
let planType;
const initArchiveMap = async function () {
    //init map for archive;
    let mapOptions = {
        center: new google.maps.LatLng(stateSettings.latitude ?? 52.3555, stateSettings.longitude ?? 1.1743),
        zoom: stateSettings.zoom,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        zoomControl: true,
        styles: [
            {
                featureType: "poi",
                stylers: [
                    { visibility: "off" }
                ]
            }
        ],
    };

    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    /**
     * detect zoom changes and set search radius
     */
    google.maps.event.addListener(map, 'zoom_changed', async function () {
        stateSettings.zoom = map.getZoom();
        stateSettings.radius = (mapDefault.maxZoom - stateSettings.zoom) * (mapDefault.range);
        stateSettings.page = 1;
        await pushstateSettings();
        //loadArchive();
    });

    /**
     * detect map drag and reload archive based on center coordinates
     */
    google.maps.event.addListener(map, 'dragend', async function () {
        updateMap(map.getCenter().lat(), map.getCenter().lng());
    });

    google.maps.event.addListener(map, 'zoom_changed', async function () {
        updateMap(map.getCenter().lat(), map.getCenter().lng());
    });
}
const updateMap = async function (lat, lng) {
    if (!planned) {
        localStorage.setItem('latitude', lat);
        localStorage.setItem('longitude', lng);
        stateSettings.page = 1;
        await setLocation();
        await getLocation();
        await pushstateSettings();
        loadArchive();
    }

}
/**
 * set locations and coordinates to state settings from localstorage.
 */
const setLocation = async function (lat, lng) {
    stateSettings.latitude = (localStorage.getItem('latitude') ?? null);
    stateSettings.longitude = (localStorage.getItem('longitude') ?? null);
    stateSettings.userLat = (localStorage.getItem('userLat') ?? null);
    stateSettings.userLng = (localStorage.getItem('userLng') ?? null);
    stateSettings.city = localStorage.getItem('city') ?? null;
    stateSettings.state = localStorage.getItem('state') ?? null;
    stateSettings.country = localStorage.getItem('country') ?? null;
}
/**
 * push changed url without page reload
 */
const pushstateSettings = async function () {
    let url = new URL(`/map`, location.href);
    await Object.entries(stateSettings).forEach(([k, v]) => {
        if (v) {
            url.searchParams.set(k, v);
        } else {
            url.searchParams.delete(k);
        }
    });
    history.pushState(null, null, url);
}
const archive = $('#archive');
/**
 * fet current user location
 * uses gps or ip address
 */
async function fetchLocation(reload = true) {
    if (!localStorage.getItem('locationFetched')) {
        await navigator.permissions.query({
            name: 'geolocation'
        }).then(async function (result) {
            await navigator.geolocation.getCurrentPosition(setPosition);

            if (result.state !== 'granted')
                toast('Please enable location access for better experiance', 'error');

            result.onchange = async function () {
                if (result.state == 'granted') {
                    await navigator.geolocation.getCurrentPosition(setPosition);
                }
                if (reload)
                    location.reload();
            }
        });
    }
    setLocation();
}
/**
 * load archive, use api to load stations and update contents
 * then load map to update station in map
 */
const loadArchive = async function (url) {
    await pushstateSettings();
    url = url ?? location.href;
    await $.getJSON(url, async function (data) {
        await removeMarkers();
        if (data.length) {
            data.forEach(function (station) {
                setMarker(station);
            })
        } else {
            toast("Couldn't find any charging stations this area", "error");
        }

    });
    loadMe();
    history.pushState(null, null, new URL(url));
}
/**
     * define global markers for stations
     * this is used to dectced hovers, clicks on maps and show infos
     */
let markers = [];
/**
 * set stations one by one into current map
 */
let me;
let circle;
const loadMe = function () {
    if (localStorage.getItem('userLng') && localStorage.getItem('userLat')) {
        let latLng = new google.maps.LatLng(localStorage.getItem('userLat'), localStorage.getItem('userLng'));
        me = new google.maps.Marker({
            position: latLng,
            map: map,
            draggable: false,
            html: "You",
            icon: '/uploads/me.png'
        });
        try {
            circle.setMap(null);
        } catch (error) {

        }
        circle = new google.maps.Circle({
            map: map,
            radius: 16093,    // 10 miles in metres
            fillColor: '#0d6efd',
            strokeColor: '#0d6efd'
        });
        google.maps.event.addListener(me, 'dragend', async function (event) {
            //updateMap(me.lat(), me.lng());
        });
        circle.bindTo('center', me, 'position');
    }
}
function setMarker(station, open = true) {
    geocoder = new google.maps.Geocoder();
    infowindow = new google.maps.InfoWindow();
    if ((station.latitude == null) || (station.longitude == 'null')) {
        geocoder.geocode({ 'address': station.address }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                let latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    draggable: false,
                    html: station.name,
                    icon: station.marker,
                    station_id: station.id,
                    station: station,
                    open: open
                });
            }
        });
    }
    else {
        let latlng = new google.maps.LatLng(station.latitude, station.longitude);
        marker = new google.maps.Marker({
            position: latlng,
            map: map,
            draggable: false,
            html: station.name,
            icon: station.marker_url,
            station_id: station.id,
            station: station,
            open: open
        });
    }
    markers[station.id] = marker;
    /**
     * detect click on marker and show info windo
     */
    google.maps.event.addListener(marker, 'click', function (event) {
        if (this.open)
            openSide(this.station);
    });

    /**
     * detect hover in map icons and pop vendor list
     */
    google.maps.event.addListener(marker, 'mouseover', function (event) {
        infowindow.setContent(makeMarkerContent(this.station, this.open));
        infowindow.setPosition(event.latLng);
        infowindow.open(map, this);
    });
}
$(document).on('click', '.stationPop.pop', function () {
    openSide(JSON.parse($(this).attr('data-station')));
});
const openSide = function (station) {
    planType = 'journy';
    $('#planForm').trigger('reset');
    $('.stationModal').find('.station').html(`<header class="mb-1">
    <img class="w-100 rounded-2" src="${station.image_url}">
    </header>
    <footer class="p-3">
        <p class="fs-6 m-0 fw-semibold text-overflow">${station.name}</p>
        <p class="m-0 text-overflow">${station.address}</p>
        <p class="m-0 text-overflow">${station.charger_type} | ${station.charging_speed} | ${station.price}</p>
        ${station.description ? `<p class="m-0 text-overflow">${station.description}</p>` : ``}
    </footer>`)
    $('#end_point').val(`${station.name} ${station.address}`).attr('readonly', true);
    $('#end_point_lat').val(`${station.latitude}`);
    $('#end_point_lng').val(`${station.longitude}`);
    $('.start-journy').hide();
    $('.stationModal').modal('show');
    $('input#start_point').focus();
}
/**
 * generate marker station content
 */
const makeMarkerContent = function (station, pop = true) {
    return `<a class="text-decoration-none text-dark">
        <div class="stationPop ${pop ? 'pop' : ''} cursor-pointer" data-station='${JSON.stringify(station)}'>
            <header class="mb-1">
            <img src="${station.image_url}">
            </header>
            <footer class="p-2">
                <p class="fs-6 m-0 fw-semibold text-overflow">${station.name}</p>
                <p class="m-0 text-overflow">${station.charger_type} | ${station.price}</p>
            </footer>
        </div>        
    </a>`;
}
/**
 * remove existing markers from map
 */
const removeMarkers = function () {
    markers.forEach(function (marker) {
        marker.setMap(null);
    });
    markers = [];
}
/**
 * decode positions
 * store to local storage
 */
async function setPosition(position) {
    localStorage.setItem('latitude', position.coords.latitude);
    localStorage.setItem('longitude', position.coords.longitude);
    localStorage.setItem('userLat', position.coords.latitude);
    localStorage.setItem('userLng', position.coords.longitude);
    await getLocation();
    location.reload();
}
/**
 * start fetching current user locations
 */
$(async function () {
    await fetchLocation();
    await initArchiveMap();
    loadArchive();
})
/**
 * get current user city and country from coordinates
 * stores to local storage
 */
async function getLocation() {
    let geocoder = new google.maps.Geocoder();
    await geocoder.geocode(
        { 'latLng': new google.maps.LatLng((localStorage.getItem('latitude') ?? null), (localStorage.getItem('longitude') ?? null)) },
        function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    let value = results[0].formatted_address.split(",");
                    localStorage.setItem('city', value[value.length - 3].trim());
                    localStorage.setItem('locationFetched', true);
                }
            }
        }
    );
    return;
}
$(function () {
    $('.currentLocation').on('click', function () {
        localStorage.removeItem('locationFetched');
        fetchLocation();
    })
    $('.startCurrentLocation').on('click', function () {
        if (localStorage.getItem('userLng') && localStorage.getItem('userLat')) {
            if (planType == 'journy') {
                localStorage.setItem('epLat', localStorage.getItem('userLat'));
                localStorage.setItem('epLng', localStorage.getItem('userLng'));
                startDirection();
            } else {
                $('#start_point_lat').val(`${localStorage.getItem('userLat')}`);
                $('#start_point_lng').val(`${localStorage.getItem('epLng')}`);
                $('input#start_point').val(`${localStorage.getItem('city') ? localStorage.getItem('city') : 'Your current location'}`)
            }

        } else {
            localStorage.removeItem('locationFetched');
            fetchLocation(false);
        }
    });
})
/**
 * Start processing directions
 */
const startDirection = function () {
    $('#start_point_lat').val(`${localStorage.getItem('epLat')}`);
    $('#start_point_lng').val(`${localStorage.getItem('epLng')}`);
    getDirection();
    $('.stationModal').modal('hide');
}
let directionsService = new google.maps.DirectionsService();
let directionsDisplay = new google.maps.DirectionsRenderer({
    suppressMarkers: true, polylineOptions: {
        strokeColor: '#0d6efd'
    }
});
/**
 * Get and render directions
 * @returns null
 */
const getDirection = async function (wayouts = []) {
    if ($('#start_point_lat').val() == $('#end_point_lat').val() && $('#start_point_lng').val() == $('#end_point_lng').val()) {
        toast("Opps, we couldn't find any routes.", 'error');
        return false;
    }
    directionsDisplay.setMap(map);

    let routePlanCoordinates = [];
    let bounds = new google.maps.LatLngBounds();

    /**
     * Start and end point
     */
    let start = new google.maps.LatLng($('#start_point_lat').val(), $('#start_point_lng').val());
    let end = new google.maps.LatLng($('#end_point_lat').val(), $('#end_point_lng').val());

    let request = {
        origin: start,
        destination: end,
        optimizeWaypoints: true,
        travelMode: google.maps.TravelMode.DRIVING,
        waypoints: []
    };
    if (wayouts.length) {
        await wayouts.forEach(function (wayout) {
            request.waypoints.push({
                location: new google.maps.LatLng(wayout.lat, wayout.lng),
                stopover: true
            });
        })
    }
    directionsService.route(request, async function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            await removeMarkers();
            directionsDisplay.setDirections(response);
            let legFirst = response.routes[0].legs[0];
            let legLast = response.routes[0].legs[response.routes[0].legs.length - 1];
            let dcontent = '';
            let totalDistance = totalDuration = 0;
            response.routes[0].legs.forEach(function (leg) {
                totalDistance += leg.distance.value;
                totalDuration += leg.duration.value;
            });
            let overview = '';
            if (modelJ = localStorage.getItem('model')) {
                try {
                    model = JSON.parse(modelJ);
                    let range = model.drive_range ?? 0;
                    let distance = (totalDistance / 1000);
                    let recharges = distance > range ? Math.round(distance / range) : 0;
                    let remaining_range = Math.round(distance > range ? (range - (distance % range)) : range - distance);
                    let remaining_battery = Math.round((remaining_range / range) * 100);
                    let charging_time = secondsToDhms(recharges*model.charging_time*60);
                    overview = `<hr><div class="mt-0"><p class="mb-0">total recharges. <strong>${recharges}</strong >${recharges ? `, total charging time. <strong>${charging_time}</strong>` : ``}, remaining battery. <strong>${remaining_battery}%</strong> <i class="ms-2 position-relative text-warning cursor-pointer fa-regular fa-circle-question fa-beat-fade" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Information generated based on your selected ev model and will not be accurate."></i></p></div>`
                } catch (error) {

                }
            }
            if (legFirst.distance.value && legFirst.duration.value) {
                $('.direction-info').remove();
                $('.map-container').append(`<div class="direction-info bg-white rounded-2 shadow-sm p-4" style="display:none">
                <div class="position-relative">
                <i class="fa-solid fa-xmark"></i>    
                <div class="fw-semibold">${getCity(legFirst.start_address)} <span class="fw-normal">to</span> ${getCity(legLast.end_address)}</div>
                <div>${round(totalDistance / 1000, 1)}km(${secondsToDhms(totalDuration)})</div>
                ${overview}
                </div></div>`);
                $('.direction-info').slideDown();
                toolTip();
                if (response.routes[0].overview_path.length && planType == 'search') {
                    renderNearby(response.routes[0].overview_path);
                }
            }
            marker = new google.maps.Marker({
                position: legFirst.start_location,
                map: map,
                draggable: false,
                icon: '/uploads/me.png',
            });
            markers[0] = marker;
            response.routes[0].legs.forEach(function (leg, i) {
                marker = new google.maps.Marker({
                    position: leg.end_location,
                    map: map,
                    draggable: false,
                    icon: leg == legLast ? '/uploads/destination.png' : '/uploads/marker.png',
                });
                markers[i + 1] = marker;
            });
            planned = true;
            $('.add-station').hide();
            $('.planner').addClass('planned');
            try {
                me.setMap(null);
                circle.setMap(null);
            } catch (error) { }

        } else {
            toast("Opps, we couldn't find any routes.", 'error');
        }
    });
}
const getCity = function (add) {
    var value = add.split(",");
    count = value.length;
    country = value[count - 1];
    state = value[count - 2];
    city = value[count - 3];
    return city;
}
let planned = false;
$('div.search').on('click', function () {
    planType = 'search';
    $('#planForm').trigger('reset');
    $('.stationModal').find('.station').html(`<div class="p-3"><p class="fw-semibold fs-5">Plan a route</p> <p>Search your starting and destination to start planning your route.</p></div>`);
    $('#end_point').val(``).attr('readonly', false);
    $('.start-journy').show().addClass('disabled');
    $('.stationModal').modal('show');
    $('input#start_point').focus();
});
$('.cancel-route').on('click', async function () {
    planned = false;
    await directionsDisplay.setDirections({ routes: [] });
    directionsDisplay.setMap(null);
    $('.planner').removeClass('planned');
    $('.direction-info').remove();
    $('.add-station').hide();
    loadArchive();
});
$('.start-journy').on('click', function () {
    $('.add-station').hide();
    if (planType == 'search') {
        if ($('#start_point_lat').val() && $('#start_point_lng').val() && $('#end_point_lat').val() && $('#end_point_lng').val()) {
            getDirection();
            $('.stationModal').modal('hide');
        } else {
            toast('Please select start and end point to continue', 'error');
        }
    }
});
$(document).on('click', '.direction-info i.fa-xmark', function () {
    $('.direction-info').slideUp();
});
$('.start-plan').on('click', async function () {
    if (planned && planType == 'search') {
        if ($('input[type=checkbox][name=station]:checked').length) {
            let wayouts = [];
            await $('input[type=checkbox][name=station]:checked').each(function () {
                wayouts.push({
                    lat: $(this).attr('data-lat'),
                    lng: $(this).attr('data-lng')
                });
            });
            $('#addstationModal').modal('hide');
            planType = 'journy';
            getDirection(wayouts);
        } else {
            toast('Please select atleast once station to plan', 'error');
        }
    }
});