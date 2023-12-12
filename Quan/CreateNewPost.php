<?php
    include 'db_connect.php';
    session_start();
    $db = connect_db();
   

    // Kiểm tra xem có dữ liệu comment được gửi từ form không
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["postname"]) && $_POST["postcontent"]) {
        $currentDateTime = date("Y-m-d H:i:s");
        create_new_post($_SESSION['step_id'], $_SESSION['user_id'], $_POST["postname"], $_POST["postcontent"], $currentDateTime, $db);
        header("Location: PostList.php");
        exit(); // Đảm bảo không có mã HTML hoặc mã PHP khác được thực hiện sau khi chuyển hướng
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
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h6>PostName</h6>
        <input type="hidden" name="postid" id="postid" value="<?php echo $post_id; ?>">
        <textarea name="postname" rows="1"></textarea><br>
        <h6>PostContent</h6>
        <input type="hidden" name="postid" id="postid" value="<?php echo $post_id; ?>">
        <textarea name="postcontent" rows="5"></textarea><br>
        <button type="submit">Send Comment</button>
    </form>
</body>
</html>