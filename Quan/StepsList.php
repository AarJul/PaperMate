<?php
    include 'db_connect.php';
    session_start();
    $_SESSION['step_id'] = null;
    $db = connect_db();
    $document_id = $_SESSION['document_id'] === null ? $_GET['id'] : $_SESSION['document_id'];
    $_SESSION['document_id'] = $document_id;
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
    <button onclick="window.location.href='DocumentList.php'">Back</button>
    <br>
    <?php while($row = $steps->fetch_assoc()): ?>
        <div>
            <a href="PostList.php?id=<?php echo $row['stepsid']; ?>"> 
                <?php echo $row['stepsname']; ?>
                <img src="<?php 
                    echo '../document_images/'; 
                    echo $row['stepspic']; 
                ?>">
            </a>
            <br>
            <!-- <img src="..\images\<?php //echo $row['stepspic']; ?>" alt=""> -->
        </div>
    <?php endwhile; ?>
</body>
</html>