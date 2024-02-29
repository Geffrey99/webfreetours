$(document).ready(function() {
    $('#ruta-link').on('click', function(event) {
        event.preventDefault(); 
        // window.location.href = $(this).attr('href');
        $.ajax({
            url: '/ruta/uploadCreateRoute', 
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var data = response.rutas;
            
                console.log(data[0].nombre); // Comprueba si puedes acceder a los datos correctamente
            
                if (Array.isArray(data)) {
                    $('#rutas-container').empty();
                    data.forEach(function(ruta) {
                        var rutaHtml = '<div class="ruta">';
                        rutaHtml += '<h2>' + ruta.nombre + '</h2>';
                        rutaHtml += '<p>Descripción: ' + ruta.descripcion + '</p>';
                        // Puedes agregar más detalles de la ruta según tus necesidades
                        rutaHtml += '<button class="ver-programacion" data-ruta-id="' + ruta.id + '">Ver Programación</button>';
                        rutaHtml += '</div>';
                        
                        $('#rutas-container').append(rutaHtml);
                    });
            
                    $('.ver-programacion').on('click', function() {
                        var rutaId = $(this).data('ruta-id');
                        console.log('Obtener programación de la ruta con ID: ' + rutaId);
                    });
                }
            },
            error: function(error) {
                console.error('Error al obtener las rutas:', error);
            }
        });
    });
});
