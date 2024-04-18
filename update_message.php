<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $complaintId = $_POST['complaintId'];
    $message = $_POST['message'];

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE complaints SET message = :message WHERE complaint_id = :complaintId";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['message' => $message, 'complaintId' => $complaintId]);

        // Get the user_id of the resident who made the complaint
        $sql = "SELECT user_id FROM complaints WHERE complaint_id = :complaintId";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['complaintId' => $complaintId]);
        $userId = $stmt->fetchColumn();

        // Insert a new record into the notifications table
        $notification_message = "You have received a new message.";
        $stmt = $conn->prepare("INSERT INTO notifications (user_id, notification_type, notification_id, message, status) VALUES (:user_id, 'Message', :notification_id, :message, 'Unread')");
        $stmt->execute([':user_id' => $userId, ':notification_id' => $complaintId, ':message' => $notification_message]);

        echo "Message updated successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>