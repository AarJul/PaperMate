<?php
    include 'db_connect.php';
    session_start();
    $_SESSION['step_id'] = null;
    $db = connect_db();
    $document_id = $_SESSION['document_id'] === null ? $_GET['id'] : $_SESSION['document_id'];
    $_SESSION['document_id'] = $document_id;

    // Chuyển kết quả thành JSON và in ra màn hình
    header('Content-Type: application/json');
    echo get_document_steps_json($document_id, $db);
?>