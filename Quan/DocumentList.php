<?php
    include 'db_connect.php';
    $db = connect_db();
    session_start();
    $documents = get_documents_list($db);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocumentList</title>
</head>
<body>
    <button onclick="window.history.back()">Back</button>
    <br>
    <input type="text" placeholder="検索">

    <?php while($row = $documents->fetch_assoc()): ?>
        <div>
            <a href="StepsList.php?id=<?php echo $row['documentid']; ?>"><?php echo $row['documentname']; ?></a>
            <img src="<?php echo $row['documentpics']; ?>">
        </div>
    <?php endwhile; ?>
</body>
</html>