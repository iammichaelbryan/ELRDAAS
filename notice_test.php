<?php
session_start();
include 'db_connect.php';

// Sanitize and fetch input for subject and content
$notice_subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
$notice_content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

// Validate input
if (empty($notice_subject) || empty($notice_content)) {
    echo "Both subject and content are required.";
    exit; // Exit if validation fails
}

// Generate a unique notice ID and get the current date and time
$notice_id = uniqid('N');
$notice_date = date('Y-m-d'); // Format: YYYY-MM-DD
$notice_time = date('H:i'); // Format: HH:MM

try {
    $sql = "INSERT INTO notices (notice_id, notice_date, notice_time, notice_subject, notice_content) VALUES (:notice_id, :notice_date, :notice_time, :notice_subject, :notice_content)";
    $stmt = $conn->prepare($sql);
    
    // Execute SQL statement with bound parameters
    $stmt->execute([
        ':notice_id' => $notice_id,
        ':notice_date' => $notice_date,
        ':notice_time' => $notice_time,
        ':notice_subject' => $notice_subject,
        ':notice_content' => $notice_content
    ]);

    echo "Notice posted successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
