<?php
session_start();
include 'db_connect.php';

try {
    // This query selects all columns from notices and joins the admin's first and last name
    // using a LEFT JOIN to ensure all notices are included even if the admin_id is incorrect or missing
    $sql = "SELECT notices.*, admins.first_name, admins.last_name 
            FROM notices 
            LEFT JOIN admins ON notices.admin_id = admins.id 
            ORDER BY notices.notice_date DESC, notices.notice_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $notices = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($notices);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>