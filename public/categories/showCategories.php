<?php

/**
 * Page to show all categories
 */

use Configure\DotEnv;
use Entity\CategoriesMapper;
use Model\Category;

require __DIR__ . '/../../vendor/autoload.php';
(new DotEnv(__DIR__ . '/../../.env'))->load();

$categoriesMapper = new CategoriesMapper();
$categories = $categoriesMapper->findAll();
$columns = $categoriesMapper->getColumnNames();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://bootswatch.com/5/minty/bootstrap.min.css"
          crossorigin="anonymous">
    <title>Products</title>
</head>
<body>
<?php require_once __DIR__ . '/../navbar.php'; ?>
<table class="table">
    <thead class="thead-light">
    <tr>
        <?php if (!is_null($columns)): ?>
            <?php foreach ($columns as $column): ?>
                <th scope="col"><?php echo $column; ?></th>
            <?php endforeach; ?>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
    <?php if (!is_null($categories)): ?>
        <?php foreach ($categories as $category): ?>
            <?php if ($category instanceof Category) : ?>
                <tr>
                    <th scope="row"><?php echo $category->getId() ?></th>
                    <td><?php echo $category->getCategoryName() ?></td>
                </tr>
            <?php endif ?>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
</body>
</html>
