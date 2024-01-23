<?php
    include 'db_connect.php';
    session_start();
    $_SESSION['user_id'] = 1;
    $_SESSION['document_id'] = null;
    $_SESSION['step_id'] = null;
    $db = connect_db();
    $documents = get_documents_list($db);

    // Chuyển kết quả thành JSON và in ra màn hình
    header('Content-Type: application/json');
    echo get_documents_list_json($db);
?>
