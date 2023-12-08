<?php
session_start();
$_SESSION['comment_count'] = 0;

include 'db_connect.php';
$db = connect_db();
$step_id = $_GET['id'];

// Gọi hàm lấy danh sách bài viết
$posts = get_step_posts($step_id, $db); 
?>

<!DOCTYPE html>
<html>
<body>
    <button onclick="window.history.back()">Back</button>
    <br>
  <?php if ($posts && $posts->num_rows > 0): ?>
      <?php while ($post = $posts->fetch_assoc()): ?>
          <div>
              <a href="PostDetail.php?id=<?php echo $post['postid']; ?>"><?php echo $post['postname']; ?> </a>
          </div>
      <?php endwhile; ?>
  <?php else: ?>
      <p>Không có bài viết</p>
  <?php endif; ?>
</body>
</html>
