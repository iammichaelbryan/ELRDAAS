<?php
include 'db_connect.php'; // Include your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($role === 'Admin') {
        // For admin, insert into the admins table
        $stmt = $conn->prepare("INSERT INTO admins (first_name, last_name, email, password) VALUES (:firstName, :lastName, :email, :hashedPassword)");
    } else {
        // For residents, insert into the residents table
        $stmt = $conn->prepare("INSERT INTO residents (first_name, last_name, email, password) VALUES (:firstName, :lastName, :email, :hashedPassword)");
    }

    // Bind common parameters
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':hashedPassword', $hashedPassword);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    $stmt = null;
    $conn = null;
}
?>
