<?php
session_start();
include 'db_connect.php';
$db = connect_db();

// Allow requests only from http://127.0.0.1:5500
header('Access-Control-Allow-Origin: http://127.0.0.1:5500');

// Allow the following HTTP methods
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

// Allow the following headers in the request
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization');

$step_id = $_SESSION['step_id'] === null ? $_GET['id'] : $_SESSION['step_id'];
$_SESSION['step_id'] = $step_id;

if ($step_id === null) {
    // Handle the case when documentid is not provided
    echo json_encode(['error' => 'Document ID is missing']);
} else {
    echo get_step_posts_json($step_id, $db);
}

?>