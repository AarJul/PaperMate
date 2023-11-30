 <?php
// データベースの情報　
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "papermate";

$conn = new mysqli($servername, $username, $password, $dbname);

//接続のチェック
if ($conn->connect_error) {
    die("アクセス失敗: " . $conn->connect_error);
}

$sql;
//フォームから送信されたデータを取得
$name = $_POST['name'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$language = $_POST['language'];


    $stmt = $conn->prepare("INSERT INTO user (username,telephone,email,password,language) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param($name, $telephone, $email, $hashedPassword, $address);


if ($stmt->execute()) {
    echo "登録できた！";
} else {
    echo "エラー: " . $stmt->error;
}

$stmt->close();

$conn->close();
?>



