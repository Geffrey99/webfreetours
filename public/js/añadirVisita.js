$(document).ready(function() {
    $('#btnCrearVisitasTour').click(function() {
        console.log("dfdfsdfs");
        var visitasIds = $('#sortable2 .visita').map(function() {
            return $(this).data('visita-id');
        }).get();
        visitajson = JSON.stringify(visitasIds);
        var rutaId = localStorage.getItem('rutaId');
        $.ajax({
            url: '/rutavisita/create',
            type: 'POST',
            data: {
                visitasIds: visitajson,
                rutaId: rutaId  
            },
            success: function(response) {
                // Manejar la respuesta del servidor
                console.log('RutaVisita creada con éxito:', response);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });
});
