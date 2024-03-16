<?php
include 'db_connect.php';

// Get the current date and time
$today = date('Y-m-d');
$currentTime = date('H:i:s');

try {
    // Select pending notices up to the current time
    $sql = "SELECT * FROM scheduled_notices WHERE execute_date <= :today AND execute_time <= :currentTime AND status = 'Pending'";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':today' => $today, ':currentTime' => $currentTime]);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Insert the notice into the 'notices' table
        $insertSql = "INSERT INTO notices (notice_id, notice_date, notice_time, notice_subject, notice_content) VALUES (:notice_id, :execute_date, :execute_time, :notice_subject, :notice_content)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->execute([
            ':notice_id' => $row['notice_id'],
            ':execute_date' => $row['execute_date'],
            ':execute_time' => $row['execute_time'],
            ':notice_subject' => $row['notice_subject'],
            ':notice_content' => $row['notice_content']
        ]);

        // Update the scheduled notice status to 'Executed'
        $updateSql = "UPDATE scheduled_notices SET status = 'Executed' WHERE id = :id";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->execute([':id' => $row['id']]);
    }
    
    echo "Scheduled notices processed successfully.";
} catch (PDOException $e) {
    echo "Error processing scheduled notices: " . $e->getMessage();
}
?>
