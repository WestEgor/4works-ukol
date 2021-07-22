<?php

use Entity\ProductsMapper;

$productMapper = new ProductsMapper();
$product = $productMapper->findByKey($_GET['product_id']);