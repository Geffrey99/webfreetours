$(document).ready(function() {
   
    var rutaId;

    var fechaInicio, fechaFin;
        $('input[name="daterange"]').daterangepicker({
            autoUpdateInput: false,
            minDate: moment().add(1, 'days'), // A partir del día siguiente
            // locale: localeConfig
        }).on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            // Aquí puedes obtener las fechas de inicio y fin
            fechaInicio = picker.startDate.format('DD/MM/YYYY').split('/').reverse().join('-');
            fechaFin = picker.endDate.format('DD/MM/YYYY').split('/').reverse().join('-');
            localStorage.setItem('fechaInicio', fechaInicio);
            localStorage.setItem('fechaFin', fechaFin);
        }).on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
        
   
    $('#btnRuta').click(function(e) {
        e.preventDefault();
    debugger;
        // VAR jsonData= JSON.stringify({
        // Crear un objeto FormData para enviar los datos del formulario
        let formData = new FormData();
        formData.append('nombre', $('#inputTitulo').val());
        formData.append('descripcion', $('#textarea').val());
        formData.append('foto', $('input[type="file"][id^="images-"]')[0].files[0]);
        formData.append('punto_inicio', '(' + $('#x').val() + ', ' + $('#y').val() + ')');
        formData.append('participantes', $('#aforo').val());
        formData.append('fecha_inicio', fechaInicio);
        formData.append('fecha_fin', fechaFin);
        
        console.log('Fecha de inicio:', fechaInicio);
console.log('Fecha de fin:', fechaFin);
console.log('Datos del formulario:', formData);
    
        // Enviar los datos a la API
        $.ajax({
            url: '/api/ruta/insert',
            type: 'POST',
            data: formData,
            processData: false,  // Indicar a jQuery que no procese los datos
            contentType: false,  // Indicar a jQuery que no establezca el tipo de contenido
            success: function(data) {
                console.log('Success:', data);
                var rutaId = data.id;
                localStorage.setItem('rutaId', data.id);
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });

});



//AÑADIR VISITA






// $(document).ready(function() {
//     // Botón Ruta
//     $('#btnRuta').click(function(e) {
//         e.preventDefault();

//         // Recoger los datos de la pestaña "Ruta"
//         let ruta = {
//             nombre: $('#inputTitulo').val(),
//             descripcion: $('#textarea').val(),
//             foto: $('#input-images')[0].files.length > 0 ? $('#input-images')[0].files[0] : null,
//             punto_inicio: '(' + $('#x').val() + ', ' + $('#y').val() + ')',
//             participantes: $('#aforo').val(),
//             fecha_inicio: $('#fecha').val(),
//             fecha_fin: $('#fechafin').val(),
//             // programacion: $('#programacion').val() = 'd',
//         };

//         // Enviar los datos a la API
//         sendDataToApi(ruta);
//     });

//     // Botón Visitas
//     $('#btnVisitas').click(function(e) {
//         e.preventDefault();

//         // Recoger los datos de la pestaña "Visitas"
//         let visitas = {
//             ciudad: $('#salutation').val(),
//             items: $('#sortable1').children().map(function() { return $(this).text(); }).get(),
//         };

//         // Enviar los datos a la API
//         sendDataToApi(visitas);
//     });

//     // Botón Programación
//     $('#btnProgramacion').click(function(e) {
//         e.preventDefault();

//         // Recoger los datos de la pestaña "Programación"
//         let programacion = {
//             desde: $('#from').val(),
//             hasta: $('#to').val(),
//         };

//         // Enviar los datos a la API
//         sendDataToApi(programacion);
//     });

//     // Función para enviar los datos a la API
//     function sendDataToApi(data) {
//         $.ajax({
//             url: '/api/ruta/insert',
//             type: 'POST',
//             contentType: 'application/json',
//             data: JSON.stringify(data),
//             success: function(data) {
//                 console.log('Success:', data);
//             },
//             error: function(error) {
//                 console.error('Error:', error);
//             }
//         });
//     }
// });
