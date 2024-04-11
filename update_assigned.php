<?php
// update_status.php
session_start();
ini_set('display_errors', 1);
require 'db_connect.php'; // Make sure this file contains the database connection code.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $complaintId = $_POST['complaintId'];
    $assigned_to = $_POST['assigned_to']; // The new value for the assigned_to field.

    // Validate fieldName to make sure it's only 'status' or 'priority'

    // Your additional validations, like checking if the user is logged in and has admin role

    // Prepare the SQL statement to prevent SQL injection.
    $stmt = $conn->prepare("UPDATE complaints SET assigned_to = :assigned_to WHERE id = :complaintId");
    $stmt->bindParam(':assigned_to', $assigned_to);

    $stmt->bindParam(':complaintId', $complaintId, PDO::PARAM_INT);
    // Execute the statement and check if it was successful.
    if ($stmt->execute()) {
        echo "Update successful";
    } else {
        echo "Update failed";
    }
}
?>
