<?php
session_start();
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $complaintId = $_POST['complaintId'];
    $message = $_POST['message'];

    // Get the user_id of the resident who made the complaint
    $sql = "SELECT user_id FROM complaints WHERE id = :complaintId";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['complaintId' => $complaintId]);
    $userId = $stmt->fetchColumn();

    // Insert a new record into the notifications table
    $stmt = $conn->prepare("INSERT INTO notifications (user_id, user_type, notification_type, notification_id, message, status) VALUES (:user_id, 'Resident', 'Message', :notification_id, :message, 'Unread')");
    $stmt->execute([':user_id' => $userId, ':notification_id' => $complaintId, ':message' => $message]);

    echo "Notification created";
}
?>