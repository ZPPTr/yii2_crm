$(function() {
    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

    $(document).ready(function(){
        // get list users for answer
        $(".switch-users-list").on('click', function (e) {
            e.preventDefault();
            var el = $(this),
                listWrap = $('.users-list-'+el.data('id'));

            listWrap.toggleClass('hidden');

            if(!listWrap.hasClass('loaded')) {
                $.ajax({
                    url: el.attr('href'),
                    dataType : "json",
                    success: function (data) {
                        listWrap.html(data).addClass('loaded');
                    }
                });
            }
        });
    });

    $('#add-order-item').on('click', function(e){
        e.preventDefault();
        $(this).addClass('hidden');
        $.get($(this).attr('href'), function(data){
            $('#add-item-form').html(data);
        })
    })

});

function deleteStockItem(itemId, bind) {
     if (!confirm('Вы действительно хотите удалить эту позицию?'))
         return;
    const wrapper = $(bind).parent('.callout');

    $.post('delete-stock-item/', {
        id: itemId
    }, function(response) {
        wrapper
            .toggleClass('callout-info')
            .toggleClass('callout-warning')
            .html('<h4 class="center">Позиция была удалена</h4>')
            .fadeOut(2000)
    });
}


