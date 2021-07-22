$(document).ready(function () {
    $("a#submit_delete").click(function () {
        const deletedId = $(this).attr('data-id');
        if (confirm('Are you sure, that you want to delete this product?')) {
            $.ajax({
                url: '/public/products/productDelete.php?id=' + deletedId,
                type: 'delete',
                success: function () {
                    alert('Deleted successfully')
                    window.location.href = '/public/index.php';
                }
            });
        }
    })
});
