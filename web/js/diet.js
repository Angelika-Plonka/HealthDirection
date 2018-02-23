$(function(){

    function getRecipe() {
        var keyWord = $("#key").val();
        var calories = $("#calories").val();
        var alcohol = $("#alcohol").val();

        var urlRecipe = "https://api.edamam.com/search?q=chicken&app_id=f0b118cd&app_key=0ce50a18e86f75250d8d11775e120379&from=0&to=3&calories=gte%20591&health=alcohol-free";
        // var urlRecipe = "https://api.edamam.com/search?q=chicken&app_id=f0b118cd&app_key=0ce50a18e86f75250d8d11775e120379&from=0&to=1&calories=gte%700&health=alcohol-free";
        // var urlRecipe = "https://api.edamam.com/search?q=" + keyWord + "&app_id=f0b118cd&app_key=0ce50a18e86f75250d8d11775e120379&from=0&to=1&calories=gte%" + calories + (Boolean(alcohol) ? "&health=" + alcohol : '') + "";
        // console.log(Boolean(alcohol));
        var urlRecipe = "https://api.edamam.com/search?q=" + keyWord + "&app_id=f0b118cd&app_key=0ce50a18e86f75250d8d11775e120379&from=0&to=1&calories=gte%" + calories + (alcohol !== '0' ? "&health=" + alcohol : '') + "";
        console.log(urlRecipe);
        $.ajax({
            url: urlRecipe
        }).done(function (results) {
            console.log(results);
            var href = results.hits[0].recipe.image;
            $('<img style="display: none;" src="' + href + '" />').appendTo('body').fadeIn(1000);
            // displayRecipe(results);
        }).fail(function (error) {
            alert("Błąd");
        });
        // function displayRecipe(results) {
        //
        // }
    }

    $(document).on('click', '#send', function(e){
        e.preventDefault();
        console.log("Czy to działa?");
        // $( "form" ).submit(function( event ) {
        //     event.preventDefault();
        // });
        getRecipe();

    });



});