<?php
session_start();
include 'db_connect.php';

try {
    $sql = "SELECT * FROM notices ORDER BY notice_date DESC, notice_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $notices = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($notices);
} catch (PDOException $e) {
    // For debugging purposes, echo the error message
    echo "Error: " . $e->getMessage();
    // In a production environment, you might want to log this error instead
}
?>