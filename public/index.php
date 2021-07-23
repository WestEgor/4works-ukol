<?php
/**
 * Page to show all products and do action with data
 */

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
?>

<html lang="cs">
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

<?php if (isset($_REQUEST['id'])) : ?>
    <?php $productId = $_REQUEST['id']; ?>
    <?php if (Validator::validateInt($productId)) : ?>
        <?php if ($product = $productsMapper->findByKey($productId)) : ?>
            <div class="card">
            <div class="row">
            <?php if ($product instanceof Product) : ?>
                <div class="col-md-2">
                    <img src="./download/images/<?php echo $product->getImage() ?>"
                         class="img-fluid" alt="prod-img" style="height: 225px; width: 225px"/>
                </div>
                <div class="col-md-4">
                    <p class="h4"><?php echo $product->getProductName() ?></p>
                    <p class="h5">
                        Kategorie: <?php echo $productsMapper->getCategoryByProductName($product) ?></p>
                    <p class="h6">Cena: <?php echo $product->getPrice() ?></p>
                    <p class="h6">Skladem: <?php echo $product->getQuantity() ?></p>
                    <p class="h6">Popis: <?php echo $product->getDescription() ?></p>
                    <a id="submit_update" class="btn btn-primary"
                       href="./products/productForm.php?id=<?php echo $product->getId(); ?>">Edit</a>
                    <a id="submit_delete" class="btn btn-danger" data-id="<?php echo $product->getId(); ?>"
                       href="">Smazat</a>
                </div>
                </div>
                </div>
            <?php endif; ?>
        <? else: $_SESSION['error'] = 'Nelze najít produkt s aktuálním ID' ?>
        <?php endif ?>
    <? else: $_SESSION['error'] = 'ID nemůže být řetězcem' ?>
    <?php endif ?>
<?php else: ?>
    <?php if (!is_null($products)): ?>
        <div class="card">
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <?php if ($product instanceof Product) : ?>
                        <div class="col-md-2">
                            <img src="./download/images/<?php echo $product->getImage() ?>" class="img-fluid"
                                 style="height: 225px; width: 225px" alt="product-image"/>
                        </div>
                        <div class="col-md-4">
                            <p class="h3"><?php echo $product->getProductName() ?></p>
                            <p class="h4">
                                Kategorie: <?php echo $productsMapper->getCategoryByProductName($product) ?></p>
                            <p class="h6">Cena: <?php echo $product->getPrice() ?></p>
                            <a id="product_detail" class="btn btn-primary"
                               href="<?php $_SERVER['PHP_SELF'] ?>?id=<?php echo $product->getId(); ?>">Detail</a>
                            <a id="submit_update" class="btn btn-warning"
                               href="./products/productForm.php?id=<?php echo $product->getId(); ?>">Edit</a>
                            <a id="submit_delete" class="btn btn-danger" data-id="<?php echo $product->getId(); ?>"
                               href="">Smazat</a>
                        </div>
                    <?php endif ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error']; ?>
    </div>
<?php else: ?>
    <?php session_destroy(); ?>
<?php endif; ?>


<?php if (isset($_REQUEST['id']) || isset($_SESSION['error'])) : ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button class="btn btn-primary" type="submit" name="show_all">Zobrazit všechna zboží</button>
    </form>
<?php endif; ?>
<?php unset($_SESSION['error']); ?>
<script src="js/deleteProduct.js"></script>
</body>
</html>
