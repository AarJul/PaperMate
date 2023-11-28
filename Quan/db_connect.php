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
  $sql = "SELECT stepsid, stepsname FROM steps WHERE documentid = $document_id";

  // Thực thi truy vấn
  $steps_list = $db_conn->query($sql);

  // Trả về kết quả
  return $steps_list;

}

function get_step_posts($step_id, $db_conn){

  // Câu truy vấn SQL 
  $sql = "SELECT postid, postname FROM post WHERE stepsid = $step_id";

  // Thực thi truy vấn
  $post_list = $db_conn->query($sql);
  
  // Trả về kết quả
  return $post_list;

}
function get_post_detail($post_id, $db_conn){

  // Câu truy vấn lấy nội dung bài viết 
  $sql = "SELECT postcontent FROM post WHERE postid = $post_id";
  
  // Câu truy vấn lấy các bình luận
  $sql2 = "SELECT commentid, userid, date, commentcontent 
           FROM comment 
           WHERE postid = $post_id
           ORDER BY date ASC";

  $post_content = $db_conn->query($sql);
  $post_comments = $db_conn->query($sql2);

  // Cho kết quả vào mảng
  $post_detail = array();
  $post_detail['content'] = $post_content; 
  $post_detail['comments'] = $post_comments;

  // Trả về mảng kết quả
  return $post_detail; 

}

?>