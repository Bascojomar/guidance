<?php

include "database.php";

function GetData($sql_query) {
    global $conn;
    $result = $conn->query($sql_query);
    if (!$result || $result->num_rows === 0) {
        return false;
    }
    $row = $result->fetch_array(MYSQLI_NUM);
    // Applying htmlspecialchars to the fetched value
    return $row[0];
}

function accessName($id){
    global $conn;
    $query = 'SELECT accessName FROM user_roles WHERE access_type_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($officeName);
    $stmt->fetch();
    $stmt->close();
    return $officeName;
}
function studentName($id){
    global $conn;
    $query = 'SELECT * FROM students WHERE user_id=?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($officeName);
    $stmt->fetch();
    $stmt->close();
    return $officeName;
}

function getStat($choose) {
    // Read the JSON file
    $json_data = file_get_contents('setting.json');

    // Decode the JSON data into an associative array
    $data = json_decode($json_data, true);

    // Initialize the status variable
    $status = "";

    if ($choose !== null) {
        foreach ($data['statuses'] as $status_info) {
            if ($status_info['id'] == $choose) {
                $status = $status_info['status'];
                break;
            }
        }
    }

    return $status;
}

?>