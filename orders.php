<?php
    require_once 'includes/session_logic.php';

    if (isset($_SESSION['is_guest']) && $_SESSION['is_guest']) {
        header('location: index.php');
    }

    require_once ('includes/database.php');
    require_once ('includes/product_card.php');

    $database = new DatabaseController();
    $orders = $database->getCustomerOrders($_SESSION['user_id']);
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
    <div class="row mt-4">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 text-center">
            <div id="orders" style="display: none;">
                <?php 
                    if ($orders) {
                        foreach ($orders as $transactionId => $order) {
                            echo "<div class=\"border rounded mb-5 mt-3 order-group\">";
                            echo "<h3 class=\"pb-3 pt-2\">Your order with transaction ID <u>$transactionId</u></h3>";

                            foreach ($order as $product) {
                                orderElement($product['product_image'], $product['product_title'], $product['product_price'], $product['product_id'], $product['product_quantity']);
                            }
                            
                            echo "<form action=\"cart.php\" method=\"post\" class=\"mt-2 mb-3\">";
                            echo "<input type=\"submit\" name=\"repeat_order\" value=\"Repeat Order\" class=\"btn btn-success btn-lg\">";
                            echo "<input type=\"hidden\" name=\"repeat_transaction_id\" value=\"$transactionId\">";
                            echo "</form>";
                            echo "</div>";
                        }
                    } else {
                        echo "<h2 class=\"mt-5 brown-text\">No previous orders :(</h2>";
                    } 
                ?>
            </div>
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
<?php require_once 'includes/scripts.php'; ?>
<script>
    const loaderDuration = 500;
    const loaderFadeOutDuration = 200;
    const paymentSuccessDelay = 50;

    setTimeout(function() {
        $('.lds-ellipsis').fadeOut(loaderFadeOutDuration);
    }, loaderDuration);

    setTimeout(function() {
        $('#orders').show();
    }, loaderDuration + loaderFadeOutDuration + paymentSuccessDelay);
</script>
</body>
</html>
