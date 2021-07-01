<?php
    require_once 'includes/session_logic.php';
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
    <div class="row mt-5 text-center">
       <div class="col-sm-12 mt-5">
           <h2 class="mt-5 brown-text">OOPS! Something went wrong.</h2>
           <h3 class="brown-text">Please continue your shopping while we are dealing with this issue.</h3>
           <a href="index.php" role="button" class="btn btn-success btn-lg mt-4">Continue Shopping</a>
       </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
<?php require_once 'includes/scripts.php'; ?>
</body>
</html>
