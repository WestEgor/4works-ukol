<?php

/**
 * Script to show product by specified id
 */

use Entity\ProductsMapper;

$productMapper = new ProductsMapper();
$product = $productMapper->findByKey($_GET['product_id']);
