<?php
    include 'db_connect.php';
    $db = connect_db();
    $document_id = $_GET['id']; 

    // Gọi hàm lấy danh sách steps
    $steps = get_document_steps($document_id, $db); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button onclick="window.history.back()">Back</button>
    <br>
    <?php while($row = $steps->fetch_assoc()): ?>
        <div>
            <a href="PostList.php?id=<?php echo $row['stepsid']; ?>"> 
                <?php echo $row['stepsname']; ?>
            </a>
            <br>
            <img src="images\640.jpg" alt="">
        </div>
    <?php endwhile; ?>
</body>
</html>