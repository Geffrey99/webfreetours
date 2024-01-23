$( function() {
    $( "#datepicker" ).datepicker();
  } );

// $ (function () {
//     //al iniciar 
//      $("#datepicker").show();
//      $("#boxIda").hide();
//      $("#boxIdaVuelta").hide();
//      $("#from").hide();
//      $("#to").hide();

//      //cuando marca solo ida
//     $("#ida").click(function(){
//                 $("#boxIda").show();
//                 $("#datepicker").show();
//                 $("#datepicker").datepicker({
//                     minDate:1, //Reservar a partir del dia siguiente
//                     maxDate:30 //Reservar hasta 30 dias en el futuro
//                 });
//                 $("#boxIdaVuelta").hide();
//                 $("#from").hide();
//                 $("#to").hide();
//             });

//             //Cuando marca ida_vuelta
//             $("#ida_vuelta").click(function(){
//                         $("#boxIdaVuelta").show();
//                         $("#boxIda").hide();
//                         $("#datepicker").hide();                        
//                         $("#from").show();
//                         $("#from").datepicker({
//                             defaultDate: "+1w",
//                             changeMonth: true,
//                             numberOfMonths: 1,
//                             minDate:1,
//                             maxDate:30
//                         })
//                         .on( "change", function() {
//                             to.datepicker( "option", "minDate", getDate( this ) );
//                          }),
//                         $("#to").show();
//                         $("#to").datepicker({
//                             defaultDate: "+1w",
//                             changeMonth: true,
//                             numberOfMonths: 1,
//                             minDate:1,
//                             maxDate:30
//                         })
//                         .on( "change", function() {
//                             from.datepicker( "option", "maxDate", getDate( this ) );
//                             });
//                     });
//                     function getDate( element ) {
//                           var date;
//                         try {
//                         date = $.datepicker.parseDate( dateFormat, element.value );
//                         } catch( error ) {
//                         date = null;
//                         }
                         
//                         return date;
//                         }
//     } );

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



