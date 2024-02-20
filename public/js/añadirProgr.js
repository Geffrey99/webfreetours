$(document).ready(function() {
    // Evento click para el botón de guardar
    $("#guardar").click(function(e) {
        e.preventDefault();

        var from = $("#from").val();
        var to = $("#to").val();
        var diasSeleccionados = $("#diasSemana input:checked").map(function() {
            return $(this).val();
        }).get();
        var diasTexto = diasSeleccionados.join(", ");
        var hora = $("#time").val();
        var guia = $("#selectGuia").val();

        // Agregar fila a la tabla
        var fila = $("<tr>").appendTo("#tabla tbody");
        $("<td>").text(from + " - " + to).appendTo(fila);
        $("<td>").text(diasTexto).appendTo(fila);
        $("<td>").text(hora).appendTo(fila);
        $("<td>").text(guia).appendTo(fila);
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
            var guia = fila.find("td:nth-child(4)").text();

            // Añadir un objeto con los datos de la fila al array
            datos.push({
                rangoFecha: rangoFecha,
                dias: dias,
                hora: hora,
                guia: guia
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
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
});
