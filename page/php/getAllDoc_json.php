<?php
    include 'db_connect.php';
    session_start();
    $_SESSION['user_id'] = 1;
    $_SESSION['document_id'] = null;
    $_SESSION['step_id'] = null;
    $db = connect_db();
    
    // Echo a message to the console
    echo "PHP script executed successfully.";

    // Fetch and echo the documents data
    header('Content-Type: application/json');
    echo get_documents_list_json($db);
?>
