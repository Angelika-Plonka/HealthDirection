$(function(){

    function getRecipe() {
        var keyWord = $("#key").val();
        var caloriesMin = $("#caloriesMin").val();
        var caloriesMax = $("#caloriesMax").val();
        var alcohol = parseInt($("#alcohol").val());
        var dairy = parseInt($("#dairy").val());
        var gluten = parseInt($("#gluten").val());
        var kosher = parseInt($("#kosher").val());
        var paleo = parseInt($("#paleo").val());
        var vegan = parseInt($("#vegan").val());
        var vegetarian = parseInt($("#vegetarian").val());
        var noSugar = parseInt($("#noSugar").val());

        var urlRecipe = "https://api.edamam.com/search?q=" + keyWord + "&app_id=f0b118cd&app_key=0ce50a18e86f75250d8d11775e120379&calories=gte%20" + caloriesMin + ",%20lte%20" + caloriesMax + (alcohol ? "&health=" + alcohol : '') + (dairy ? "&health=" + dairy : '') + (kosher ? "&health=" + kosher : '') + (gluten ? "&health=" + gluten : '') + (paleo ? "&health=" + paleo : '') + (vegan ? "&health=" + vegan : '') + (vegetarian ? "&health=" + vegetarian : '') + (noSugar ? "&health=" + noSugar : '');

        // var check = (Boolean(alcohol) ? "&health=" + alcohol : '');
        //var check = (alcohol ? "&health=" + alcohol : '');

        $.ajax({
            url: urlRecipe
        }).done(function (results) {
            console.log(results);
            displayRecipe(results);
        }).fail(function (error) {
            alert("Błąd pobierania danych. Proszę, wprowadź dane jeszcze raz");
        });
        function displayRecipe(results) {
            var numberHits = results.hits.length;
            console.log(numberHits);
            var randomNumber = Math.floor(Math.random()* numberHits);
            console.log(randomNumber);
            var title = results.hits[randomNumber].recipe.label;
            $('<h3>' + title + '</h3>').appendTo('#loadedRecipe');

            var href = results.hits[randomNumber].recipe.image;
            $('<img style="display: none;" src="' + href + '" /><br>').appendTo('#loadedRecipe').fadeIn(1000);

            $('<br><h4>' + "Lista składników: " + '</h4>').appendTo('#loadedRecipe');
            var ingredients = results.hits[randomNumber].recipe.ingredientLines;
            var ingredientsLength = ingredients.length;
            for (var i= 0; i<ingredientsLength; i++){
                $('<ul><li>' + ingredients[i] + '</li></ul>').appendTo('#loadedRecipe');
            }
            var numberCal = results.hits[randomNumber].recipe.calories;
            var numberCalories = Math.round(numberCal);
            $('<br><p>' + '<b>Wartość energetyczna (kcal): </b>' + numberCalories + '</p>').appendTo('#loadedRecipe');

            var source = results.hits[randomNumber].recipe.url;
            $('<p>' + '<b>Link do przepisu: </b>' + '<a href="' + source + '" target="_blank">' + source + '</a>' + '</p>').appendTo('#loadedRecipe');
            var numberOfServings = results.hits[randomNumber].recipe.yield;
            if(numberOfServings === 1){
                $('<p>' + '<b>Danie dla: </b>' + numberOfServings + " osoby" + '</p><br><br>').appendTo('#loadedRecipe');
            }else{
                $('<p>' + '<b>Danie dla: </b>' + numberOfServings + " osób" + '</p><br><br>').appendTo('#loadedRecipe');
            }
        }
    }

    $(document).on('click', '#send', function(e){
        e.preventDefault();
        getRecipe();

    });

});