$(document).ready(function() {

    var fechaInicio = moment(localStorage.getItem('fechaInicio'), 'YYYY-MM-DD');
    var fechaFin = moment(localStorage.getItem('fechaFin'), 'YYYY-MM-DD');
    
    //INPUT DE PROGRAMACION
    $('input[name="datefilter"]').daterangepicker({
        autoUpdateInput: false,
        minDate: fechaInicio, // Establecer la fecha mínima permitida
        maxDate: fechaFin, // Establecer la fecha máxima permitida
    }).on('apply.daterangepicker', function(ev, picker) {
        if (picker.startDate.isBefore(fechaInicio) || picker.endDate.isAfter(fechaFin)) {
            alert('La fecha seleccionada está fuera del rango permitido.');
        } else {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        }
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });


   
    $("#guardar").click(function(e) {
        e.preventDefault();

        var rangoFechas = $('input[name="datefilter"]').data('daterangepicker');
        var from = rangoFechas.startDate.format('DD/MM/YYYY');
        var to = rangoFechas.endDate.format('DD/MM/YYYY');
        var diasSeleccionados = $("#diasSemana input:checked").map(function() {
            return $(this).val();
        }).get();
        var diasTexto = diasSeleccionados.join(", ");
        var hora = $("#time").val();
        var guiaId = $("#selectGuia").val();
        var guiaNombre = $("#selectGuia option:selected").text();
        

       
        var fila = $("<tr>").appendTo("#tabla tbody");
        fila.data("guiaId", guiaId);
        $("<td>").text(from + " - " + to).appendTo(fila);
        $("<td>").text(diasTexto).appendTo(fila);
        $("<td>").text(hora).appendTo(fila);
        $("<td>").text(guiaNombre).appendTo(fila);
    });

    // Evento click para el botón de recoger datos y enviarlos al servidor
    $("#btnCrearProgramacion").click(function() {
        var datos = [];

        // Iterar sobre cada fila de la tabla
        $("#tabla tbody tr").each(function() {
            var fila = $(this);

            var rangoFecha = fila.find("td:nth-child(1)").text();
            var dias = fila.find("td:nth-child(2)").text();
            var hora = fila.find("td:nth-child(3)").text();
            // var guia = fila.find("td:nth-child(4)").text();
            var guiaId = fila.data("guiaId");

            // Añadir un objeto con los datos de la fila al array
            datos.push({
                rangoFecha: rangoFecha,
                dias: dias,
                hora: hora,
                guia: guiaId
            });
        });
        var rutaId = localStorage.getItem('rutaId');
        // Enviar los datos al servidor
        $.ajax({
            url: '/api/ruta/assign_programacion', // Reemplaza con la ruta correcta en tu aplicación
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({  rutaId: rutaId , programacion: datos }),
            success: function(response) {
                console.log(response); // Hacer algo con la respuesta del servidor si es necesario
                swal({
                    icon: 'success',
                    title: '¡Programacion de ruta!' .rutaId + ' creada correctamente!',
                    text: 'Tours creados.',
                });
            },
            error: function(error) {
                console.error(error);
                swal({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'Hubo un problema al crear la programacion. Inténtalo de nuevo.',
                });
            }
        });
    });
});
