function calcBasket() {
    var sum = 0;
    $('#basket li').each(function (i, e) {
        sum += $(e).data('sum');
    });
    $('#sum').text('$' + Number(sum).toFixed(2));
}

function updateBasket(data) {
    $('#basket li').remove();
    for (var goodId in data) {
        var element = $('#basketMock li').clone();
        var children = element.children().clone();
        var good = data[goodId];
        element.attr('data-sum', good.sum);
        element.text(good.good.name + ', price: $' + good.good.price + ', amount: ' + good.amount + ', sum: $' + good.sum );
        element.append(children);
        $('div', element).attr('data-basket-item-id', good.good.id);
        $('#basket').append(element);
    }
    calcBasket();
}

$(document).ready(function(e){
    $.get('index.php?ctrl=good&act=basketJson', {},  updateBasket);
    
    $('#goodList li a[name=buy]').click(function(ev) {
        var theButton = this;
        var id = $(theButton).parent().data('goodid');
        $.post('index.php?ctrl=good&act=buy', {id: id},
        updateBasket)
                .fail(function(data) {
                    alert('fail');
        });
        ev.preventDefault();
    });
    
    $('#basket').on('click', '[data-basket-item-id]',  function (event) {
        var item = this;
        $.post('index.php?ctrl=good&act=delBasketItem',
            {id: $(this).data('basket-item-id')},
            function(data) {
                if (data == 1) {
                    $(item).parent().parent().remove();
                    calcBasket();
                } else {
                    console.log('fail');
                }
            });
    });
});