<?php 

if (!isset($_SESSION)) { 
    session_start(); 
}

if (!isset($_SESSION['user_id'])) {
    if (!isset($_COOKIE['user_id'])) {
        $guestUniqId = uniqid();
        $_SESSION['user_id'] = $guestUniqId;

        setcookie(
            "user_id",
            $guestUniqId,
            time() + (10 * 365 * 24 * 60 * 60),
            '/'
        );
    } else {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    }

    $_SESSION['first_name'] = 'Hello, ';
    $_SESSION['last_name'] = 'Guest';
    $_SESSION['is_guest'] = true;
}

?>