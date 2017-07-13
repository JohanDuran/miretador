var map; //mapa de google global
var marker;


//mapa de google para la función de agregar, utiliza ubicación del usuario para brindar cercanía del lugar
function initMapFields_add() {
    initAutocomplete();
    //se crea el mapa centrado en un punto cualquiera
    var myLatLng = {lat: 10.071137, lng: -84.112214};
    initMap(myLatLng);

    //valor de lat y lng dentro del formulario
    $('#lat').val(myLatLng.lat);
    $('#lng').val(myLatLng.lng);

    //se obtiene la ubicación del usuario para colocar el marcador en ese punto
    //En caso de no obtener el marcador queda en su posición por defecto definida anteriormente
    if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(setMyLocation);
    } else { 
        alert("el navegador no soporta la funcionalidad de geolocalización");
    }

    //se agregan los eventos del mapa clic y drag
    mapEvents();
}



//mapa de google para la vista de editar, carga ubicación desde base de datos
function initMapFields_edit() {
    initAutocomplete();
    //se obtiene la ubicación de los input del formulario BD
    var myLatLng = {lat: parseFloat($('#lat').val()), lng: parseFloat($('#lng').val())};
    initMap(myLatLng);
    //se agregan los eventos del mapa clic y drag
    mapEvents();
}


//inicializar el mapa general, común a
function initMap(myLatLng) {
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: myLatLng,
      gestureHandling: 'cooperative'
    });
    
    //marcador que controla la posición de la cancha
    marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    draggable: true,
    title: 'Ubicación actual'
    });
}


//función encargada de actualizar a la ubicación del usuario, llamada desde mapa agregar
function setMyLocation(position) {
    //posición obtenida
    var lat = parseFloat(position.coords.latitude);
    var lng = parseFloat(position.coords.longitude);
    //valor de lat y lng dentro del formulario
    $('#lat').val(lat);
    $('#lng').val(lng);
    var myLatLng = {lat: lat, lng: lng};
    marker.setPosition(myLatLng);//al obtenerse la ubicación de la persona se cambia el marcador a ese punto
    map.setCenter(myLatLng);
}

//Función que cambia la ubicación del marcador, axionado por el listener del mapa clic, bound_changed
function placeMarker(position) {
    //al darse clic se cambia la posición del marcador
    marker.setPosition(position);
    //map.setCenter(position);
        //valor de lat y lng dentro del formulario
    $('#lat').val(position.lat);
    $('#lng').val(position.lng);
}


//eventos asociados a los movimientos y clic sobre el mapa
function mapEvents() {
    //para todas las vista se crean los eventos
    //se agrega el evento para clic y cambiar marcador de posición
    map.addListener('click', function(event) {placeMarker(event.latLng);});
    map.addListener('bounds_changed', function(event) {placeMarker(map.getCenter());}); 
}


