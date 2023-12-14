<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "papermate";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $userid = $_SESSION["userid"];

    $stmt = $conn->prepare("INSERT INTO todo (todoname, userid) 
                            VALUES (?, ?)");

    if (!$stmt) {
        die('Error in statement preparation: ' . $conn->error);
    }

    $stmt->bind_param("si", $name, $userid);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: homepage.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
?>
