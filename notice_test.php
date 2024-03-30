<?php
session_start();
include 'db_connect.php';

// Sanitize and fetch input for subject and content
$notice_subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
$notice_content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$admin_id = $_SESSION['userID'] ?? null;
$first_name = $_SESSION['firstName'] ?? null;
$last_name = $_SESSION['lastName'] ?? null;

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
    $sql = "INSERT INTO notices (admin_id, notice_id, notice_date, notice_time, notice_subject, notice_content, first_name,last_name) VALUES (:admin_id, :notice_id, :notice_date, :notice_time, :notice_subject, :notice_content, :first_name, :last_name)";
    $stmt = $conn->prepare($sql);
    
    // Execute SQL statement with bound parameters
    $stmt->execute([
        ':admin_id' => $admin_id,
        ':notice_id' => $notice_id,
        ':notice_date' => $notice_date,
        ':notice_time' => $notice_time,
        ':notice_subject' => $notice_subject,
        ':notice_content' => $notice_content,
        ':first_name' => $first_name,
        ':last_name' => $last_name
    ]);

    // Redirect to the notice submitted page
    header("Location: notice_posted.html");
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
