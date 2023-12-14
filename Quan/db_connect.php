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

function get_todo_list($db_conn, $userid){
  $sql = "SELECT * FROM todo WHERE userid = ?";

  $stmt = $db_conn->prepare($sql);
  $stmt->bind_param("i", $userid); // "i" represents the data type integer
  
  $stmt->execute();
  $result = $stmt->get_result();

  return $result;
}

function get_documents_list($db_conn) {
  // SQL query with Prepared Statement
  $sql = "SELECT * FROM document";
  
  // Execute the query
  $documents_list = $db_conn->query($sql);

  // Return the result
  return $documents_list;
}

function get_document_steps($document_id, $db_conn) {
  // SQL query with Prepared Statement
  $sql = "SELECT stepsid, stepsname FROM steps WHERE documentid = ?";
  
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



?>