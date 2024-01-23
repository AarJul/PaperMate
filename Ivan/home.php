<?php
function delete_todo_item($db, $todoid) {
    $sql = "DELETE FROM todo WHERE todoid = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $todoid);
    return $stmt->execute();
}
session_start();
include '../Quan/db_connect.php';
$db = connect_db();

if (isset($_POST['delete_todo'])) {
    $todoid = $_POST['todoid'];
    $result = delete_todo_item($db, $todoid);

    if ($result) {
        // Refresh the page after deletion or perform any other action
        header("Location: home.php");
    } else {
        echo "Error deleting todo item.";
    }
}
$documents = get_documents_list($db);
$userid = $_SESSION['userid'];
$username = get_user_name($db, $userid);
$todo = get_todo_list($db, $userid);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Account</title>

    <link rel="stylesheet" href="style/home.css">

    <!-- import script -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

</head>

<body>
    <div id="app">
            <ul class="navbar navbar-expand-sm bg-dark navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="allDoc.html">PaperMate</a>
                </div>
            </ul>
        </div>
        <div id="google_translate_element"></div>
 
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en'},
                'google_translate_element'
            );
        }
    </script>
 
    <script type="text/javascript"
            src=
"https://translate.google.com/translate_a/element.js?
cb=googleTranslateElementInit">
    </script>
 
        <div class="container-fluid">
            <!-- main -->
            <div class="main">
                <h1 class="text-center">Welcome, <?php echo $username; ?></h1>
                <br>
                <div class="row card-padding">
                    <div class="col">
                        <a href="../page/allDoc.html">
                            <div class="card text-center">
                                <img class="card-img-top" src="document.jpg" alt="Title" style="width: 20%; margin: 0 auto;">
                                <div class="card-body">
                                    <h4 class="card-title">Document List</h4>
                                </div>
                            </div>
                        </a>
                        <a href="todoinput.php">
                            <div class="card text-center">
                                <img class="card-img-top" src="tofo2.jpg" alt="Title" style="width: 30%; margin: 0 auto;">
                                <div class="card-body">
                                    <h4 class="card-title">Make new To-Do-List</h4>
                                </div>
                            </div>
                        </a>

                        <!-- to do list table -->
                        <table class="table table-hover table-warning table-borderless ">
                            <thead>
                              <tr>
                                <th class="" colspan="3">
                                    <h2>Your TO DO LIST</h2>
                                </th>
                              </tr>
                            </thead>
                            <tbody><?php while($row = $todo->fetch_assoc()): ?>
                              <tr>
                                <td><?php echo $row['todoname']; ?></a></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="todoid" value="<?php echo $row['todoid']; ?>">
                                        <button type="submit" name="delete_todo" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                              </tr>
                            </tbody>
                            <?php endwhile; ?>

                          </table>
                    </div>
                    <div class="col">
                        <div class="row g-2">
                            <div class="col">
                                <a href="../quan/StepsList.php?id=1">
                                    <div class="card text-center">
                                        <img class="card-img-top" src="japan.jpg" alt="Title" style="width: 90%; margin: 0 auto;">
                                        <div class="card-body">
                                            <h4 class="card-title">Just moved to Japan</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="../quan/StepsList.php?id=1">
                                    <div class="card text-center">
                                        <img class="card-img-top" src="hospital.jpg " alt="Title" style="width: 70%; margin: 0 auto;">
                                        <div class="card-body">
                                            <h4 class="card-title">Go to Hospital</h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <table class="table table-hover table-warning table-borderless ">
                            <thead>
                              <tr>
                                <th class="" colspan="3">
                                    <h2>Latest Post</h2>
                                </th>
                              </tr>
                            </thead>
                            <tbody><?php while($row = $documents->fetch_assoc()): ?>
                              <tr>
                                <td><a href="../quan/StepsList.php?id=<?php echo $row['documentid']; ?>"><?php echo $row['documentname']; ?></a></td>
                                <td><img src="<?php echo $row['documentpics']; ?>"></td>
                                <td>john@example.com</td>
                              </tr>
                              
                            </tbody><?php endwhile; ?>
                          </table>
                    </div>
                </div>
            </div>
            <br>
            <!-- footer -->
            <div class="mt-4 p-5 bg-secondary p-3 text-white rounded">
                <h1>広告</h1>
            </div>
        </div>
    </div>
    <!-- bottom navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-bottom bg-danger">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bottom-navbar">
                <ul class="nav justify-content-end align-items-end ms-auto">
                    <li class="nav-item">
                        <div class="dropup">
                            <button type="button" class="btn btn-danger btn-lg dropdown-toggle"
                                data-bs-toggle="dropdown">
                                Language
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">Vietnam</a></li>
                                <li><a class="dropdown-item" href="#">Chinese</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    </div>
    

</body>

</html>