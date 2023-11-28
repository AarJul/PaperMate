<?php
    include 'db_connect.php';
    $db = connect_db();

    // $post_id = $_GET['id'];
    $post_id = "1";
    $detail = get_post_detail($post_id, $db);
    
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
    echo $detail['content'];

    // In danh sách bình luận
    $comments = $detail['comments'];

    foreach ($comments as $comment) {

        echo "Ngày: " . $comment['date'];
        echo "Nội dung: " . $comment['commentcontent'];

    }
    ?>
</body>
</html>