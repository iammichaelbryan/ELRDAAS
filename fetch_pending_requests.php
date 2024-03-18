<?php
session_start();
include 'db_connect.php'; // Ensure this is the path to your DB connection script

// Check if the user is logged in and has a resident ID
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_SESSION['userID'])) {
    $resident_id = $_SESSION['userID'];

    // Prepare SQL statement to fetch user's complaints
    $sql = "SELECT * FROM complaints WHERE resident_id = :resident_id AND status != 'Resolved'"; // Replace 'complaints' with your actual table name
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':resident_id', $resident_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the results
    $complaints = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the results as JSON
    echo json_encode($complaints);
} else {
    echo json_encode(array('error' => 'User not logged in or ID not found'));
}
?>