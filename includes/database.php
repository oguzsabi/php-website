<?php
class DatabaseController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "osstore";
	private $connection;
	
	function __construct() {
		$this->connection = $this->connectDB();
	}
	
	function connectDB() {
		$connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);

		return $connection;
	}

    // Filter option functions START

    function getCategories() {
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    function getBrands() {
        $sql = "SELECT * FROM brands";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    // Filter option functions END

    // Product functions START

    function getProducts() {
        $sql = "SELECT * FROM products";
        $result = mysqli_query($this->connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    function getProductById($productId) {
        $sql = "SELECT * FROM products WHERE id=$productId";
        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            return mysqli_fetch_assoc($result);
        }

        return false;
    }

    function getProductsByCategory($category) {
        $category = urldecode($category);
        $sql = "SELECT * FROM products WHERE product_category='$category'";
        $result = mysqli_query($this->connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    function getProductsByBrand($brand) {
        $brand = urldecode($brand);
        $sql = "SELECT * FROM products WHERE product_brand='$brand'";
        $result = mysqli_query($this->connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    // Product functions END

    // Cart functions START

    function checkoutCartItems($userId) {
        $transactionId = uniqid('tr');
        $cartItems = $this->getCartItems($userId);

        if ($cartItems) {
            while ($cartItem = mysqli_fetch_assoc($cartItems)) {
                $sql = "INSERT INTO customer_orders (user_id, product_id, product_title, product_price, product_quantity, transaction_id, order_status)
                        VALUES($userId, {$cartItem['product_id']}, '{$cartItem['product_title']}', {$cartItem['product_price']}, {$cartItem['quantity']}, '$transactionId', 'COMPLETED')";
    
                mysqli_query($this->connection, $sql);
            }

            $this->removeAllCartItems($userId);
            $_SESSION['transaction_id'] = $transactionId;

            return true;
        }

        unset($_SESSION['transaction_id']);

        return false;
    }

    function getCartItems($userId) {
        $sql = "SELECT * FROM cart INNER JOIN products ON cart.product_id=products.id WHERE user_id='$userId'";
        $result = mysqli_query($this->connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    function incrementCartItem($userId, $productId) {
        $sql = "UPDATE cart SET quantity = quantity + 1, total_price = total_price + price WHERE user_id='$userId' AND product_id=$productId";

        mysqli_query($this->connection, $sql);
    }

    function decrementCartItem($userId, $productId) {
        $itemQuantity = mysqli_query($this->connection, "SELECT quantity FROM cart WHERE user_id='$userId' AND product_id=$productId");
        $itemQuantity = mysqli_fetch_assoc($itemQuantity);
        
        if ($itemQuantity) {
            $itemQuantity = $itemQuantity['quantity'];
            $sql = '';
    
            if ($itemQuantity - 1 <= 0) {
                $sql = "DELETE FROM cart WHERE user_id='$userId' AND product_id=$productId";
            } else {
                $sql = "UPDATE cart SET quantity = quantity - 1, total_price = total_price - price WHERE user_id='$userId' AND product_id=$productId";
            }
    
            mysqli_query($this->connection, $sql);
        }
    }

    function removeCartItem($userId, $productId) {
        $sql = "DELETE FROM cart WHERE user_id='$userId' AND product_id=$productId";

        mysqli_query($this->connection, $sql);
    }

    function removeAllCartItems($userId) {
        $sql = "DELETE FROM cart WHERE user_id='$userId'";

        mysqli_query($this->connection, $sql);
    }

    function getCartItemsQuantity($userId) {
        $sql = "SELECT SUM(quantity) as totalQuantity FROM cart WHERE user_id='$userId'";

        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_assoc($result); 

        return $row['totalQuantity'] ?? 0;
    }

    function addToCart($productId, $userId, $quantity, $price) {
        $sql = "SELECT * FROM cart WHERE user_id='$userId' AND product_id=$productId";
        $result = mysqli_query($this->connection, $sql);
        $itemNotAdded = true;

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if ($row['product_id'] == $productId) {
                $newQuantity = $quantity + $row['quantity'];
                $newTotalPrice = $price * $newQuantity;

                mysqli_query($this->connection, "UPDATE cart SET price=$price, quantity=$newQuantity, total_price=$newTotalPrice WHERE product_id=$productId");
                $itemNotAdded = false;
            }
        }

        if ($itemNotAdded) {
            $totalPrice = $quantity * $price;
            
            mysqli_query($this->connection, "INSERT INTO cart (product_id, user_id, quantity, price, total_price)
                                                VALUES($productId, '$userId', $quantity, $price, $totalPrice)");
        }
    }

    function transferCartItemsToUser($guestId, $userId) {
        $sql = "UPDATE cart SET user_id='$userId' WHERE user_id='$guestId'";

        mysqli_query($this->connection, $sql);
    }

    // Cart functions END

    // Order functions START

    function getCustomerOrders($userId) {
        $sql = "SELECT * FROM customer_orders INNER JOIN products ON customer_orders.product_id=products.id WHERE user_id=$userId";
        $result = mysqli_query($this->connection, $sql);

        $customerOrders = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($order = mysqli_fetch_assoc($result)) {
                if (in_array($order['transaction_id'], array_keys($customerOrders))) {
                    $customerOrders[$order['transaction_id']][] = [
                        'product_id' => $order['product_id'],
                        'product_title' => $order['product_title'],
                        'product_image' => $order['product_image'],
                        'product_stars' => $order['product_stars'],
                        'product_price' => $order['product_price'],
                        'product_quantity' => $order['product_quantity'],
                        'transaction_id' => $order['transaction_id'],
                        'order_status' => $order['order_status'],
                    ];
                } else {
                    $orderArray = [
                        $order['transaction_id'] => [[
                            'product_id' => $order['product_id'],
                            'product_title' => $order['product_title'],
                            'product_image' => $order['product_image'],
                            'product_stars' => $order['product_stars'],
                            'product_price' => $order['product_price'],
                            'product_quantity' => $order['product_quantity'],
                            'transaction_id' => $order['transaction_id'],
                            'order_status' => $order['order_status'],
                        ]]
                    ];

                    $customerOrders = array_merge($customerOrders, $orderArray);
                }
            }

            return $customerOrders;
            // echo '<pre>';
            // var_dump($customerOrders);
            // echo '</pre>';
        }

        return false;
    }

    function repeatCustomerOrder($userId, $transactionId) {
        $this->removeAllCartItems($userId);

        $sql = "SELECT * FROM customer_orders WHERE user_id=$userId AND transaction_id='$transactionId'";
        $result = mysqli_query($this->connection, $sql);
        // var_dump($result);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($product = mysqli_fetch_assoc($result)) {
                $this->addToCart($product['product_id'], $userId, $product['product_quantity'], $product['product_price']);
            }
        }
    }

    function userHasOrderedBefore($userId, $productId) {
        $sql = "SELECT * FROM customer_orders WHERE user_id=$userId AND product_id=$productId";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            return true;
        }

        return false;
    }

    // Order functions END

    // Vote functions START

    function userHasNotRatedBefore($userId, $productId) {
        $sql = "SELECT * FROM ratings WHERE user_id=$userId AND product_id=$productId";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            return false;
        }

        return true;
    }

    function userRate($userId, $productId, $rating) {
        if ($rating < 1 || $rating > 5) {
            return false;
        }

        if (!$this->userHasOrderedBefore($userId, $productId) || !$this->userHasNotRatedBefore($userId, $productId)) {
            return false;
        }

        $sql = "INSERT INTO ratings (user_id, product_id, rating ) VALUES($userId, $productId, $rating)";
        $result = mysqli_query($this->connection, $sql);

        if ($result) {
            $this->updateProductRate($productId);
        }
    }

    function updateProductRate($productId) {
        $sql = "SELECT AVG(rating) as rateAverage FROM ratings WHERE product_id=$productId";
        $result = mysqli_query($this->connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            $rateAverage = mysqli_fetch_assoc($result)['rateAverage'];
            $roundedRateAverage = round($rateAverage);

            $sql = "UPDATE products SET product_stars=$roundedRateAverage WHERE id=$productId";
            mysqli_query($this->connection, $sql);
        }
    }

    // Vote functions END

    // Authorization functions START

    function escapeString($stringToEscape) {
        return mysqli_real_escape_string($this->connection, $stringToEscape);
    }

    function checkIfUserExists($email) {
        $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($this->connection, $user_check_query);

        if ($result && mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        }
        
        return false;
    }

    function getUser($userId) {
        $user_check_query = "SELECT * FROM users WHERE id=$userId LIMIT 1";
        $result = mysqli_query($this->connection, $user_check_query);

        if ($result && mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        }
        
        return false;
    }

    function registerUser($firstName, $lastName, $email, $password, $mobile, $address) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //encrypt the password before saving in the database
        $query = "INSERT INTO users (first_name, last_name, email, password, mobile, address)
                    VALUES('$firstName', '$lastName', '$email', '$hashedPassword', '$mobile', '$address')";
        mysqli_query($this->connection, $query);
  
        $query = "SELECT id FROM users WHERE email='$email' AND password='$hashedPassword'";
        return mysqli_query($this->connection, $query);
    }

    function updateUser($firstName, $lastName, $email, $password, $mobile, $address, $userId) {
        $query = '';

        if (strlen($password) > 0) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //encrypt the new password before saving it to the database
            $query = "UPDATE users SET first_name='$firstName', last_name='$lastName', email='$email', password='$hashedPassword', mobile='$mobile', address='$address'
                    WHERE id=$userId";
        } else {
            $query = "UPDATE users SET first_name='$firstName', last_name='$lastName', email='$email', mobile='$mobile', address='$address'
                    WHERE id=$userId";
        }
        
        mysqli_query($this->connection, $query);
  
        $query = "SELECT id FROM users WHERE id=$userId";
        return mysqli_query($this->connection, $query);
    }

    // Authorization functions END
}
?>