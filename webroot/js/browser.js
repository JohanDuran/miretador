//utilizado para mostrar el mensaje cerca de tí de una mejor manera
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

var clicked = 0;

// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode']});
    
    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    $('#lat').val(place.geometry.location.lat());
    $('#lng').val(place.geometry.location.lng());
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
}

function fillInAddressMyLocation() {
    if (navigator.geolocation) {
        if(clicked==0){
            var icon = document.getElementById('iconMyLocation');
            icon.setAttribute("class", "rotated-image glyphicon material-icons");   
            clicked=(clicked+1)%2;
        }else{
            var icon = document.getElementById('iconMyLocation');
            icon.setAttribute("class", "glyphicon material-icons");   
            clicked=(clicked+1)%2;
        }

      navigator.geolocation.getCurrentPosition(function(position) {
        var lat= position.coords.latitude;
        var lng= position.coords.longitude;
        $('#lat').val(lat);
        $('#lng').val(lng);
        $('#autocomplete').val('Mí ubicación');    
      });
    }
}