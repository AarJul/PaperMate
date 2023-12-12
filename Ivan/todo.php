<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "papermate";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$language = $_POST['language'];

$stmt = $conn->prepare("INSERT INTO todo (todoname) 
                        VALUES (?, ?, ?, ?, ?)");

if (!$stmt) {
    die('Error in statement preparation: ' . $conn->error);
}

$stmt->bind_param("sssss", $name, $telephone, $email, $hashedPassword, $language);

if ($stmt->execute()) {
    echo "Registration successful!";
    header("Location: ../Min/login.html");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
