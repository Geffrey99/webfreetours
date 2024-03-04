$(document).ready(function() {


        
    $( "ul.droptrue" ).sortable({
    connectWith: "ul"
  });

    $( "ul.dropfalse" ).sortable({
    connectWith: "ul",
    dropOnEmpty: false
  });

    $( "#sortable1, #sortable2, #sortable3" ).disableSelection();





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
               
                console.log('RutaVisita creada con éxito:', response);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });
});
