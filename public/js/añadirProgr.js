$(document).ready(function() {
$("#btnCrearProgramacion").click(function(e) {
    e.preventDefault();

    var dias = {
        "lunes": $("#lunes").is(":checked"),
        "martes": $("#martes").is(":checked"),
        "miercoles": $("#miercoles").is(":checked"),
        "jueves": $("#jueves").is(":checked"),
        "viernes": $("#viernes").is(":checked"),
        "sabado": $("#sabado").is(":checked"),
        "domingo": $("#domingo").is(":checked"),
        // ... y así sucesivamente para cada día de la semana
    };

    var data = {
        "from": $("#from").val(),
        "to": $("#to").val(),
        "dias": dias,
        "hora": $("#time").val(),
        "guia": $("#selectGuia").val()
    };
    console.log(data);
    $.ajax({
        url: '/ruta/a/tu/controlador',  // Reemplaza esto con la URL de tu controlador
        type: 'POST',
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: function(response) {
            // Aquí puedes manejar la respuesta del servidor
        },
        error: function(error) {
            // Aquí puedes manejar los errores
        }
    });
});
});