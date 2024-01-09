<?php
session_start();
include 'db_connect.php';
$db = connect_db();
$step_id = $_SESSION['step_id'] === null ? $_GET['id'] : $_SESSION['step_id'];
$_SESSION['step_id'] = $step_id;
$posts = get_step_posts($step_id, $db); 
?>

<!DOCTYPE html>
<html>
<body>
    <button onclick="window.location.href='StepsList.php'">Back</button>
    <br>
    <?php if ($posts && $posts->num_rows > 0): ?>
        <?php while ($post = $posts->fetch_assoc()): ?>
            <div>
                <a href="PostDetail.php?id=<?php echo $post['postid']; ?>"><?php echo $post['postname']; ?> </a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>投稿がありません</p>
    <?php endif; ?>
    <a href="CreateNewPost.php">New Post </a>
</body>
</html>
