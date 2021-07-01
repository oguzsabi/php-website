<?php
require_once 'includes/session_logic.php';
require_once ('includes/database.php');

// initializing variables
$firstName = "";
$lastName = "";
$email_1 = "";
$email_2 = "";
$phoneNumber = "";
$address = "";
$errors = array();
$database = new DatabaseController();

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $firstName = $database->escapeString($_POST['first_name']);
  $lastName = $database->escapeString($_POST['last_name']);
  $email_1 = strtolower($database->escapeString($_POST['email_1']));
  $email_2 = strtolower($database->escapeString($_POST['email_2']));
  $password_1 = $database->escapeString($_POST['password_1']);
  $password_2 = $database->escapeString($_POST['password_2']);
  $phoneNumber = $database->escapeString($_POST['phone_number']);
  $address = $database->escapeString($_POST['address']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error into $errors array
  if (empty($firstName)) {
    array_push($errors, "First name is required");
  }

  if (empty($lastName)) {
    array_push($errors, "Last name is required");
  }
  
  if (empty($email_1)) {
    array_push($errors, "Email is required");
  }

  if (!empty($email_1) && !filter_var($email_1, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, "Email format is incorrect");
  }

  if (empty($email_2) && !empty($email_1)) {
    array_push($errors, "Confirm Email is required");
  }

  if ($email_1 !== $email_2 && !empty($email_2)) {
	  array_push($errors, "The two emails do not match");
  }

  if (empty($password_1)) {
    array_push($errors, "Password is required");
  }

  if (!empty($password_1)) {
    $uppercase = preg_match('@[A-Z]@', $password_1);
    $lowercase = preg_match('@[a-z]@', $password_1);
    $number = preg_match('@[0-9]@', $password_1);
    $specialChars = preg_match('@[^\w]@', $password_1);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password_1) < 8) {
      array_push($errors, "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character");
    }
  }
  
  if (empty($password_2) && !empty($password_1)) {
    array_push($errors, "Confrim Password is required");
  }

  if ($password_1 !== $password_2 && !empty($password_2)) {
	  array_push($errors, "The two passwords do not match");
  }

  if (empty($phoneNumber)) {
    array_push($errors, "Mobile phone is required");
  }

  if (empty($address) || (!empty($address) && strlen($address) < 3)) {
    array_push($errors, "Address is required");
  }

  if (!empty($phoneNumber)) {
    if (strpos($phoneNumber, '+') === false || strlen($phoneNumber) < 6) {
        array_push($errors, "Invalid mobile phone");
    } else {
        for ($i = 1; $i < strlen($phoneNumber); $i++) { // index starts from 1 to not count initial + sign
            if (!is_numeric($phoneNumber[$i])) {
                array_push($errors, "Invalid mobile phone");
                break;
            }
         }
    }
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user = $database->checkIfUserExists($email_1);
  if ($user && $user['email'] === $email_1) { 
    array_push($errors, "Email already exists");
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $newUser = $database->registerUser($firstName, $lastName, $email_1, $password_1, $phoneNumber, $address);

    if (mysqli_num_rows($newUser) == 1) {
      $guestId = $_SESSION['user_id'];
      $_SESSION['user_id'] = $newUser->fetch_assoc()['id'];      
      $_SESSION['first_name'] = $firstName;
      $_SESSION['last_name'] = $lastName;
      unset($_SESSION['is_guest']);

      $database->transferCartItemsToUser($guestId, $_SESSION['user_id']);

      header('location: index.php');
    } else {
        array_push($errors, "Something went wrong. Please try again.");
    }
  }
}

if (isset($_POST['account_settings'])) {
  $firstName = $database->escapeString($_POST['first_name']);
  $lastName = $database->escapeString($_POST['last_name']);
  $email_1 = strtolower($database->escapeString($_POST['email_1']));
  $email_2 = strtolower($database->escapeString($_POST['email_2']));
  $password_1 = $database->escapeString($_POST['password_1']);
  $password_2 = $database->escapeString($_POST['password_2']);
  $phoneNumber = $database->escapeString($_POST['phone_number']);
  $address = $database->escapeString($_POST['address']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error into $errors array
  if (empty($firstName)) {
    array_push($errors, "First name is required");
  }

  if (empty($lastName)) {
    array_push($errors, "Last name is required");
  }
  
  if (empty($email_1)) {
    array_push($errors, "Email is required");
  }

  if (!empty($email_1) && !filter_var($email_1, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, "Email format is incorrect");
  }

  if (empty($email_2) && !empty($email_1)) {
    array_push($errors, "Confirm Email is required");
  }

  if ($email_1 !== $email_2 && !empty($email_2)) {
	  array_push($errors, "The two emails do not match");
  }

  if (!empty($password_1)) {
    $uppercase = preg_match('@[A-Z]@', $password_1);
    $lowercase = preg_match('@[a-z]@', $password_1);
    $number = preg_match('@[0-9]@', $password_1);
    $specialChars = preg_match('@[^\w]@', $password_1);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password_1) < 8) {
      array_push($errors, "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character");
    }
  }
  
  if (empty($password_2) && !empty($password_1)) {
    array_push($errors, "Confrim Password is required");
  }

  if ($password_1 !== $password_2 && !empty($password_2)) {
	  array_push($errors, "The two passwords do not match");
  }

  if (empty($phoneNumber)) {
    array_push($errors, "Mobile phone is required");
  }

  if (empty($address) || (!empty($address) && strlen($address) < 3)) {
    array_push($errors, "Address is required");
  }

  if (!empty($phoneNumber)) {
    if (strpos($phoneNumber, '+') === false || strlen($phoneNumber) < 6) {
        array_push($errors, "Invalid mobile phone");
    } else {
        for ($i = 1; $i < strlen($phoneNumber); $i++) { // index starts from 1 to not count initial + sign
            if (!is_numeric($phoneNumber[$i])) {
                array_push($errors, "Invalid mobile phone");
                break;
            }
         }
    }
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user = $database->checkIfUserExists($email_1);
  if ($user && $user['email'] === $email_1 && $_SESSION['user_id'] != $user['id']) { 
    array_push($errors, "Email already exists");
  }

  if (count($errors) == 0) {
    $updatedUser = $database->updateUser($firstName, $lastName, $email_1, $password_1, $phoneNumber, $address, $_SESSION['user_id']);

    if (mysqli_num_rows($updatedUser) == 1) {
      $_SESSION['first_name'] = $firstName;
      $_SESSION['last_name'] = $lastName;
    } else {
        array_push($errors, "Something went wrong. Please try again.");
    }
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = $database->escapeString($_POST['email']);
  $password = $database->escapeString($_POST['password']);

  if (empty($email)) {
      array_push($errors, "Email is required");
  }

  if (empty($password)) {
      array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
      $result = $database->checkIfUserExists($email);

      if ($result) {
        $user = $result;

        if (password_verify($password, $user['password'])) {
          $guestId = $_SESSION['user_id'];
          $_SESSION['user_id'] = $user['id'];   
          $_SESSION['first_name'] = $user['first_name'];
          $_SESSION['last_name'] = $user['last_name'];
          unset($_SESSION['is_guest']);

          $database->transferCartItemsToUser($guestId, $_SESSION['user_id']);

          header('location: index.php');
        } else {
          array_push($errors, "Wrong username/password combination");
        }
      } else {
          array_push($errors, "This email does not exist");
      }
  }
}

?>