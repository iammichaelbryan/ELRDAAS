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

    if ($role === 'admin') {
        // For admin, insert into the admins table
        $stmt = $conn->prepare("INSERT INTO admins (first_name, last_name, email, password) VALUES (:firstName, :lastName, :email, :hashedPassword)");
    } else {
        // For residents, also include room and tower
        $room = $_POST['room'];
        $tower = $_POST['tower'];
        $stmt = $conn->prepare("INSERT INTO residents (first_name, last_name, email, password, room, tower) VALUES (:firstName, :lastName, :email, :hashedPassword, :room, :tower)");

        // Bind room and tower parameters
        $stmt->bindParam(':room', $room);
        $stmt->bindParam(':tower', $tower);
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
        $errorInfo = $stmt->errorInfo();
        echo "Error: " . $errorInfo[2];
    }

    // Close the statement
    $stmt = null;
}
?>
