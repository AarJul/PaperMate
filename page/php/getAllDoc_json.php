<?php
    include 'db_connect.php';
    session_start();
    $_SESSION['user_id'] = 1;
    $_SESSION['document_id'] = null;
    $_SESSION['step_id'] = null;

    // Allow requests from any origin (you may want to restrict this in a production environment)
    header('Access-Control-Allow-Origin: http://127.0.0.1:5500');

    // Allow the following HTTP methods
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

    // Allow the following headers in the request
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization');

    $db = connect_db();
    $documents = get_documents_list($db);

    // Convert the result to JSON and output it
    header('Content-Type: application/json');
    echo get_documents_list_json($db);
?>
