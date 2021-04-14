// init Isotope
var $grid = $('.catalog').isotope({
    itemSelector: '.card',
    layoutMode: 'fitRows',
    getSortData: {
        name: '.name',
        symbol: '.symbol',
        number: '.number parseInt',
        category: '[data-category]',
        weight: function(itemElem) {
            var weight = $(itemElem).find('.weight').text();
            return parseFloat(weight.replace(/[\(\)]/g, ''));
        }
    }
});

// filter functions
var filterFns = {
    // show if number is greater than 50
    numberGreaterThan50: function() {
        var number = $(this).find('.number').text();
        return parseInt(number, 10) > 50;
    },
    // show if name ends with -ium
    ium: function() {
        var name = $(this).find('.name').text();
        return name.match(/ium$/);
    }
};

$(document).ready(function() {
    console.log("ready!");
    $('#categorie').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[filterValue] || filterValue;
        $grid.isotope({ filter: filterValue });
    });

    // bind sort button click
    $('#sorts').on('click', 'button', function() {
        var sortByValue = $(this).attr('data-sort-by');
        $grid.isotope({ sortBy: sortByValue });
    });

    // change is-checked class on buttons
    $('.button-group').each(function(i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', 'button', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });
});

function retireQte(Id_Panier, Id_Article, prix) {

    let params = [Id_Panier, Id_Article, prix];

    // jQuery Ajax Post Request
    $.post('vues/process-cart.php', {
        params: params
    }, (response) => {
        // response from PHP back-end
        console.log(response);

        let respArr = $.parseJSON(response);
        console.log(respArr[0]);
        console.log(respArr[1]);

        $('#qte' + Id_Panier).val = respArr[0];
        $('#prixT' + Id_Panier).html = respArr[1];
    });

};
