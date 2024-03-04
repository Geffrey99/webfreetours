
$(document).ready(function () {
    $(document).ready(function () {
        $('.reservar-tour').click(function (e) {
            e.preventDefault();
    
            var id = $(this).data('id');
            var userId = $(this).data('user-id');
            $.ajax({
                url: '/api/ruta/gettour/' + id,
                type: 'GET',
                success: function (data) {
                    
                    $.each(data, function (i, tour) {
                        
                        window.location.href = '/reservar/' + tour.id + '?userId=' + userId;
                    });
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });
    });
});    
//     $('.reservar-tour').click(function(e) {
//         e.preventDefault();

//         var id = $(this).data('id');
//         var userId = $(this).data('user-id');
//         $.ajax({
//             url: '/api/ruta/gettour/' + id,
//             type: 'GET',
//             success: function(data) {
//                 $('#tourModalBody').empty();
//                 $.each(data, function(i, tour) {
//                     $('#tourModalBody').append('<p>Tour ' + tour.title + ' a las ' + tour.start + '</p>');
//                     $('#tourModalBody').append('<a href="/reservar/' + tour.id + '?userId=' + userId + '" class="btn btn-primary">Reservar este tour</a>');
//                 });

//                 // Muestra el modal
//                 $('#tourModal').modal('show');
//             },
//             error: function(error) {
//                 console.error(error);
//             }
//         });
//     });
// });
    // $('#ruta-link').on('click', function(event) {
    //     event.preventDefault();
    //     $('#rutas-containeer').show();
    //     $('#cuerpo-container').hide();
    //     $('#reservas-container').hide();
    // });

    // $('#reservas-link').on('click', function(event) {
    //     event.preventDefault();
    //     $('#reservas-container').show();
    //     $('#cuerpo-container').hide();
    //     $('#rutas-container').hide();
    // });

    // $('#otraOpcion-link').on('click', function(event) {
    //     event.preventDefault();
    //     // Manejar otro enlace si es necesario
    // });
