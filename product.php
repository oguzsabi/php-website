<?php
    if (!isset($_SESSION)) { 
        session_start(); 
    }

    require_once ('includes/database.php');
    require_once ('includes/product_card.php');

    $database = new DatabaseController();

    if (isset($_POST['rating']) && isset($_POST['product_id'])) {
        $database->userRate($_SESSION['user_id'], $_POST['product_id'], $_POST['rating']);
    }

    if (isset($_GET['product'])) {
        $product = $database->getProductById($_GET['product']);

        if (!$product) {
            header('location: index.php');
        }

        $starConfig = '';
    
        for ($i = 0; $i < 5; $i++) {
            if ($i < $product['product_stars']) {
                $starConfig .= "<i class=\"fas fa-star fa-2x\"></i>";
            } else {
                $starConfig .= "<i class=\"far fa-star fa-2x\"></i>";
            }
        }
    }

    if (isset($_POST['add']) && isset($_POST['product_id'])) {
        $database->addToCart($_POST['product_id'], $_SESSION['user_id'], 1, $_POST['product_price']);
    }

    $canRate = false;
    $notRatedBefore = false;

    if (!isset($_SESSION['is_guest'])) {
        $notRatedBefore = $database->userHasNotRatedBefore($_SESSION['user_id'], $product['id']);
        $canRate = $database->userHasOrderedBefore($_SESSION['user_id'], $product['id']) && $notRatedBefore;
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nostalji Plak</title>
    <?php require_once 'includes/styles.php' ?>
</head>
<body>

<?php require_once 'includes/header.php'; ?>

<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 mt-5">
            <div class="row bg-white border rounded">
                <div class="col-sm-5 m-4">
                    <img src="<?php echo $product['product_image']; ?>" alt="Image1" class="img-fluid" style="height: 400px;">
                </div>
                <div class="col-sm-5">
                    <h3 class="pt-2"><?php echo $product['product_title']; ?> (<?php echo $product['product_brand']; ?>)</h3>
                    <?php echo $starConfig ?>
                    <?php if (!isset($_SESSION['is_guest']) && !$notRatedBefore): ?>
                        <small>(You've already voted)</small>
                    <?php endif ?>
                    <h4 class="pt-2"><?php echo $product['product_price']; ?> TL</h4>
                    <?php if ($canRate): ?>
                        <form action="product.php?product=<?php echo $product['id']; ?>" method="post">
                            <div class="row">
                                <div class="col-sm-12 mt-2 mb-3" style="display: flex; align-items: center;">
                                    <h5 class="me-3 pt-1">Rate:</h5>
                                    <input type="submit" class="btn btn-outline-success" name="rating" value="1">
                                    <input type="submit" class="btn btn-outline-success ms-2" name="rating" value="2">
                                    <input type="submit" class="btn btn-outline-success ms-2" name="rating" value="3">
                                    <input type="submit" class="btn btn-outline-success ms-2" name="rating" value="4">
                                    <input type="submit" class="btn btn-outline-success ms-2" name="rating" value="5">
                                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                </div>
                            </div>
                        </form>
                    <?php endif ?>
                    <p class="pt-1"><?php $productDescription = nl2br($product['product_description']); echo $productDescription; ?></p>
                    <p class="pt-2"><?php echo $product['product_keywords']; ?></p>
                    <form action="product.php?product=<?php echo $product['id']; ?>" method="post" class="cart-items">                   
                        <button type="submit" class="btn btn-warning mt-2 mb-3" name="add"><i class="fas fa-shopping-cart me-2"></i>Add to Cart</button>
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php' ?>
<?php require_once 'includes/scripts.php'; ?>
</body>
</html>
