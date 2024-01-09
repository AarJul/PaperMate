<?php

function connect_db() {

  $servername = "localhost";
  $username = "root"; 
  $password = "root";
  $dbname = "papermate";

  $conn = new mysqli($servername, $username, $password, $dbname);
  
  if ($conn->connect_error) {
    die("Lỗi kết nối: " . $conn->connect_error);
  }
    
  return $conn; 

}

function get_user_name($db_conn, $userid) {
  // SQL query with Prepared Statement
  $sql = "SELECT username FROM user WHERE userid = ?";
  
  // Prepare the query with a Prepared Statement
  $stmt = $db_conn->prepare($sql);
  $stmt->bind_param("i", $userid); // "i" represents the data type integer
  
  // Execute the query
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if there is any data returned
  if ($result && $result->num_rows > 0) {
      // Get the username value from the result row
      $row = $result->fetch_assoc();
      return $row['username'];
  } else {
      // Return a default value or null if not found
      return null;
  }
}

function get_documents_list($db_conn) {
  // SQL query with Prepared Statement
  $sql = "SELECT * FROM document";
  
  // Execute the query
  $documents_list = $db_conn->query($sql);

  // Return the result
  return $documents_list;
}

function get_documents_list_json($db_conn) {
  $documents_list = get_documents_list($db_conn);

  // Chuẩn bị một mảng để lưu thông tin của các tài liệu
  $documents_array = array();

  // Lấy từng hàng và thêm vào mảng
  while ($row = $documents_list->fetch_assoc()) {
      $documents_array[] = array(
          'documentid' => $row['documentid'],
          'documentname' => $row['documentname'],
          'documentpics' => $row['documentpics'],
          // Thêm các trường khác nếu cần
      );
  }

  // Trả về dưới dạng JSON
  return json_encode(['documents' => $documents_array]);
}


function get_document_steps($document_id, $db_conn) {
  // SQL query with Prepared Statement
  $sql = "SELECT stepsid, stepsname, stepspic FROM steps WHERE documentid = ?";
  
  // Prepare the query with a Prepared Statement
  $stmt = $db_conn->prepare($sql);
  $stmt->bind_param("i", $document_id); // "i" represents the data type integer
  
  // Execute the query
  $stmt->execute();
  $steps_list = $stmt->get_result();

  // Return the result
  return $steps_list;
}

function get_step_posts($step_id, $db_conn) {
  // SQL query with Prepared Statement
  $sql = "SELECT postid, postname FROM post WHERE stepsid = ?";
  
  // Prepare the query with a Prepared Statement
  $stmt = $db_conn->prepare($sql);
  $stmt->bind_param("i", $step_id); // "i" represents the data type integer
  
  // Execute the query
  $stmt->execute();
  $post_list = $stmt->get_result();

  // Return the result
  return $post_list;
}

function get_post_detail($post_id, $db_conn) {
  // SQL query to get post content 
  $get_postcontent = "SELECT postcontent FROM post WHERE postid = ?";
  
  // SQL query to get comments
  $get_comment = "SELECT commentid, userid, date, comment
          FROM comments 
          WHERE postid = ?
          ORDER BY date ASC";

  // Prepare the queries with Prepared Statements
  $stmtContent = $db_conn->prepare($get_postcontent);
  $stmtContent->bind_param("i", $post_id);

  $stmtComment = $db_conn->prepare($get_comment);
  $stmtComment->bind_param("i", $post_id);

  // Execute the first query
  $stmtContent->execute();
  $post_content = $stmtContent->get_result();

  // Execute the second query
  $stmtComment->execute();
  $post_comments = $stmtComment->get_result();

  // Close the statements
  $stmtContent->close();
  $stmtComment->close();

  // Put the results into an array
  $post_detail = array();
  $post_detail['postcontent'] = $post_content; 
  $post_detail['comments'] = $post_comments;

  // Return the array of results
  return $post_detail; 
}


function insert_comment($postid, $userid, $comment, $date, $db_conn) {
  // SQL query with Prepared Statement
  $sql = "INSERT INTO comments (postid, userid, comment, date) VALUES (?, ?, ?, ?)";
  
  // Prepare the query with a Prepared Statement
  $stmt = $db_conn->prepare($sql);
  $stmt->bind_param("iiss", $postid, $userid, $comment, $date); // "iiss" represents integer, string, string, string
  
  // Execute the query
  $stmt->execute();
  
  if ($stmt->error) {
    // Handle the error
    die("Query error: " . $stmt->error);
  }
}

function create_new_post($step_id, $user_id, $postname, $postcontent, $date, $db_conn) {
  // SQL query with Prepared Statement
  $sql = "INSERT INTO post (stepsid, userid, postname, postcontent, date) VALUES (?, ?, ?, ?, ?)";
  
  // Prepare the query with a Prepared Statement
  $stmt = $db_conn->prepare($sql);
  $stmt->bind_param("iisss", $step_id, $user_id, $postname, $postcontent, $date); // "iisss" represents integer, string, string, string, string
  
  // Execute the query
  $stmt->execute();

  if ($stmt->error) {
      // Handle the error
      die("Query error: " . $stmt->error);
  }
}



function save_document($documentname, $documentimglink, $steps, $db_conn){
  $sql_insert = "INSERT INTO document (documentname, documentpics) VALUES ('$documentname', '$documentimglink')";
  if ($db_conn->query($sql_insert) === TRUE) {
      echo "Dữ liệu đã được thêm thành công.";
  } else {
      echo "Lỗi: " . $sql_insert . "<br>" . $db_conn->error;
      return; 
  }
  $sql_select = "SELECT documentid FROM document WHERE documentname = '$documentname'";
  $result = $db_conn->query($sql_select);

  if ($result) {
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $documentid = $row["documentid"];
          echo "Document ID: " . $documentid;
          foreach ($steps as $step) {
              $stepname = $step['step'];
              $steppics = $step['imageLink'];

              $sql_insert_step = "INSERT INTO steps (documentid, stepsname, stepspic) VALUES ('$documentid', '$stepname', '$steppics')";
              if ($db_conn->query($sql_insert_step) !== TRUE) {
                  echo "Lỗi: " . $sql_insert_step . "<br>" . $db_conn->error;
              }
          }
      } else {
          echo "Không tìm thấy tài liệu có tên '$documentname'";
      }
  } else {
      echo "Lỗi: " . $sql_select . "<br>" . $db_conn->error;
  }

  $db_conn->close();
}


?>