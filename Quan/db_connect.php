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

function get_documents_list($db_conn){
  // Câu truy vấn SQL
  $sql = "SELECT * FROM document";
  
  // Thực thi câu truy vấn
  $documents_list = $db_conn->query($sql);

  // Trả về kết quả
  return $documents_list;
}

function get_document_steps($document_id, $db_conn){

  // Câu truy vấn SQL 
  $sql = "SELECT stepid, stepname FROM steps WHERE documentid = $document_id";

  // Thực thi truy vấn
  $steps_list = $db_conn->query($sql);

  // Trả về kết quả
  return $steps_list;

}

function get_step_posts($step_id, $db_conn){

  // Câu truy vấn SQL 
  $sql = "SELECT postid, postname FROM post WHERE stepid = $step_id";

  // Thực thi truy vấn
  $steps_list = $db_conn->query($sql);

  // Trả về kết quả
  return $post_list;

}

?>