<?php
require __DIR__ . '/vendor/autoload.php';

use Configure\DotEnv;
use Entity\CategoriesMapper;
use Entity\ProductsMapper;
use Model\Category;
use Model\Product;

(new DotEnv(__DIR__ . '/.env'))->load();

/*$categoryMapp = new CategoriesMapper();
var_dump($categoryMapp->findByKey(1));
var_dump($categoryMapp->findByKey(2));
var_dump($categoryMapp->findByKey(3));*/
/*var_dump($categoryMapp->findAll());*/
/*
var_dump($categoryMapp->findByKey(4));*/
/*$category = $categoryMapp->findByKey(4);
$category->setName('NewNameNewName');
$categoryMapp->update($category);
var_dump($categoryMapp->findByKey(4));*/
/*
var_dump($categoryMapp->delete($categoryMapp->findByKey(3)));
var_dump($categoryMapp->findByKey(3));*/

$prodMap = new ProductsMapper();
$product1 = new Product(productName:'Product1', categoryId: 1, price: 2500, quantity: 24, description: 'Blablablabla');
var_dump($prodMap->save($product1)) . '<br>';
/*var_dump($prodMap->findByKey(2)) . '<br>';*/
/*$prod = $prodMap->findByKey(1);
$prod->setProductName('New name');
$prod->setQuantity(23);
$prodMap->update($prod);*/
/*$prod = $prodMap->findByKey(1);
$prodMap->delete($prod);*/

/*$categoryMapp = new CategoriesMapper();
$category = new Category(name:'WTF');
var_dump($categoryMapp->save($category));*/