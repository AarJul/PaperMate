<?php
    include 'db_connect.php';
    $db = connect_db();

    $post_id = $_GET['id'];
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
    $content = $detail['postcontent']->fetch_assoc(); 

    echo "<h1>" . $content['postcontent'] . "</h1>";

    // In danh sách bình luận
    $comments = $detail['comments'];
    echo "<br>";

    foreach ($comments as $comment) {
        
        echo "Ngày: " . $comment['date'];
        echo "<br>";
        echo "Nội dung: " . $comment['comment'];
        echo "<br>";
        echo "<br>";

    }
    ?>

    <form method="POST" action="comment.php">
        <textarea name="comment_content" rows="5"></textarea><br>
        <button type="submit">Gửi comment</button>
    </form>
</body>
</html>