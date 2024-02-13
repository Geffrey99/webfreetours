// Botón Ruta
document.addEventListener('DOMContentLoaded', (event) => {
    // Tu código aquí

document.getElementById('btnRuta').addEventListener('click', function(e) {
    e.preventDefault();

    // Recoger los datos de la pestaña "Ruta"
    let ruta = {
        nombre: document.getElementById('inputTitulo').value,
        descripcion: document.getElementById('textarea').value,
        foto: document.getElementById('input-images').value,
        punto_inicio: '(' + document.getElementById('x').value + ', ' + document.getElementById('y').value + ')'
,
        participantes: document.getElementById('aforo').value,
        fecha_inicio: document.getElementById('fecha').value,
        fecha_fin: document.getElementById('fechafin').value,
        // programacion: document.getElementById('programacion').value='d',
    };

    // Enviar los datos a la API
    sendDataToApi(ruta);
});

// Botón Visitas
document.getElementById('btnVisitas').addEventListener('click', function(e) {
    e.preventDefault();

    // Recoger los datos de la pestaña "Visitas"
    let visitas = {
        ciudad: document.getElementById('salutation').value,
        items: Array.from(document.getElementById('sortable1').children).map(li => li.textContent),
    };

    // Enviar los datos a la API
    sendDataToApi(visitas);
});

// Botón Programación
document.getElementById('btnProgramacion').addEventListener('click', function(e) {
    e.preventDefault();

    // Recoger los datos de la pestaña "Programación"
    let programacion = {
        desde: document.getElementById('from').value,
        hasta: document.getElementById('to').value,
    };

    // Enviar los datos a la API
    sendDataToApi(programacion);
});

// Función para enviar los datos a la API
function sendDataToApi(data) {
    fetch('/api/ruta/insert', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

});