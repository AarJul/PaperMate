<?php

// Hàm kết nối CSDL
function connect_db() {

  // Thông tin kết nối
  $servername = "localhost";
  $username = "root"; 
  $password = "root";
  $dbname = "papermate";

  // Tạo kết nối
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  // Kiểm tra kết nối
  if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
  }
    
  // Trả về đối tượng kết nối
  return $conn; 

}

?>