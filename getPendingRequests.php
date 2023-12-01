<?php
header('Content-Type: application/json');
include 'db_connect.php'; // Include your DB config file

// SQL to fetch pending requests
$sql = "SELECT * FROM complaints WHERE status = 'Pending' OR status = 'In Progress' OR status = 'More Information Reqested'"; // Adjust according to your database schema

$result = $conn->query($sql);
$pendingRequests = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $pendingRequests[] = $row;
    }
    echo json_encode($pendingRequests);
} else {
    echo json_encode([]);
}

$conn->close();
?>
