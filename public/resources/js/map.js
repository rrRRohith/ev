/**
     * define map as global to update peopls
     * Initialize map for setting up peoples
     */
    
let map
const initArchiveMap = async function () {
    //init map for archive;
    let mapOptions = {
        center: new google.maps.LatLng(stateSettings.latitude ?? 52.3555, stateSettings.longitude ?? 1.1743),
        zoom: stateSettings.zoom,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        zoomControl: true,
        styles : [
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
        //
    });

    /**
     * detect map drag and reload archive based on center coordinates
     */
    google.maps.event.addListener(map, 'dragend', async function () {
        //
    });
}
$(function(){
    initArchiveMap();
})