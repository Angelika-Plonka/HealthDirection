$(function(){

    function getRecipe() {
        var keyWord = $("#key").val();
        var caloriesMin = $("#caloriesMin").val();
        var caloriesMax = $("#caloriesMax").val();
        var alcohol = parseInt($("#alcohol").val());

        var urlRecipe = "https://api.edamam.com/search?q=" + keyWord + "&app_id=f0b118cd&app_key=0ce50a18e86f75250d8d11775e120379&from=0&to=30&calories=gte%20" + caloriesMin + ",%20lte%20" + caloriesMax + (alcohol ? "&health=" + alcohol : '');

        // var check = (Boolean(alcohol) ? "&health=" + alcohol : '');
        //var check = (alcohol ? "&health=" + alcohol : '');
        var urlRecipeBezKalorii = "https://api.edamam.com/search?q=" + keyWord + "&app_id=f0b118cd&app_key=0ce50a18e86f75250d8d11775e120379&from=0&to=3";
        console.log(urlRecipe);

        $.ajax({
            url: urlRecipe
        }).done(function (results) {
            console.log(results);
            displayRecipe(results);
        }).fail(function (error) {
            alert("Błąd");
        });
        function displayRecipe(results) {
            var numberHits = results.hits.length;
            var randomNumber = Math.floor(Math.random()* numberHits);
            var title = results.hits[randomNumber].recipe.label;
            $('<h3>' + "Tytuł przepisu: " + title + '</h3>').prepend('#loadedRecipe');
            var href = results.hits[randomNumber].recipe.image;
            $('<img style="display: none;" src="' + href + '" />').prepend('#imageRecipe').fadeIn(1000);
            // var numberCalories =
        }
    }

    $(document).on('click', '#send', function(e){
        e.preventDefault();
        getRecipe();

    });



});