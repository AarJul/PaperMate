<?php
include 'db_connect.php';
session_start();
$_SESSION['step_id'] = null;
$db = connect_db();

// Fetch documentid from POST request
$document_id = isset($_POST['documentid']) ? $_POST['documentid'] : null;

$document_id = 1;

if ($document_id === null) {
    // Handle the case when documentid is not provided
    echo json_encode(['error' => 'Document ID is missing']);
} else {
    $_SESSION['document_id'] = $document_id;

    // Convert the result to JSON and output it
    header('Content-Type: application/json');
    echo get_document_steps_json($document_id, $db);
}

// Allow requests only from http://127.0.0.1:5500
header('Access-Control-Allow-Origin: http://127.0.0.1:5500');

// Allow the following HTTP methods
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

// Allow the following headers in the request
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization');

?>
