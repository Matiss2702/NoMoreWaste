$( document ).ready(function() {

    $.ajax({ 
        type: 'GET', 
        url: 'https://www.themealdb.com/api/json/v1/1/list.php?i=list', 
        data: { get_param: 'value' }, 
        dataType: 'json',
        success: function (data) { 
            $.each(data.meals, function(index, element) {
                myhtml= `<div class="form-check-inline">
                <input class="form-check-input" type="checkbox" value="${element.strIngredient}" id="${element.strIngredient}">
                <label class="form-check-label" for="${element.strIngredient}">
                   ${element.strIngredient}
                </label>
              </div>`
                $('.ingredient').append(myhtml)
            });
        }
    });
});

function meal()
{
    $( document ).ready(function() {
        $('.meals').empty()
        link="https://www.themealdb.com/api/json/v2/9973533/filter.php?i="
        ingredients = []
        ingredient = ""
        $("input[type=checkbox]:checked").each(function(){
          ingredients.push($($(this)).val())
        });

        ingredients.forEach(element => {
          if(element != ingredients.at(-1)) {
            ingredient = element +','
          } else {
            ingredient = element
          }
          link+=ingredient.split(' ').join('_')
        });

        console.log(link)
        $.ajax({ 
            type: 'GET', 
            url: link, 
            data: { get_param: 'value' }, 
            dataType: 'json',
            success: function (data) { 
                $.each(data.meals, function(index, element) {
                    myhtml = `<div class="g-col-4 grid">
                    <img src="${element.strMealThumb}" class="rounded img-thumbnail w-25">
                    <span class=" me-auto ms-auto"> ${element.strMeal} <span>
                  </div>`
                    $('.meals').append(myhtml)
                });
            }
        });
    }); 
}