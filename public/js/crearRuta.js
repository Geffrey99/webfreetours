$(function(){
    $("#modal").dialog({
        autoOpen: true,
        modal: true,
        draggable: false,
        position: { my: "top", at: "top", of: window },
        width:"90%",
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
            width:"90%",        
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
        $("#map").parent().css({height: "60vh",top : "15vh"});
        $("#map").css({height: "110%"});

    });

    
});