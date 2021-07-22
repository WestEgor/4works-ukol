<?php
session_start();
require __DIR__ . '/../../vendor/autoload.php';

use Entity\CategoriesMapper;
use Model\Product;
use Configure\DotEnv;
use Entity\ProductsMapper;
use Service\Validator;

(new DotEnv(__DIR__ . '/../../.env'))->load();
$errorMessage = '';

if (isset($_POST['create_submit']) || isset($_POST['update_submit'])) {
    $_SESSION['product_name'] = $_POST['product_name'];
    $name = $_SESSION['product_name'];
    if (!Validator::validateString($name)) {
        $errorMessage .= 'Product name cannot be empty' . '</br>';
        unset($_SESSION['product_name']);
        unset($_POST['product_name']);
    }
    $_SESSION['product_category'] = $_POST['product_category'];
    $category = (int)$_SESSION['product_category'];

    $_SESSION['product_price'] = $_POST['product_price'];
    $price = $_SESSION['product_price'];
    if (!Validator::validateFloat($price)) {
        $errorMessage .= 'Price cannot be empty/string' . '</br>';
        unset($_SESSION['product_price']);
        unset($_POST['product_price']);
    }
    $_SESSION['product_quantity'] = $_POST['product_quantity'];
    $quantity = $_SESSION['product_quantity'];
    if (!Validator::validateInt($quantity)) {
        $errorMessage .= 'Quantity cannot be empty/string/float' . '</br>';
        unset($_SESSION['product_quantity']);
        unset($_POST['product_quantity']);
    }
    $_SESSION['product_description'] = $_POST['product_description'];
    $description = $_SESSION['product_description'];
    if (!Validator::validateString($description)) {
        $errorMessage .= 'Description cannot be empty' . '</br>';
        unset($_SESSION['product_description']);
        unset($_POST['product_description']);
    }

    $_SESSION['error_msg'] = $errorMessage;

    if ($_SESSION['error_msg'] !== '') {
        header('Location: productForm.php');
    } else {
        $productMapper = new ProductsMapper();
        $categoryMapper = new CategoriesMapper();
        $category = $categoryMapper->findByKey($category);
        $product = new Product(productName: $name, category: $category, price: $price,
            quantity: $quantity, description: $description);
        if (isset($_POST['update_submit'])) {
            $product->setId((int)$_REQUEST['id']);

            var_dump($productMapper->update($product));
        }
        if (isset($_POST['create_submit'])) {
            $productMapper->save($product);
        }
        foreach ($_SESSION as $key) {
            unset($_SESSION[$key]);
        }
        session_destroy();
        header('Location: ../index.php');
    }
}
