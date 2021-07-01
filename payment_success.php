<?php
    require_once 'includes/session_logic.php';
    
    if ((isset($_SESSION['is_guest']) && $_SESSION['is_guest']) || !isset($_SESSION['transaction_id'])) {
        header('Location: index.php');
    }

    if (isset($_SESSION['transaction_id'])) {
        $transactionId = $_SESSION['transaction_id'];
        unset($_SESSION['transaction_id']);
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
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 text-center">
            <div class="payment-success bg-light">
                <h2 class="pt-2">Payment Successful!</h2>
                <hr>
                <h3>Thank you for your purchase!</h3>
                <p>Your payment has been successfully finished.</p>
                <p>Your transaction ID is <?php echo $transactionId; ?></p>
                <a href="index.php" role="button" class="btn btn-success btn-lg mb-2">Continue Shopping</a>
            </div>
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>

<?php require_once 'includes/footer.php' ?>
<?php require_once 'includes/scripts.php'; ?>
<script>
    const loaderDuration = 2000;
    const loaderFadeOutDuration = 200;
    const paymentSuccessDelay = 50;

    setTimeout(function() {
        $('.lds-ellipsis').fadeOut(loaderFadeOutDuration);
    }, loaderDuration);

    setTimeout(function() {
        $('.payment-success').show();
    }, loaderDuration + loaderFadeOutDuration + paymentSuccessDelay);
</script>
</body>
</html>
