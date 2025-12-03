<?php 

    // Database connection
    $conn = new mysqli("localhost", "root", "", "guidance_counseling_system");
    if ($conn->connect_error) {
        echo json_encode(["status" => "error", "message" => "Database connection failed"]);
        exit;
    }

?>