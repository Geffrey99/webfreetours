// muestraMapa.js

$(document).ready(function() {
    // Obtén las coordenadas del punto de inicio desde el atributo data del elemento HTML
    var puntoInicio = $("#map").data("puntoInicio");

    // Elimina los paréntesis y comillas y divide las coordenadas en latitud y longitud
    var coordenadas = puntoInicio.replace(/[()"]/g, '').split(',');

    // Ahora, coordenadas[0] es la latitud y coordenadas[1] es la longitud
    var latitud = parseFloat(coordenadas[0]);
    var longitud = parseFloat(coordenadas[1]);

    // Asegúrate de que las coordenadas son válidas antes de crear el mapa
    if (!isNaN(latitud) && !isNaN(longitud)) {
        // Crea un mapa Leaflet centrado en las coordenadas del punto de inicio
        var map = L.map('map').setView([latitud, longitud], 13);

        // Crea un objeto LatLng con las coordenadas
        var puntoInicioLatLng = L.latLng(latitud, longitud);

        // Agrega un marcador al mapa en las coordenadas del punto de inicio
        L.marker(puntoInicioLatLng).addTo(map);

        // Agrega un mapa base (puedes cambiarlo según tus necesidades)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
    } else {
        console.error('Coordenadas no válidas:', puntoInicio);
    }
});
