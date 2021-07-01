<?php 
require_once ('includes/database.php');

$database = new DatabaseController();
?>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark">
    <a href="index.php" class="navbar-brand">
        <h3 class="px-3">
            <i class="fas fa-record-vinyl" title="Vinyl Record"></i>
            Nostalji Plak
        </h3>
    </a>

    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a href="cart.php" class="nav-item nav-link active">
                <h5 class="px-3 cart">
                    <i class="fas fa-shopping-cart"></i>
                    Cart
                    <?php $itemQuantity = $database->getCartItemsQuantity($_SESSION['user_id']); ?>
                    <span id="cart_count" class="text-warning"><?php echo $itemQuantity; ?></span>
                </h5>

            </a>
        </li>
        <li class="nav-item">
            <div class="dropdown me-3" style="margin-top: 1px;">
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                    <?php 
                        $firstName = ucfirst($_SESSION['first_name']);
                        $lastName = ucfirst($_SESSION['last_name']);

                        echo "$firstName $lastName"; 
                    ?>
                </button>
                <ul class="dropdown-menu-right dropdown-menu " aria-labelledby="dropdownMenuButton1" style="right: 0; left: auto;">
                    <?php if (isset($_SESSION['is_guest']) && $_SESSION['is_guest']): ?>
                        <li><a class="dropdown-item" href="login.php">Login</a></li>
                    <?php else: ?>
                        <li><a class="dropdown-item" href="orders.php">Orders</a></li>
                        <li><a class="dropdown-item" href="account_settings.php">Account Settings</a></li>
                        <li><a class="dropdown-item" href="index.php?action=logout">Logout</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </li>
    </ul>
</nav>