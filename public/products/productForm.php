<?php

/**
 * Page, that provides form of updating/creating product
 */

if (!session_id()) {
    session_start();
}
require __DIR__ . '/../../vendor/autoload.php';

use Configure\DotEnv;
use Entity\CategoriesMapper;
use Entity\ProductsMapper;
use Model\Category;
use Model\Product;

(new DotEnv(__DIR__ . '/../../.env'))->load();


$categoryMapper = new CategoriesMapper();
$productMapper = new ProductsMapper();
$categories = $categoryMapper->findAll();
$product = null;
if (isset($_REQUEST['id'])) {
    $id = (int)$_REQUEST['id'];
    $product = $productMapper->findByKey($id);
    if (is_null($product)) {
        exit('Error');
    }
    if (!$product instanceof Product) {
        exit('Error');
    }
}
?>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://bootswatch.com/5/minty/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Products form</title>
</head>
<body>
<?php require __DIR__ . '/../navbar.php'; ?>

<form id="product_form" method="post" enctype="multipart/form-data">
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="pname" class="form-label">Name of product:</label>
            <input type="text" id="pname" name="product_name" class="form-control"
                   value="<?php if (is_null($product)) {
                       echo(!empty($_SESSION['product_name']) ? $_SESSION['product_name'] : '');
                   } else {
                       echo $product->getProductName();
                   } ?> ">
        </div>
        <div class="col-auto">
            <label>Categories:
                <select name="product_category" class="form-select" aria-label="Default select example">
                    <?php if (!is_null($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->getId() ?>">
                                <?php echo $category->getCategoryName(); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
            <label>Description
                <textarea class="form-control" name="product_description" id="description" cols="50" rows="3">
                    <?php if (is_null($product)) {
                        echo(!empty($_SESSION['product_description']) ? $_SESSION['product_description'] : '');
                    } else {
                        echo $product->getDescription();
                    } ?>
                    </textarea></label>
        </div>
        <div class="col-auto">
            <label>Product image:</label>
            <input type="file"
                   name="product_image"
                   value=""/>
        </div>
    </div>
    <?php if (!isset($_REQUEST['id'])) : ?>
        <button id="product_create" type="submit" name="create_submit" class="btn btn-success">Create</button>
    <?php else: ?>
        <button id="product_update" data-id="<?php if (isset($_REQUEST['id'])) {
            echo $_REQUEST['id'];
        } ?> " type="submit" name="update_submit" class="btn btn-success">Update
        </button>
    <?php endif; ?>
</form>
<?php if (isset($_SESSION['error_msg'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error_msg']; ?>
    </div>
<?php else:
    session_destroy();
endif; ?>
<script src="../js/formActionListener.js"></script>
</body>
</html>
