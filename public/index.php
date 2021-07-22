<?php
if (!session_id()) {
    session_start();
}

use Configure\DotEnv;
use Entity\CategoriesMapper;
use Entity\ProductsMapper;
use Model\Product;
use Service\Validator;

require __DIR__ . '/../vendor/autoload.php';
(new DotEnv(__DIR__ . '/../.env'))->load();

$productsMapper = new ProductsMapper();
$categoriesMapper = new CategoriesMapper();
$products = $productsMapper->findAll();
$columns = $productsMapper->getProductColumnNames();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://bootswatch.com/5/minty/bootstrap.min.css" crossorigin="anonymous">
    <title>Products</title>
</head>
<body>
<?php require_once __DIR__ . '/navbar.php'; ?>

<?php if (isset($_POST['show_all'])) {
    unset($_GET['submit']);
    unset($_GET['product_id']);
} ?>


<table class="table">
    <thead class="thead-light">
    <tr>
        <?php foreach ($columns as $column): ?>
            <?php if ($column === 'category_id'): ?>
                <th scope="col"><a href="./categories/showCategories.php"><?php echo $column; ?></a></th>
                <?php continue; endif; ?>
            <th scope="col"><?php echo $column; ?> </th>
        <?php endforeach; ?>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($_GET['submit'])): ?>
        <?php $productId = $_GET['product_id']; ?>
        <?php if (Validator::validateInt($productId)): ?>
            <?php if ($product = $productsMapper->findByKey($productId)): ?>
                <?php if ($product instanceof Product): ?>
                    <tr>
                        <th scope="row"><?php echo $product->getId() ?></th>
                        <td><?php echo $product->getProductName() ?></td>
                        <td><?php echo $productsMapper->getCategoryByProductName($product) ?></td>
                        <td><?php echo $product->getPrice() ?></td>
                        <td><?php echo $product->getQuantity() ?></td>
                        <td><?php echo $product->getDescription() ?></td>
                        <td><a id="submit_update" class="btn btn-primary"
                               href="./products/productForm.php?id=<?php echo $product->getId(); ?>">Update</a></td>
                        <td><a id="submit_delete" class="btn btn-danger" data-id="<?php echo $product->getId(); ?>"
                               href="">Delete</a></td>
                    </tr>
                <?php endif; ?>
            <? else: $_SESSION['error'] = 'Cannot find product with current ID' ?>
            <?php endif ?>
        <? else: $_SESSION['error'] = 'ID cannot be a string' ?>
        <?php endif ?>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <?php if ($product instanceof Product): ?>
                <tr>
                    <th scope="row"><?php echo $product->getId() ?></th>
                    <td><?php echo $product->getProductName() ?></td>
                    <td><?php echo $productsMapper->getCategoryByProductName($product) ?></td>
                    <td><?php echo $product->getPrice() ?></td>
                    <td><?php echo $product->getQuantity() ?></td>
                    <td><?php echo $product->getDescription() ?></td>
                    <td><a id="submit_update" class="btn btn-primary"
                           href="./products/productForm.php?id=<?php echo $product->getId(); ?>">Update</a></td>
                    <td><a id="submit_delete" class="btn btn-danger" data-id="<?php echo $product->getId(); ?>"
                           href="">Delete</a></td>
                </tr>
            <?php endif ?>
        <?php endforeach; ?>
    <?php endif ?>
    </tbody>
</table>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error']; ?>
    </div>
<?php else: ?>
    <?php session_destroy(); ?>
<?php endif; ?>

<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>
        Search by ID:
        <input type="text" name="product_id"/>
        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
    </label>
</form>

<?php if (isset($_POST['submit']) || isset($_SESSION['error'])): ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button class="btn btn-primary" type="submit" name="show_all">Show all</button>
    </form>
<?php endif; ?>
<?php unset($_SESSION['error']); ?>

<a class="btn btn-primary" id="add_product" href="./products/productForm.php">Add new product</a>
<script src="js/deleteProduct.js"></script>
</body>
</html>
