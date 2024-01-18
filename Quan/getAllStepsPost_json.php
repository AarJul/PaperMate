<?php
session_start();
include 'db_connect.php';
$db = connect_db();
$step_id = $_SESSION['step_id'] === null ? $_GET['id'] : $_SESSION['step_id'];
$_SESSION['step_id'] = $step_id;
echo get_step_posts_json($step_id, $db)
?>