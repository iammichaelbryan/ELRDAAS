<?php
session_start();
include 'db_connect.php'; // Include your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $tower = $_POST['tower'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // For admin, insert into the admins table
    $stmt = $conn->prepare("INSERT INTO admins (first_name, last_name, email, password, tower) VALUES (:firstName, :lastName, :email, :hashedPassword, :tower)");

    // Bind parameters
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':hashedPassword', $hashedPassword);
    $stmt->bindParam(':tower', $tower);

    // Execute the statement
    if ($stmt->execute()) {
        // Set session variables
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['tower'] = $tower;

        // Retrieve and store the user ID in the session
        $_SESSION['userId'] = $conn->lastInsertId();

        echo "Registration successful!";
        header('Location: admin_login.html');
        exit;
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    $stmt = null;
    $conn = null;
}
?>
