$(document).ready(function() {
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
    $('#btnEditar').click(function(e) {
    e.preventDefault();
        var rutaId = $('#rutaId').val();
        console.log('ID de ruta:', $('#rutaId').val());
        console.log('Nombre:', $('#inputTitulo').val());
        console.log('Descripción:', $('#textarea').val());
        console.log('Foto:', $('input[type="file"][id^="images-"]')[0].files[0]);
        console.log('Punto de inicio:', '(' + $('#x').val() + ', ' + $('#y').val() + ')');
        console.log('Participantes:', $('#aforo').val());
        // Crea un objeto FormData para enviar los datos del formulario
        let formData = new FormData();
        formData.append('nombre', $('#inputTitulo').val());
        formData.append('descripcion', $('#textarea').val());
        formData.append('foto', $('input[type="file"][id^="images-"]')[0].files[0]);
        formData.append('punto_inicio', '(' + $('#x').val() + ', ' + $('#y').val() + ')');
        formData.append('participantes', $('#aforo').val());
        formData.append('fecha_inicio', fechaInicio);  // Agrega esta línea
        formData.append('fecha_fin', fechaFin);   
console.log(formData);
        $.ajax({
            url: '/api/ruta/update' + rutaId,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                swal({
                    icon: 'success',
                    title: '¡Ruta editada correctamente!',
                    text: 'Ruta editada.',
                }).then(function() {
                    window.location = "/admin";
                });
                
            },
            error: function(error) {
                console.error(error);
                swal({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Hubo un problema al editar la ruta. Inténtalo de nuevo.',
                });
            }
        });
    });
});