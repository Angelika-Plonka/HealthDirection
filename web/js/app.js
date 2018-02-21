$(function(){
    function getLocation() {
        var geo = navigator.geolocation;
        var location = $("#location");

        if(geo !== undefined) {
            location.html = "Please wait a moment";
            geo.getCurrentPosition(function(location) {
                console.log('Pobieranie lokalizacji');

                var lat = location.coords.latitude;
                var lng = location.coords.longitude;
                // $("#coordinates").html = latit;
                // $("#coordinates").html = long;
                console.log('Szerokość ' + location.coords.latitude);
                console.log('Długość ' + location.coords.longitude);
            });
        }
        else {
            $("#coordinates").html = "Geolokalizacja nie jest wspierana przez Twoją przeglądarkę";
        }
    }

    getLocation();
});
