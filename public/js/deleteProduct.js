$(document).ready(
    function () {
        $("a#submit_delete").click(
            function () {
                const deletedId = $(this).attr('data-id');
                if (confirm('Jste si jisti, že chcete tento produkt smazat?')) {
                    $.ajax(
                        {
                            url: '/public/products/productDelete.php?id=' + deletedId,
                            type: 'delete',
                            success: function () {
                                alert('Deleted successfully')
                                window.location.href = '/public/index.php';
                            }
                        }
                    );
                }
            }
        )
    }
);
