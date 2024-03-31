<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_SESSION['userID'])) {
        $res_id = $_SESSION['userID'];
    
        // Prepare SQL statement to delete admin account
        $sql = "DELETE FROM residents WHERE id = :res_id"; // Assuming 'id' is the primary key of admins table
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':res_id', $res_id, PDO::PARAM_INT);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Account deleted successfully
            echo json_encode(['success' => 'Resident account deleted successfully']);
        } else {
            // Error deleting account
            echo json_encode(['error' => 'Error deleting resident account']);
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
