<?php
 include '../Quan/db_connect.php';
 $db = connect_db();

 $documents = get_documents_list($db);
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>

    <h1>List of procedures</h1>
    <?php while($row = $documents->fetch_assoc()): ?>
        <div>
            <img src="<?php echo $row['documentpics']; ?>">
        </div>
    <?php endwhile; ?>
    
</body>
</html>
