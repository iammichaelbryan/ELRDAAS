<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_SESSION['userID'])) {
        $admin_id = $_SESSION['userID'];
    
        // Prepare SQL statement to delete admin account
        $sql = "DELETE FROM admins WHERE id = :admin_id"; // Assuming 'id' is the primary key of admins table
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Account deleted successfully
            echo json_encode(['success' => 'Admin account deleted successfully']);
        } else {
            // Error deleting account
            echo json_encode(['error' => 'Error deleting admin account']);
        }
    } else {
        // User not logged in
        echo json_encode(['error' => 'User not logged in']);
    }
} else {
    // Invalid request method
    echo json_encode(['error' => 'Invalid request method']);
}
?>
