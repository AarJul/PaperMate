<?php
session_start();
require_once dirname(__FILE__) . '/function/db_connection.php';
require_once dirname(__FILE__) . '/function/auto_login.php';
// Connect to the database
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

      // Query the store table
      $storeQuery = "SELECT * FROM store WHERE STORE_EMAIL = :email";
      $storeStmt = $conn->prepare($storeQuery);
      $storeStmt->bindParam(':email', $email);
      $storeStmt->execute();
      $storeResult = $storeStmt->fetch(PDO::FETCH_ASSOC);

      // Query the user table
      $userQuery = "SELECT * FROM user WHERE USER_EMAIL = :email";
      $userStmt = $conn->prepare($userQuery);
      $userStmt->bindParam(':email', $email);
      $userStmt->execute();
      $userResult = $userStmt->fetch(PDO::FETCH_ASSOC);

      if ($storeResult) {
        // User with email exists in the store table
        // Check the password
        if (count($storeResult) > 0 && password_verify($password, $storeResult['STORE_PASSWORD'])) {
          // Successful login with store account
          // Save information to session or perform other actions
          $_SESSION['store_email'] = $storeResult['STORE_EMAIL'];
          header("Location: w_store_page/getfood_disposal.php");
          exit();
        } else {
          echo "Incorrect password!";
        }
      } elseif ($userResult) {
        // User with email exists in the user table
        // Check the password
        if (count($userResult) > 0 && password_verify($password, $userResult['USER_PASSWORD'])) {
          // Successful login with user account
          // Save information to session or perform other actions
          $_SESSION['user_id'] = $userResult['USER_ID'];
          header("Location: user.php");
          exit();
        } else {
          // echo "Incorrect password!";
        }
      } else if ($email == "admin@gmail.com") {
        if ($password == "admin") {
          header("Location: w_company_page/statusdisposalpage.php");
        } else {
          $message = 'User does not exist!';
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/login.css" />
  <link rel="stylesheet" href="css/footer.css" />
  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <title>Login Page</title>
</head>

<body style="height: 1000px">

  <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="w_Landing_Page/landing.html">
          <!-- <span class="logo"></span> -->
          OutSeaS
        </a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="w_Landing_Page/landing.html">ホーム</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">ストア用<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="./w_Store_Inventory/StoreInvnt.html">ストアフロント</a></li>
            <li><a href="../w_disposal_page/registerDisposal.html">廃棄登録</a></li>
            <li><a href="../w_store_page/storeInfo.html">ストア情報</a></li>
          </ul>
        </li>
        <li><a href="../w_disposal_page/deliveryDisposal.html">廃棄情報</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="w_Account_Register/Register.html"><span class="glyphicon glyphicon-user"></span> 新規登録</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container" style="margin-top: 70px;">
    <h1 class="text-center">ログイン</h1>
    <br>
    <h4 class="text-center">アカウントをお持ちでない方は、 <a href="w_Account_Register/Register.html">新規登録</a></h4>
    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="メールアドレスを入力" />
      <input name="password" type="password" placeholder="パスワードを入力" />
      <div class="text-center">
        <input type="checkbox" name="pass_save" value="true" />
        <label for="pass_save">パスワードを記憶する</label>
      </div>
      <div class="text-center">
        <button class="btn btn-primary btn-lg mx-auto" type="submit" name="login">ログイン</button>
      </div>
    </form>

    <br />
    
  </div>
  <footer class="custom-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h5>About Us</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
          <div class="col-md-6">
            <h5>Contact</h5>
            <ul class="list-unstyled">
              <li>Phone: 123-356-7890</li>
              <li>Email: info@example.com</li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
</body>

</html>