<?php
    session_start();

    // Lấy giá trị của biến $user_id từ session
    // $userid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $userid = "1";
    include 'db_connect.php';
    $db = connect_db();

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $post_id = isset($_GET['id']) ? $_GET['id'] : null;
        $detail = get_post_detail($post_id, $db);
    }

    // Kiểm tra xem có dữ liệu comment được gửi từ form không
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comment_content"])) {

        $post_id = $_POST["postid"];
        // Lấy ngày và giờ hiện tại
        $currentDateTime = date("Y-m-d H:i:s");
        
        // Gọi hàm xử lý comment với nội dung comment được gửi từ form
        insert_comment($post_id,$userid,$_POST["comment_content"],$currentDateTime,$db);

        // Redirect lại trang để refresh
        header("Location: PostDetail.php?id=$post_id");
        exit(); // Đảm bảo không có mã HTML hoặc mã PHP khác được thực hiện sau khi chuyển hướng
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PostDetail</title>
</head>
<body>
    <?php 
    // In nội dung bài viết 
    $content = $detail['postcontent']->fetch_assoc(); 

    echo "<h1>" . $content['postcontent'] . "</h1>";

    // In danh sách bình luận
    $comments = $detail['comments'];
    echo "<br>";

    foreach ($comments as $comment) {
        $username = get_user_name($db, $comment['userid']);
        echo "User: " . $username;
        echo "<br>";
        echo "Ngày: " . $comment['date'];
        echo "<br>";
        echo "Nội dung: " . $comment['comment'];
        echo "<br>";
        echo "<br>";

    }
    ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="postid" id="postid" value="<?php echo $post_id; ?>">
        <textarea name="comment_content" rows="5"></textarea><br>
        <button type="submit">Send Comment</button>
    </form>
</body>
</html>