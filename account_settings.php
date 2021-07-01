<?php 
    require_once 'includes/session_logic.php';
    require_once 'includes/authentication.php';

    if (isset($_SESSION['is_guest']) && $_SESSION['is_guest']) {
        header('location: index.php');
    }

    $user = $database->getUser($_SESSION['user_id']);

    if ($user) {
        $firstName = $user['first_name'];
        $lastName = $user['last_name'];
        $email_1 = strtolower($user['email']);
        $email_2 = strtolower($user['email']);
        $phoneNumber = $user['mobile'];
        $address = $user['address'];
    }
?>

<?php

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
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="header py-2">
                <h2>Account Information</h2>
            </div>
            
            <form method="post" action="account_settings.php" class="authorization-form">
                <?php include('includes/errors.php'); ?>
                <div class="input-group mt-0">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="<?php echo $firstName; ?>" placeholder="Ash">
                </div>
                <div class="input-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="<?php echo $lastName; ?>" placeholder="Zang">
                </div>
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email_1" value="<?php echo $email_1; ?>" placeholder="example@example.com">
                </div>
                <div class="input-group">
                    <label>Confirm Email</label>
                    <input type="email" name="email_2" value="<?php echo $email_2; ?>" placeholder="example@example.com">
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password_1">
                </div>
                <div class="input-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_2">
                </div>
                <div class="input-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone_number" placeholder="+905058029932" value="<?php echo $phoneNumber; ?>">
                </div>
                <div class="input-group">
                    <label>Address</label>
                    <input type="text" name="address" placeholder="Your address here" value="<?php echo $address; ?>">
                </div>
                <div class="input-group mb-0">
                    <button type="submit" class="btn btn-success" name="account_settings">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
<?php require_once 'includes/scripts.php'; ?>
</body>
</html>
