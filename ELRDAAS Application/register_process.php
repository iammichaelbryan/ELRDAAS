<?php
session_start();
include 'db_connect.php'; // Include your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $tower = $_POST['tower']; // Make sure to have 'tower' input in your registration form for residents

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($role === 'Admin') {
        // For admin, insert into the admins table
        $stmt = $conn->prepare("INSERT INTO admins (first_name, last_name, email, password) VALUES (:firstName, :lastName, :email, :hashedPassword)");
    } else {
        // For residents, insert into the residents table, including tower
        $stmt = $conn->prepare("INSERT INTO residents (first_name, last_name, email, password, tower) VALUES (:firstName, :lastName, :email, :hashedPassword, :tower)");
        $stmt->bindParam(':tower', $tower); // Bind the tower parameter
    }

    // Bind common parameters
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':hashedPassword', $hashedPassword);

    // Execute the statement
    if ($stmt->execute()) {
        // If a resident is being registered, set their tower in the session
        if ($role === 'Resident') {
            $_SESSION['tower'] = $tower;
        }

        // Set other session variables
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role; // It might be useful to have the user's role in the session

        // Retrieve and store the user ID in the session
        $_SESSION['userId'] = $conn->lastInsertId();

        echo "Registration successful!";
        header('Location: login.html');
        exit;
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    $stmt = null;
    $conn = null;
}
?>
