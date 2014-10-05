$(document).ready(function(e){
    $('[data-basket-item-id]').each(function (i, e) {
        $(e).click(function (event, el) {
            var item = this;
            $.post('index.php?ctrl=good&act=delBasketItem',
                {id: $(this).data('basket-item-id')},
                function(data) {
                    if (data == 1) {
                        $(item).parent().parent().remove();
                        var sum = 0;
                        $('#basket li').each(function (i, e) {
                            sum += $(e).data('sum');
                        });
                        $('#sum').text('$' + sum);
                    } else {
                        console.log('fail');
                    }
                });
        });
    });
});