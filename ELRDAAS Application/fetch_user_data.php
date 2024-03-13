<?php
session_start();

//The database connection file
include 'db_connect.php';

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $email = $_SESSION['email']; // Assuming email is stored in session

    // Query to fetch user data
    $sql = $conn->prepare("SELECT first_name, last_name FROM users WHERE email = :email");
    $sql->bindParam(':email', $email);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        // Return user data as JSON
        echo json_encode([
            'firstName' => $user['first_name'],
            'lastName' => $user['last_name'],
            'email' => $email
        ]);
    } else {
        // User not found
        echo json_encode(['error' => 'User not found']);
    }
} else {
    // Not logged in
    echo json_encode(['error' => 'User not authenticated']);
}

// Close connection
$conn = null;
?>
