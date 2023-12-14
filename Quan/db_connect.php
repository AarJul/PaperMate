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

function get_user_name($db_conn, $userid) {
  // Câu truy vấn SQL
  $sql = "SELECT username FROM user WHERE userid = $userid";

  // Thực thi câu truy vấn
  $result = $db_conn->query($sql);

  // Kiểm tra xem có dữ liệu trả về không
  if ($result && $result->num_rows > 0) {
      // Lấy giá trị username từ dòng kết quả
      $row = $result->fetch_assoc();
      return $row['username'];
  } else {
      // Trả về một giá trị mặc định hoặc null nếu không tìm thấy
      return null;
  }
}

function get_todo_list($db_conn){
  $sql = "SELECT * FROM todo";
  
  $todo_list = $db_conn->query($sql);

  return $todo_list;
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
  $get_postcontent = "SELECT postcontent FROM post WHERE postid = $post_id";
  
  // Câu truy vấn lấy các bình luận
  $get_comment = "SELECT commentid, userid, date, comment
           FROM comments 
           WHERE postid = $post_id
           ORDER BY date ASC";

  $post_content = $db_conn->query($get_postcontent);
  $post_comments = $db_conn->query($get_comment);

  // Cho kết quả vào mảng
  $post_detail = array();
  $post_detail['postcontent'] = $post_content; 
  $post_detail['comments'] = $post_comments;

  // Trả về mảng kết quả
  return $post_detail; 

}

function insert_comment($postid, $userid, $comment, $date, $db_conn){
  $sql = "INSERT INTO comments (postid, userid, comment, date) VALUES ('$postid', '$userid', '$comment', '$date')";
  $result = $db_conn->query($sql);
  
  if (!$result) {
    // Xử lý lỗi
    die("Lỗi truy vấn: " . $db_conn->error);
  }
}


function create_new_post($step_id, $user_id, $postname, $postcontent, $date, $db_conn) {
  $sql = "INSERT INTO post (stepsid, userid, postname, postcontent, date) VALUES ('$step_id', '$user_id', '$postname', '$postcontent', '$date')";
  $result = $db_conn->query($sql);

  if (!$result) {
      // Xử lý lỗi
      die("Lỗi truy vấn: " . $db_conn->error);
  }
}


?>