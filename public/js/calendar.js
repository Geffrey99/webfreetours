$(document).ready(function() {
    var request_calendar = "/api/ruta/gettours";  // URL de tu API

    var calendarEl = $('#calendar');
    var calendar = new FullCalendar.Calendar(calendarEl[0], {
        initialView: 'dayGridMonth',
        locale: 'es',  // Configuración en español

        events: function(fetchInfo, successCallback, failureCallback) {
            $.ajax({
                url: request_calendar,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var events = data.map(function(event) {
                        return {
                            title: event.title,
                            // hora: event.hora,
                            start: event.start,
                            // Agrega aquí otros campos según sea necesario
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
            return {
                html: `
                <div style="overflow: hidden; font-size: 12px; position: relative; cursor: pointer; font-family: 'Inter', sans-serif;">
                    <div><strong>${info.event.title}</strong></div>
                    
                   
                </div>
                `
            };
        },

        eventMouseEnter: function(mouseEnterInfo) {
            var el = $(mouseEnterInfo.el);
            el.addClass("relative");

            var newEl = $('<div>');
            var newElTitle = mouseEnterInfo.event.title;
            newEl.html(`
                <div
                    class="fc-hoverable-event"
                    style="position: absolute; bottom: 100%; left: 0; width: 300px; height: auto; background-color: white; z-index: 50; border: 1px solid #e2e8f0; border-radius: 0.375rem; padding: 0.75rem; font-size: 14px; font-family: 'Inter', sans-serif; cursor: pointer;"
                >
                    <strong>${newElTitle}</strong>
                </div>
            `);
            el.after(newEl);
        },

        eventMouseLeave: function() {
            $(".fc-hoverable-event").remove();
        }
    });

    calendar.render();
});
