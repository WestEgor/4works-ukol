<?php
if (!session_id()) {
    session_start();
}
require __DIR__ . '/../../vendor/autoload.php';

use Configure\DotEnv;
use Entity\CategoriesMapper;
use Model\Category;

(new DotEnv(__DIR__ . '/../../.env'))->load();

$categoryMapper = new CategoriesMapper();
$productMapper = new \Entity\ProductsMapper();
$categories = $categoryMapper->findAll();
$product = null;
if (isset($_REQUEST['id'])) {
    $id = (int)$_REQUEST['id'];
    $product = $productMapper->findByKey($id);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://bootswatch.com/5/minty/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Products</title>

</head>
<body>
<?php require __DIR__ . '/../navbar.php'; ?>


<form id="product_form" method="post">
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="pname" class="form-label">Name of product:</label>
            <input type="text" id="pname" name="product_name" class="form-control"
                   value="<?php if (is_null($product)) {
                       echo(!empty($_SESSION['product_name']) ? $_SESSION['product_name'] : '');
                   } else {
                       echo $product->getProductName();
                   } ?>">
        </div>
        <div class="col-auto">
            <label>Categories:
                <select name="product_category" class="form-select" aria-label="Default select example">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->getId() ?>">
                            <?php echo $category->getCategoryName(); ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
        <div class="col-auto">
            <label for="pprice" class="form-label">Price:</label>
            <input type="text" id="pprice" name="product_price" class="form-control"
                   value="<?php if (is_null($product)) {
                       echo(!empty($_SESSION['product_price']) ? $_SESSION['product_price'] : '');
                   } else {
                       echo $product->getPrice();
                   } ?>">
        </div>
        <div class="col-auto">
            <label for="pquantity" class="form-label">Quantity:</label>
            <input type="text" id="pquantity" name="product_quantity" class="form-control"
                   value="<?php if (is_null($product)) {
                       echo(!empty($_SESSION['product_quantity']) ? $_SESSION['product_quantity'] : '');
                   } else {
                       echo $product->getQuantity();
                   } ?>">
        </div>
        <div class="col-auto">
            <label for="pquantity" class="form-label">Description:</label>
            <input type="text" id="pquantity" name="product_description" class="form-control"
                   value="<?php if (is_null($product)) {
                       echo(!empty($_SESSION['product_description']) ? $_SESSION['product_description'] : '');
                   } else {
                       echo $product->getDescription();
                   } ?>">
        </div>
    </div>
    <?php if (!isset($_REQUEST['id'])): ?>
        <button id="product_create" type="submit" name="create_submit" class="btn btn-success">Create</button>
    <?php else: ?>
        <button id="product_update" data-id="<?php if (isset($_REQUEST['id'])) {
            echo $_REQUEST['id'];
        } ?>" type="submit" name="update_submit" class="btn btn-success">Update
        </button>
    <?php endif; ?>
</form>
<?php if (isset($_SESSION['error_msg'])) {
    echo $_SESSION['error_msg'];
} else {
    session_destroy();
} ?>
<script src="../js/formActionListener.js"></script>
</body>
</html>