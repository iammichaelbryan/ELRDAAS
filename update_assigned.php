<?php
session_start();
ini_set('display_errors', 1);
require 'db_connect.php'; // Make sure this file contains the database connection code.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $complaintId = $_POST['complaintId'];
    $assigned_to = $_POST['assigned_to']; // The new value for the assigned_to field.

    // Prepare the SQL statement to prevent SQL injection.
    $stmt = $conn->prepare("UPDATE complaints SET assigned_to = :assigned_to WHERE id = :complaintId");
    $stmt->bindParam(':assigned_to', $assigned_to);
    $stmt->bindParam(':complaintId', $complaintId, PDO::PARAM_INT);

    // Execute the statement and check if it was successful.
    if ($stmt->execute()) {
        // Get the user_id of the resident who made the complaint
        $sql = "SELECT user_id FROM complaints WHERE id = :complaintId";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['complaintId' => $complaintId]);
        $userId = $stmt->fetchColumn();

        // Insert a new record into the notifications table
        $notification_message = "Your complaint has been assigned to $assigned_to.";
        $stmt = $conn->prepare("INSERT INTO notifications (user_id, user_type, notification_type, notification_id, message, status) VALUES (:user_id, 'Resident', 'Complaint', :notification_id, :message, 'Unread')");
        $stmt->execute([':user_id' => $userId, ':notification_id' => $complaintId, ':message' => $notification_message]);

        echo "Update successful";
    } else {
        echo "Update failed";
    }
}
?>