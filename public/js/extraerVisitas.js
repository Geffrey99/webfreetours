// $(document).ready(function() {
//     $('#salutation').change(function() {
//         var localidadId = $(this).val();

//         $.ajax({
//             url: '/filtrar-visitas/' + localidadId,
//             type: 'GET',
//             success: function(data) {
//                 var visitas = data.visitas;

//                 // Show/hide elements based on the response
//                 $('#sortable1 > li').each(function() {
//                     var localidad = $(this).data('localidad');
//                     if (visitas.some(visita => visita.cod_localidad == localidad)) {
//                         $(this).show();
//                     } else {
//                         $(this).hide();
//                     }
//                 });
//             },
//             error: function(error) {
//                 console.log('Error fetching data:', error);
//             }
//         });
//     });
// });


// $(document).ready(function() {
//     $('#salutation').on('change', function() {
//         console.log("El evento de cambio se ha activado.");
//         var localidadId = 10;  // Establece el id de la localidad a 10
//         $.ajax({
//             url: '/filtrar-visitas/' + localidadId,
//             type: 'GET',
//             success: function(data) {
//                 var visitas = data.visitas;
//                 console.log(visitas);  // Imprime las visitas en la consola
//             },
//             error: function(error) {
//                 console.log(error);
//             }
//         });
//     });
// });

// $(document).ready(function() {
//     $('#salutation').on('change', function() {
//         var localidadId = $(this).val();
//         $.ajax({
//             url: '/filtrar-visitas/' + localidadId,
//             type: 'GET',
//             success: function(data) {
//                 var visitas = data.visitas;
//                 // Vacía tu lista ordenable
//                 $('#sortable1').empty();
//                 // Agrega solo las visitas que se relacionan con la localidad seleccionada
//                 $.each(visitas, function(i, visita) {
//                     // Construye la ruta completa o relativa de la imagen
//                     var imagePath = '/public/img/visitas/' + visita.foto;
//                     $('#sortable1').append('<li class="" data-localidad="' + visita.cod_localidad + '"><div class="image-container"><img src="' + imagePath + '" alt="' + visita.nombre + '"><p class="text-center">' + visita.nombre + '</p></div></li>');
//                 });
//             },
//             error: function(error) {
//                 console.log(error);
//             }
//         });
//     });
// });


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