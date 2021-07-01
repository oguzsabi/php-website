<?php
    if (!isset($_SESSION)) { 
        session_start(); 
    }

    require_once ('includes/product_card.php');
    require_once ('includes/database.php');

    $database = new DatabaseController();

    if (isset($_POST['remove']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
        $database->removeCartItem($_SESSION['user_id'], $_GET['id']);
        echo "<script>window.location = 'cart.php'</script>";
    } else if (isset($_POST['remove_all'])) {
        $database->removeAllCartItems($_SESSION['user_id']);
    } else if (isset($_GET['action']) && isset($_GET['id'])) {
        if ($_GET['action'] == 'plus') {
            $database->incrementCartItem($_SESSION['user_id'], $_GET['id']);
        } else if ($_GET['action'] == 'minus') {
            $database->decrementCartItem($_SESSION['user_id'], $_GET['id']);
        }
    } else if (isset($_POST['checkout'])) {
        if (isset($_SESSION['is_guest']) && $_SESSION['is_guest'] && $database->getCartItemsQuantity($_SESSION['user_id']) > 0) {
            header('location: registration.php');
        } else {
            $successful = $database->checkoutCartItems($_SESSION['user_id']);

            if ($successful) {
                header('location: payment_success.php');
            }
        }
    } else if (isset($_POST['repeat_order']) && isset($_POST['repeat_transaction_id'])) {
        $database->repeatCustomerOrder($_SESSION['user_id'], $_POST['repeat_transaction_id']);
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

<?php require_once ('includes/header.php'); ?>

<div class="container-fluid">
    <div class="row px-5 my-4">
        <div class="col-md-7">
            <div class="shopping-cart">
                <div class="row">
                    <div class="col-sm-12 my-cart">
                        <h6>My Cart</h6>
                        <form method="post" action="">
                            <input type="submit" name="remove_all" class="btn btn-danger mx-3 mb-1" value="Remove All">
                        </form>
                    </div>
                </div>
                <hr>
                <?php
                    $totalPrice = 0;
                    $cartItems = $database->getCartItems($_SESSION['user_id']);

                    if (!empty($cartItems)) {
                        while ($cartItem = mysqli_fetch_assoc($cartItems)) {
                            $totalPrice += $cartItem['total_price'];
                            cartElement($cartItem['product_image'], $cartItem['product_title'], $cartItem['product_price'], $cartItem['product_id'], $cartItem['quantity']);
                        }
                    } else {
                        echo "<h5>Cart is Empty</h5>";
                    }
                ?>
            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php $itemQuantity = $database->getCartItemsQuantity($_SESSION['user_id']); ?>
                        <h6>Price (<?php echo $itemQuantity; ?> items)</h6>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <h6><?php echo $totalPrice; ?> TL</h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6><?php echo $totalPrice; ?> TL</h6>
                    </div>
                </div>
                <form class="row px-2 my-2" method="post" action="cart.php">
                    <input type="submit" name="checkout" class="btn btn-success btn-block" value="Checkout">
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php' ?>
<?php require_once 'includes/scripts.php' ?>
</body>
</html>
