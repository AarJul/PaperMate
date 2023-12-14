<?php
 session_start();
 include '../Quan/db_connect.php';
 $db = connect_db();

 $documents = get_documents_list($db);
 $userid = $_SESSION['userid'];
 $todo = get_todo_list($db,$userid);
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
            <a href="StepsList.php?id=<?php echo $row['documentid']; ?>"><?php echo $row['documentname']; ?></a>
            <img src="<?php echo $row['documentpics']; ?>">
        </div>
    <?php endwhile; ?>
    <h1>Todo</h1>
    <?php while($row = $todo->fetch_assoc()): ?>
        <div>
            <a href="StepsList.php?id=<?php echo $row['todoid']; ?>"><?php echo $row['todoname']; ?></a>
        </div>
    <?php endwhile; ?>
    <a href="todoinput.php">
        <button>Insert new Todo</button>
    </a>
    
</body>
</html>
