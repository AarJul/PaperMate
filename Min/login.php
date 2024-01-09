<?php
session_start();
require_once dirname(__FILE__) . '../function/db_connection.php';
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "papermate";
// require_once dirname(__FILE__) . '../function/auto_login.php';
//Connect to the database
$conn = connection();
$message = '';

// Function to check login and redirect users
function login()
{
  // Check if the "Remember Me" checkbox is checked
  if (isset($_POST['pass_save'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Store the email and password in the session
    $_SESSION['remember_email'] = $email;
    $_SESSION['remember_password'] = $password;
  } else {
    // If the checkbox is not checked, unset the session variables
    unset($_SESSION['remember_email']);
    unset($_SESSION['remember_password']);
    unset($_SESSION['auto_login_expiration']);
    unset($_SESSION['logout']);
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!empty($email) && !empty($password)) {
      $conn = connection();

      
      // Query the user table
      $userQuery = "SELECT * FROM user WHERE EMAIL = :email";
      $userStmt = $conn->prepare($userQuery);
      $userStmt->bindParam(':email', $email);
      $userStmt->execute();
      $userResult = $userStmt->fetch(PDO::FETCH_ASSOC);

      if ($userResult) {
        // User with email exists in the user table
        // Check the password
        if (count($userResult) > 0 && password_verify($password, $userResult['password'])) {
          // Successful login with user account
          // Save information to session or perform other actions
          $_SESSION['userid'] = $userResult['userid'];
          header("Location: ../Ivan/homepage.php");
          exit();
        } else {
          // echo "Incorrect password!";
        }
      } else {
        $message = 'User does not exist!';
      }
      $conn = null;
    } else {
      echo "Please enter email and password!";
    }
  }
}

// Call the login function
login();
?>
