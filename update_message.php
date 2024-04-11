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

        echo "Message updated successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>