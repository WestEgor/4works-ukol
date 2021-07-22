<?php

/**
 * Navigation bar
 */

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/public/index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/public/index.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/public/categories/showCategories.php">Categories</a>
            </li>
        </ul>

    </div>
    <form method="get" action="index.php">
        <label>
            Search by ID:
            <input type="text" name="product_id"/>
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
        </label>
    </form>
</nav>
<?php require __DIR__ . '/bootstrap.html'; ?>
