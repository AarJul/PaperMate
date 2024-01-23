<?php
    // Echo a message to the console
    echo "PHP script executed successfully.";

    // You can also include any other PHP code or logic here.

    // For testing purposes, let's simulate fetching some data.
    $data = array(
        "document_id" => 1,
        "documentname" => "Sample Document",
        "documentpics" => "sample.jpg",
        "user_id" => 1
    );

    // Encode the data as JSON and send it to the client
    header('Content-Type: application/json');
    echo json_encode($data);
?>