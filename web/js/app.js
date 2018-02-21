function getLocation() {
    var geo = navigator.geolocation;

    if(geo !== undefined) {
        geo.getCurrentPosition(function(location) {
            console.log('Pobieranie lokalizacji');

            var latit = (location.coords.latitude).toFixed(6);
            var long = (location.coords.longitude).toFixed(6);

            var urlCoordinates = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + latit + "," + long + "&key=AIzaSyCRh9MzZSufOyZxFDntc0UMH3Jfv4A9MRk";

            $.ajax({
                url: urlCoordinates
            }).done(function (results) {
                console.log(results);
                displayLocationData(results);
                blockOtherFieldsWhenButtonIsClicked();
            }).fail(function (error) {
                alert("Błąd");
            });

            function displayLocationData(results) {
                $("#cityVal").html(results.results[0].address_components[2].long_name);
                $("#city").val(results.results[0].address_components[2].long_name);
                $("#voivodeshipVal").html(results.results[0].address_components[4].long_name);
                $("#voivodeship").val(results.results[0].address_components[4].long_name);
            }
            function blockOtherFieldsWhenButtonIsClicked() {
                $('#cityToBlock').prop('disabled', true);
                $('#voivodeshipToBlock').prop('disabled', true);
                $('#voivodeship').prop('disabled', false);
                $('#city').prop('disabled', false);
            }
        });
    }
    else {
        $("#coordinates").html = "Geolokalizacja nie jest wspierana przez Twoją przeglądarkę";
    }

}