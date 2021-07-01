<?php

require_once 'includes/authentication.php';
if (!isset($_SESSION)) { 
    session_start(); 
} 

if (!isset($_SESSION['is_guest'])) {  	
    header('location: index.php');
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <h1 class="text-center mt-5 mb-5 brown-text">Welcome to Nostalji Plak</h1>
                <div class="header">
                    <h2>Login</h2>
                </div>
                    
                <form method="post" action="login.php" class="authorization-form">
                    <?php include('includes/errors.php'); ?>
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="email">
                    </div>
                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password">
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn btn-success rounded" name="login_user">Login</button>
                        <a href="index.php" class="btn btn-warning ms-3 rounded">Back to Shopping</a>
                    </div>
                    <p>
                        Not a member yet? <a href="registration.php" class="text-success">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <?php require_once 'includes/footer.php'; ?>
    <?php require_once 'includes/scripts.php'; ?>
</body>
</html>