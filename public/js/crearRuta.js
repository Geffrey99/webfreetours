$(function(){
    $("#modal").dialog({
        autoOpen: false,
        modal: true,
        draggable: false,
        position: { my: "top", at: "top", of: window },
        width:"50%",
        heigth:"99vh"
    });
    
   
   

    $(textarea).richText({
        height: "auto",
        removeStyles:true,
    });

    $('#input-images').imageUploader({
        extensions: ['.jpg','.jpeg','.png'],
    });

    $('#tabs').tabs();

    $("#btnMapa").click(function () {
        var mapa=$('<div id="map"></div>').appendTo('#modal').dialog({
            modal: true,
            width:"50%",        
            draggable: false,
            open: function (event, ui) {
                var mymap = L.map('map').setView([40.2668, -3.6638], 6);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mymap);

                mymap.on('click', function (e) {
                    var lat = e.latlng.lat;
                    var lng = e.latlng.lng;

                    $("#x").val(lat);
                    $("#y").val(lng);

                    $("#map").remove();
                    $(this).remove(); 
                });
            },
            close: function () {
                $("#map").remove();
                $(this).remove();
            }
        });
        $("#map").parent().css({height: "60vh",top : "25vh"});
        $("#map").css({height: "110%"});
// $("body").append(mapa);
    });

    



$(function() {

    var localeConfig = {
        "format": 'DD/MM/YYYY',
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Personalizado",
        "weekLabel": "S",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    };

    var minDate, maxDate;






//__________fecha de ruta
// $('input[name="daterange"]').daterangepicker({
//     autoUpdateInput: false,
//     minDate: moment().add(1, 'days'), // A partir del día siguiente
//     locale: localeConfig
// }).on('apply.daterangepicker', function(ev, picker) {
//     $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
//     minDate = picker.startDate;
//     maxDate = picker.endDate;
// }).on('cancel.daterangepicker', function(ev, picker) {
//     $(this).val('');
    
// });

//_________fecha periodos de ruta 

// $('input[name="datefilter"]').daterangepicker({
//     autoUpdateInput: false,
//     // locale: localeConfig
// }).on('apply.daterangepicker', function(ev, picker) {
//     if (picker.startDate.isBefore(fechaInicio) || picker.endDate.isAfter(fechaFin)) {
//         alert('La fecha seleccionada está fuera del rango permitido.');
//     } else {
//         $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
//     }
// }).on('cancel.daterangepicker', function(ev, picker) {
//     $(this).val('');
// });




    // var dateFormat = "dd/mm/yy";

    // $('#fecha, #fechafin').datepicker({
    //     dateFormat: dateFormat,
    //     onClose: function(selectedDate) {
    //         if (this.id === 'fecha') {
    //             $('#from').datepicker('option', 'minDate', selectedDate);
    //         } else if (this.id === 'fechafin') {
    //             $('#to').datepicker('option', 'maxDate', selectedDate);
    //         }
    //     }
    // });

    // $('#from').datepicker({
    //     dateFormat: dateFormat,
    //     onClose: function(selectedDate) {
    //         var minDate = $('#fecha').datepicker('getDate');
    //         var maxDate = $('#fechafin').datepicker('getDate');
    //         if (new Date(selectedDate) < minDate || new Date(selectedDate) > maxDate) {
    //             alert('La fecha seleccionada está fuera del rango permitido.');
    //             $(this).datepicker('setDate', minDate);
    //         }
    //     }
    // });

    // $('#to').datepicker({
    //     dateFormat: dateFormat,
    //     onClose: function(selectedDate) {
    //         var minDate = $('#fecha').datepicker('getDate');
    //         var maxDate = $('#fechafin').datepicker('getDate');
    //         if (new Date(selectedDate) < minDate || new Date(selectedDate) > maxDate) {
    //             alert('La fecha seleccionada está fuera del rango permitido.');
    //             $(this).datepicker('setDate', maxDate);
    //         }
    //     }
    // });
});



    // Transformando el datepicker en español
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    
    $.datepicker.setDefaults($.datepicker.regional['es']);
});







