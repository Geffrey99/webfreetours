$(function(){
    $("#modal").dialog({
        autoOpen: false,
        modal: true,
        draggable: false,
        position: { my: "top", at: "top", of: window },
        width:"50%",
        heigth:"99vh"
    });
    
   
    // Resto de tu código...

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

    
//######_______SELECCIONAR LA FECHA Y HORA (INICIO Y FIN) DEL EVENTO (DATETIMEPICKER)
$('#fecha').datetimepicker({
    format: "d/m/Y H:m:s",
    lang: "es",
});

$('#fechafin').datetimepicker({
    format: "d/m/Y H:m:s",
    lang: "es",
});

$( "#salutation" ).selectmenu();
    
    
$( "ul.droptrue" ).sortable({
    connectWith: "ul"
  });

  $( "ul.dropfalse" ).sortable({
    connectWith: "ul",
    dropOnEmpty: false
  });

  $( "#sortable1, #sortable2, #sortable3" ).disableSelection();

//#######################----PESTAÑA ITEMS

$( "#salutation" ).selectmenu();
    
    
$( "ul.droptrue" ).sortable({
    connectWith: "ul"
  });

  $( "ul.dropfalse" ).sortable({
    connectWith: "ul",
    dropOnEmpty: false
  });

  $( "#sortable1, #sortable2, #sortable3" ).disableSelection();


//#####################------VENTANA PROGRAMACION


$("#from").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 1,
    minDate:1,
    maxDate:30
})
.on( "change", function() {
    to.datepicker( "option", "minDate", getDate( this ) );
 }),
$("#to").show();
$("#to").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 1,
    minDate:1,
    maxDate:30
})
.on( "change", function() {
    from.datepicker( "option", "maxDate", getDate( this ) );
    });
    function getDate( element ) {
        var date;
      try {
      date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
      date = null;
      }
       
      return date;
      }



});




//Transformando el datepicker en español
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
   $(function () {
   $("#fecha").datepicker();
   });










//###########----GUARDAR PROGRAMACION EN LA TABLA DE CRUD 
function guardarDatos(e) {
    // Evitar que el formulario se envíe
    e.preventDefault();
    // Obtener los elementos del formulario
    var from = document.getElementById("from");
    var to = document.getElementById("to");
    var dias = document.querySelectorAll("#diasSemana input:checked");
    var time = document.getElementById("time");
    var salutation = document.getElementById("salutation");
    // Obtener los valores de los elementos
    var rango = from.value + " - " + to.value;
    var diasSeleccionados = [];
    for (var i = 0; i < dias.length; i++) {
      diasSeleccionados.push(dias[i].value);
    }
    var diasTexto = diasSeleccionados.join(", ");
    var hora = time.value;
    var guia = salutation.value; // Aquí estaba el error
    // Obtener la tabla donde se guardarán los datos
    var tabla = document.getElementById("tabla");
    // Crear una nueva fila en la tabla
    var fila = tabla.insertRow();
    // Crear las celdas de la fila y asignarles los valores
    var celdaRango = fila.insertCell();
    celdaRango.textContent = rango;
    var celdaDias = fila.insertCell();
    celdaDias.textContent = diasTexto;
    var celdaHora = fila.insertCell();
    celdaHora.textContent = hora;
    var celdaGuia = fila.insertCell();
    celdaGuia.textContent = guia;

    frm.reset ();
  }



// $(document).ready(function () {
//     var closeButton = $(".ui-dialog-titlebar-close");
//     closeButton.on("click", function () {
//         window.location.href = "/admin";
//     });
// });
