$(document).ready(function () {
    $('button#product_create').click(function () {
        $('form#product_form').attr('action', 'productInsert.php').submit();
    });

    $('button#product_update').click(function () {
        const updatedId = $(this).attr('data-id');
        $('form#product_form').attr('action', 'productInsert.php?id=' + updatedId).submit();
    });
});