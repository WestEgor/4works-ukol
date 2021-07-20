<?php
require __DIR__ . '/vendor/autoload.php';

use Configure\DotEnv;
use Configure\Connection;
use Model\Category;

(new DotEnv(__DIR__ . '/.env'))->load();

/*$pdo = Connection::getInstance()->getConnection();*/

$category = Category::create();
$category->setName('Anime');
var_dump($category);