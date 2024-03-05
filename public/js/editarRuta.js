$(document).ready(function() {
    $('#btnEditar').click(function() {
        // Obtén el id seleccionado
        var rutaId = $('#rutaSelect').val();

        // Verifica que haya seleccionado una ruta
        if (!rutaId) {
            alert('Por favor, selecciona una ruta.');
            return;
        }
        console.log('ID de ruta:', rutaId);
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
        formData.append('fecha_inicio', $('#fecha_inicio').val());  // Agrega esta línea
        formData.append('fecha_fin', $('#fecha_fin').val());   
console.log(formData);
        $.ajax({
            url: '/api/ruta/update' + rutaId,
            type: 'PUT',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Ruta actualizada:', response);
                // Realiza otras acciones según sea necesario
            },
            error: function(error) {
                console.error('Error al actualizar la ruta:', error);
                console.log(FormData);
            },
        });
    });
});
