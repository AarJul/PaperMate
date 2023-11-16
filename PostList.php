<?php
    include 'db_connect.php';
    $db = connect_db();

    $step_id = $_GET['id'];

    // Gọi hàm lấy danh sách steps
    $posts = get_step_posts($step_id, $db); 
?>

<!DOCTYPE html>
<html>
<body>

<?php while ($post = $result->fetch_assoc()): ?>

  <div>
    <a href="post_detail.php?id=<?php echo $row['postid']; ?>"><?php echo $row['postname']; ?> </a>
  </div>

<?php endwhile; ?>

</body>
</html>

