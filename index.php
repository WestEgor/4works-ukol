<?php
require __DIR__ . '/vendor/autoload.php';

use Configure\DotEnv;
use Entity\CategoryMapper;

(new DotEnv(__DIR__ . '/.env'))->load();

$categoryMapp = new CategoryMapper();
/*var_dump($categoryMapp->findByKey(1));
var_dump($categoryMapp->findByKey(2));
var_dump($categoryMapp->findByKey(3));*/
/*var_dump($categoryMapp->findAll());*/
/*$category = new Category(name:'name');

var_dump($categoryMapp->save($category));
var_dump($categoryMapp->findByKey(4));*/
/*$category = $categoryMapp->findByKey(4);
$category->setName('NewNameNewName');
$categoryMapp->update($category);
var_dump($categoryMapp->findByKey(4));*/
/*
var_dump($categoryMapp->delete($categoryMapp->findByKey(3)));
var_dump($categoryMapp->findByKey(3));*/

