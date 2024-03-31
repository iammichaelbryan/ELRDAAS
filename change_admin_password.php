<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.html");
    exit;
}

// Include database connection
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];
    $userID = $_SESSION['userID']; // Get user ID from session

    // Retrieve user's current password from the database
    $stmt = $conn->prepare("SELECT password FROM admins WHERE id = :userID");
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $storedPassword = $row['password'];

    // Verify if the current password matches the one stored in the database
    if (password_verify($currentPassword, $storedPassword)) {
        // Check if the new passwords match
        if ($newPassword === $confirmNewPassword) {
            // Hash the new password before storing it in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $updateStmt = $conn->prepare("UPDATE admins SET password = :password WHERE id = :userID");
            $updateStmt->bindParam(':password', $hashedPassword);
            $updateStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $updateStmt->execute();

            // Check if the password was updated successfully
            if ($updateStmt->rowCount() > 0) {
                echo json_encode(['success' => 'Password updated successfully']);
                header("Location: login.html"); // Redirect to login page
                exit;
            } else {
                echo json_encode(['error' => 'Error updating password']);
                exit;
            }
        } else {
            echo json_encode(['error' => 'New passwords do not match']);
            exit;
        }
    } else {
        echo json_encode(['error' => 'Incorrect current password']);
        exit;
    }
} else {
    // If the request method is not POST, redirect to the login form.
    header("Location: login.html");
    exit;
}
?>
