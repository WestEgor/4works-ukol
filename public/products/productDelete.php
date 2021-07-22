<?php
require __DIR__ . '/../../vendor/autoload.php';

use Configure\DotEnv;
use Entity\ProductsMapper;

(new DotEnv(__DIR__ . '/../../.env'))->load();

$productMapper = new ProductsMapper();
$product = $productMapper->findByKey((int)$_REQUEST['id']);
$product = $productMapper->delete($product);
header('Location: ../index.php');
