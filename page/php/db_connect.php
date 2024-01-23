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

function get_document_steps_json($document_id, $db_conn) {
  // Gọi hàm get_document_steps để lấy danh sách bước từ cơ sở dữ liệu
  $steps_list = get_document_steps($document_id, $db_conn);

  // Chuẩn bị một mảng để lưu thông tin của các bước
  $steps_array = array();

  // Lấy từng hàng và thêm vào mảng
  while ($row = $steps_list->fetch_assoc()) {
      $steps_array[] = array(
          'stepsid' => $row['stepsid'],
          'stepsname' => $row['stepsname'],
          'stepspic' => $row['stepspic'],
          // Thêm các trường khác nếu cần
      );
  }

  // Trả về dưới dạng JSON
  return json_encode(['steps' => $steps_array]);
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

function get_step_posts_json($step_id, $db_conn) {
  // Gọi hàm get_step_posts để lấy danh sách bài viết từ cơ sở dữ liệu
  $post_list = get_step_posts($step_id, $db_conn);

  // Chuẩn bị một mảng để lưu thông tin của các bài viết
  $posts_array = array();

  // Lấy từng hàng và thêm vào mảng
  while ($row = $post_list->fetch_assoc()) {
      $posts_array[] = array(
          'postid' => $row['postid'],
          'postname' => $row['postname'],
          // Thêm các trường khác nếu cần
      );
  }

  // Trả về dưới dạng JSON
  return json_encode(['posts' => $posts_array]);
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

function get_post_detail_json($post_id, $db_conn) {
  // Call the get_post_detail function to retrieve post details
  $post_detail = get_post_detail($post_id, $db_conn);

  // Convert the associative array to JSON
  $post_detail_json = json_encode($post_detail);

  // Return the JSON string
  return $post_detail_json;
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

  $sql_insert = "INSERT INTO document (documentname, documentpics) VALUES (?, ?)";

  // Sử dụng prepared statement để tránh SQL injection
  $stmt = $db_conn->prepare($sql_insert);

  // Kiểm tra xem prepared statement có được tạo đúng không
  if ($stmt === FALSE) {
      die("Lỗi khi tạo prepared statement: " . $db_conn->error);
  }

  // Đọc dữ liệu hình ảnh từ URL
  $documentimglink = "../document_images/" . $documentimglink;
  $imageData = file_get_contents($documentimglink);

  if ($imageData !== FALSE) {
      // Tiếp tục xử lý dữ liệu ảnh...
  } else {
      echo "Lỗi khi đọc tập tin ảnh.";
  }

  $base64Image = base64_encode($imageData);

  $stmt->bind_param("ss", $documentname, $base64Image);

  if ($stmt->execute() !== TRUE) {
      echo "Lỗi: " . $sql_insert . "<br>" . $stmt->error;
  }

  $stmt->close();

  $sql_select = "SELECT documentid FROM document WHERE documentname = '$documentname'";
  $result = $db_conn->query($sql_select);

  if ($result) {
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $documentid = $row["documentid"];
          echo "Document ID: " . $documentid;
         
          foreach ($steps as $step) {
            $stepname = $step['step'];
            $imageLink = $step['imageLink'];
        
            // Đọc dữ liệu hình ảnh từ URL
            $imageData = file_get_contents($imageLink);
        
            // Chuyển dữ liệu hình ảnh sang dạng chuỗi base64
            $base64Image = base64_encode($imageData);
        
            $sql_insert_step = "INSERT INTO steps (documentid, stepsname, stepspic) VALUES ('$documentid', '$stepname', '$base64Image')";
        
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