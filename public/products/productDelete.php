<?php

/**
 * Script to delete product from table
 */

require __DIR__ . '/../../vendor/autoload.php';

use Configure\DotEnv;
use Entity\ProductsMapper;

(new DotEnv(__DIR__ . '/../../.env'))->load();

$productMapper = new ProductsMapper();
$product = $productMapper->findByKey((int)$_REQUEST['id']);
if (!is_null($product)) {
    $product = $productMapper->delete($product);
}
header('Location: ../index.php');
