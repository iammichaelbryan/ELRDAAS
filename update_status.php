<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $complaintId = $_POST['complaintId'];
    $fieldName = $_POST['fieldName'];
    $fieldValue = $_POST['fieldValue'];

    if (!in_array($fieldName, ['status', 'priority'], true)) {
        echo "Invalid field name.";
        exit;
    }

    $stmt = $conn->prepare("UPDATE complaints SET $fieldName = :fieldValue WHERE id = :complaintId");
    $stmt->bindParam(':fieldValue', $fieldValue);
    $stmt->bindParam(':complaintId', $complaintId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Get the user_id of the resident who made the complaint
        $sql = "SELECT user_id FROM complaints WHERE id = :complaintId";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['complaintId' => $complaintId]);
        $userId = $stmt->fetchColumn();

        // Insert a new record into the notifications table
        $notification_message = "The $fieldName of your complaint has been updated to $fieldValue.";
        $stmt = $conn->prepare("INSERT INTO notifications (user_id, user_type, notification_type, notification_id, message, status) VALUES (:user_id, 'Resident', 'Complaint', :notification_id, :message, 'Unread')");
        $stmt->execute([':user_id' => $userId, ':notification_id' => $complaintId, ':message' => $notification_message]);

        echo "Update successful";
    } else {
        echo "Update failed";
    }
}
?>