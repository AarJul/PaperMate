<?php
session_start();
include 'db_connect.php';
$db = connect_db();

// Allow requests only from http://127.0.0.1:5500
header('Access-Control-Allow-Origin: http://127.0.0.1:5500');

// Allow the following HTTP methods
header('Access-Control-Allow-Methods: GET, POST');

// Allow the following headers in the request
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization');

// Fetch steppid from POST request
$step_id = isset($_POST['stepid']) ? $_POST['stepid'] : null;
$step_id = 1;

if ($step_id === null) {
    // Handle the case when step_id is not provided
    echo json_encode(['error' => 'Step ID is missing']);
} else {
    $_SESSION['step_id'] = $step_id;

    // Convert the result to JSON and output it
    header('Content-Type: application/json');
    echo get_step_posts_json($step_id, $db);
}
?>
