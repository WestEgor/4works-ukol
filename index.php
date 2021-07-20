<?php
require __DIR__ . '/vendor/autoload.php';

use Configure\Connection;
use Configure\DotEnv;
use Entity\CategoryMapper;
use Model\Category;

(new DotEnv(__DIR__ . '/.env'))->load();

$categoryMapp = new CategoryMapper();
var_dump($categoryMapp->findByKey(1));
var_dump($categoryMapp->findByKey(2));
var_dump($categoryMapp->findByKey(3));