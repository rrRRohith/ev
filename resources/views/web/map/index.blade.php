@extends('web.layouts.wrapperStreched')
@section('contents')
@section('title', 'Plan a route | Instantly find charging stations nearby')
<div class="position-relative">
    @include('web.map.plan')
    <section class="w-100 map-section position-relative" id="map"></section>
</div>
@include('web.map.partials.model')
@endsection
@push('styles')
@endpush
@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key={{ $app->map_key }}"></script>
<script>
    const mapDefault = {
        zoom: 10,
        range: 12,
        maxZoom: 22,
    }
    const radius = (mapDefault.maxZoom - mapDefault.zoom) * (mapDefault.range) // max zoom - current zoom * range;
    let stateSettings = {
        zoom: 10,
        radius: radius,
        latitude: null,
        longitude: null,
    }
</script>
<script src="{{ asset('resources/js/map.js') }}"></script>
@endpush
