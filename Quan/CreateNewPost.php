<?php
    include 'db_connect.php';
    session_start();
    $db = connect_db();
   
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["postname"]) && $_POST["postcontent"]) {
        $currentDateTime = date("Y-m-d H:i:s");
        create_new_post($_SESSION['step_id'], $_SESSION['user_id'], $_POST["postname"], $_POST["postcontent"], $currentDateTime, $db);
        header("Location: PostList.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button onclick="goBack()">Back</button>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h6>PostName</h6>
        <input type="hidden" name="postid" id="postid" value="<?php echo $post_id; ?>">
        <textarea name="postname" rows="1"></textarea><br>
        
        <h6>PostContent</h6>
        <input type="hidden" name="postid" id="postid" value="<?php echo $post_id; ?>">
        <textarea name="postcontent" rows="5"></textarea><br>
        <button type="submit">Send Comment</button>
    </form>
    <script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>