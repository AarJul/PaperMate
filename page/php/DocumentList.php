<?php
    include 'db_connect.php';
    session_start();
    $_SESSION['user_id'] = 1;
    $_SESSION['document_id'] = null;
    $_SESSION['step_id'] = null;
    $db = connect_db();
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
    <input type="text" id="searchInput" placeholder="検索">

    <div id="documentList">
        <?php while($row = $documents->fetch_assoc()): ?>
            <div class="documentItem" data-documentname="<?php echo $row['documentname']; ?>">
                <!-- <a href="StepsList.php?id=<?php //echo $row['documentid']; ?>"><?php //echo $row['documentname']; ?></a> -->
                <a href="getAllSteps_json.php?id=<?php echo $row['documentid']; ?>"><?php echo $row['documentname']; ?></a>

                <img src="<?php 
                    echo '../document_images/'; 
                    echo $row['documentpics']; 
                ?>">
            </div>
        <?php endwhile; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var searchTerm = $(this).val().toLowerCase();

                $(".documentItem").each(function() {
                    var documentName = $(this).data("documentname").toLowerCase();
                    var containsTerm = documentName.includes(searchTerm);
                    $(this).toggle(containsTerm);
                });
            });
        });
    </script>
</body>
</html>
