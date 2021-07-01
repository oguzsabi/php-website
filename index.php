<?php 
    require_once 'includes/session_logic.php';

    if (isset($_GET['action']) && $_GET['action'] == 'logout' && !isset($_SESSION['is_guest'])) {
        session_destroy();
        header('location: index.php');
    }

    require_once ('includes/database.php');
    require_once ('includes/product_card.php');

    $database = new DatabaseController();

    if (isset($_POST['add']) && isset($_POST['product_id'])) {
        $database->addToCart($_POST['product_id'], $_SESSION['user_id'], 1, $_POST['product_price']);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Nostalji Plak</title>
    <?php require_once 'includes/styles.php' ?>
</head>
<body>
    <?php require_once 'includes/header.php'; ?>

    <div class="container">
        <div class="row py-5">
            <div class="col-sm-1"></div>
            <div class="col-sm-2 filters-column br-20 me-3">
                <div class="row">
                    <h3 class="pt-2 pb-3 br-17"><a href="index.php">Categories</a></h3>
                </div>
                <hr>
                <a href="index.php">All</a>
                <hr>
                <?php
                    $categories = $database->getCategories();
                    
                    while ($category = mysqli_fetch_assoc($categories)) {
                        $categoryLinkName = urlencode(strtolower($category['category_title']));

                        echo "<a href=\"index.php?category=$categoryLinkName\">{$category['category_title']}</a>";
                        echo "<hr>";
                    }
                ?>

                <div class="row">
                    <h3 class="mb-2 mt-4 pt-2 pb-3 br-17"><a href="index.php">Brands</a></h3>
                </div>
                <hr>
                <a href="index.php">All</a>
                <hr>
                <?php
                    $brands = $database->getBrands();

                    while ($brand = mysqli_fetch_assoc($brands)) {
                        $brandLinkName = urlencode(strtolower($brand['brand_name']));

                        echo "<a href=\"index.php?brand=$brandLinkName\">{$brand['brand_name']}</a>";
                        echo "<hr>";
                    }
                ?>
            </div>
            <div class="col-sm-8 text-center products-column br-20 py-3">
                <div class="row center-content">
                    <?php
                        $products = '';

                        if (isset($_GET['brand'])) {
                            $products = $database->getProductsByBrand($_GET['brand']);
                        } elseif (isset($_GET['category'])) {
                            $products = $database->getProductsByCategory($_GET['category']);
                        } else {
                            $products = $database->getProducts(); 
                        }
                        
                        if (!empty($products)) {
                            while ($product = mysqli_fetch_assoc($products)) {
                                product_card($product['product_title'], $product['product_price'], $product['product_image'], $product['id'], $product['product_stars'], $product['product_brand']);
                            }
                        } else {
                            echo "<h3 class=\"mt-5 brown-text\">No products here :(</h3>";
                        }
                    ?>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>

    <?php require_once 'includes/footer.php'; ?>
    <?php require_once 'includes/scripts.php'; ?>
</body>
</html>