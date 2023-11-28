<?php

require_once dirname(__FILE__) . '/db_connection.php';

// Function to check and set up auto-login
function auto_login()
{
  if (isset($_SESSION['remember_email']) && isset($_SESSION['remember_password'])) {
    $email = $_SESSION['remember_email'];
    $password = $_SESSION['remember_password'];

    // Connect to the database
    $conn = connection();

    // Check email in the store table
    $storeQuery = "SELECT * FROM store WHERE STORE_EMAIL = :email";
    $storeStmt = $conn->prepare($storeQuery);
    $storeStmt->bindParam(':email', $email);
    $storeStmt->execute();
    $storeResult = $storeStmt->fetch(PDO::FETCH_ASSOC);

    // Check email in the user table
    $userQuery = "SELECT * FROM user WHERE USER_EMAIL = :email";
    $userStmt = $conn->prepare($userQuery);
    $userStmt->bindParam(':email', $email);
    $userStmt->execute();
    $userResult = $userStmt->fetch(PDO::FETCH_ASSOC);

    // Close the database connection
    $conn = null;

    if ($storeResult) {
      // If the email exists in the store table and the password is correct, auto-login
      if (count($storeResult) > 0 && password_verify($password, $storeResult['STORE_PASSWORD'])) {
        $_SESSION['user_id'] = $storeResult['STORE_ID'];
        header("Location: homepage.php");
        exit();
      }
    } elseif ($userResult) {
      // If the email exists in the user table and the password is correct, auto-login
      if (count($userResult) > 0 && password_verify($password, $userResult['USER_PASSWORD'])) {
        $_SESSION['user_id'] = $userResult['USER_ID'];
        header("Location: user.php");
        exit();
      }
    }

    // Clear auto-login information if it's invalid
    unset($_SESSION['remember_email']);
    unset($_SESSION['remember_password']);
    unset($_SESSION['auto_login_expiration']);
    unset($_SESSION['logout']);
  }
}

// Call the auto_login function to check and set up auto-login
auto_login();
?>