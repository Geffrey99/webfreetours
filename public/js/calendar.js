$(document).ready(function() {
    var request_calendar = "/api/ruta/gettours";  
    var newElTitle = ''; 
    var calendarEl = $('#calendar');
    var calendar = new FullCalendar.Calendar(calendarEl[0], {
        initialView: 'dayGridMonth',
        locale: 'es',  

        events: function(fetchInfo, successCallback, failureCallback) {
            $.ajax({
                url: request_calendar,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var events = data.map(function(event) {
                        return {
                            title: event.title,
                            start: event.start,
                            id: event.IdTour,
                           
                        };
                    });
                    successCallback(events);
                },
                error: function(error) {
                    failureCallback(error);
                }
            });
        },

        eventContent: function(info) {

            var now = new Date();
            var eventDate = new Date(info.event.start);

            // Comparar la fecha del evento con la fecha actual
            if (eventDate < now) {
                // Evento pasado: resaltar en rojo
                return {
                    html: `
                        <div style="overflow: hidden; font-size: 12px; position: relative; cursor: pointer; font-family: 'Inter', sans-serif; color: red;">
                            <div><strong>${info.event.title}</strong></div>
                        </div>
                    `
                };
            } else {
                // Evento futuro: resaltar en verde
                return {
                    html: `
                        <div style="overflow: hidden; font-size: 12px; position: relative; cursor: pointer; font-family: 'Inter', sans-serif; color: green;">
                            <div><strong>${info.event.title}</strong></div>
                        </div>
                    `
                };
            }
        },

        eventMouseEnter: function(mouseEnterInfo) {
            var el = $(mouseEnterInfo.el);
            el.addClass("relative");

            var newEl = $('<div>');
            var newElTitle = mouseEnterInfo.event.title;
            var tourId = mouseEnterInfo.event.id;
            newEl.html(`
                <div class="fc-hoverable-event"
                     style="position: absolute; bottom: 100%; left: 0; width: 300px; height: auto; background-color: white; z-index: 50; border: 1px solid #e2e8f0; border-radius: 0.375rem; padding: 0.75rem; font-size: 14px; font-family: 'Inter', sans-serif; cursor: pointer;"
                >
                    <strong class="edit-tour-btn" data-bs-toggle="modal" data-target="#editEventModal" data-tour-id="${tourId}">${newElTitle}</strong>
                </div>
            `);
            el.after(newEl);
        },

        eventMouseLeave: function() {
            $(".fc-hoverable-event").remove();
        },
        eventClick: function(info) {
            currentEvent = info.event; 
            openEditEventModal(info.event.title, info.event.id);
            // var eventTitle = prompt('Editar título del evento:', info.event.title);
            // if (eventTitle) {
            //     // Realiza la lógica para actualizar el título del evento en el servidor
            //     // Puedes usar AJAX para enviar la actualización al servidor
            //     // Después de actualizar, refresca el calendario para reflejar los cambios
            //     info.event.setProp('title', eventTitle);
            //     calendar.refetchEvents();
            // }
        },
    });

    calendar.render();

    function openEditEventModal(title, event) {
    // Abre el modal y establece el valor del campo de título del evento
    $('#eventTitle').val(title);
    // $('#selectGuia').val(eventId); // Puedes utilizar esto para seleccionar automáticamente el guía asociado al evento
    $('#editEventModal').modal('show');
}

$('#saveChangesBtn').on('click', function() {
    // Obtiene los valores actualizados desde los campos de entrada del modal
    var updatedTitle = $('#eventTitle').val();
    var selectedGuiaId = $('#selectGuia').val();

    // Actualiza el título del evento en el calendario
    currentEvent.setProp('title', updatedTitle);

    // Llama a la función para actualizar el ID del guía en el backend
    updateGuia(selectedGuiaId, currentEvent.id);

    // Cierra el modal
    $('#editEventModal').modal('hide');
});

function updateGuia(idGuide, idTour) {
    var formData = new FormData();
    formData.append('idGuide', idGuide);
    formData.append('idTour', idTour);

    $.ajax({
        url: '/editarguiaCalendario',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data);
           // location.reload();
        },
        error: function (xhr, status, error) {
            console.log('Error al obtener los datos de la API:', error);
        }
    });

    
    calendar.refetchEvents();
}
});
