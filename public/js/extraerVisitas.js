


$(document).ready(function() {
    $('#salutation').on('change', function() {
        console.log("el evento change se ha disparado");
      
        var selectedLocalidad = $(this).val();
        $('.visita').hide();
        $('.visita[data-localidad="' + selectedLocalidad + '"]').show();
    });
});






//ASIGNAR VISITAS A RUTA--------------------------------

// $("#sortable1, #sortable2").sortable({
//     connectWith: ".connectedSortable",
// update: function(event, ui) {
//     var visitaId = ui.item.data('visita-id');
//     $.ajax({
//       url: '/ruta-visita/create',
//       type: 'POST',
//       data: {
//         visitaId: visitaId,
//         rutaId: rutaId  // Usar el rutaId guardado anteriormente
//       },
//       success: function(response) {
//         // Manejar la respuesta del servidor
//       }
//     });
 
// }).disableSelection();