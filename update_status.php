<?php
// update_status.php
session_start();
require 'db_connect.php'; // Make sure this file contains the database connection code.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $complaintId = $_POST['complaintId'];
    $fieldName = $_POST['fieldName']; // This should be 'status' or 'priority'.
    $fieldValue = $_POST['fieldValue']; // The new value for the status or priority.

    // Validate fieldName to make sure it's only 'status' or 'priority'
    if (!in_array($fieldName, ['status', 'priority'], true)) {
        echo "Invalid field name.";
        exit;
    }

    // Your additional validations, like checking if the user is logged in and has admin role

    // Prepare the SQL statement to prevent SQL injection.
    $stmt = $conn->prepare("UPDATE complaints SET $fieldName = :fieldValue WHERE id = :complaintId");
    $stmt->bindParam(':fieldValue', $fieldValue);

    $stmt->bindParam(':complaintId', $complaintId, PDO::PARAM_INT);
    // Execute the statement and check if it was successful.
    if ($stmt->execute()) {
        echo "Update successful";
    } else {
        echo "Update failed";
    }
}
?>
