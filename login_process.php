<?php
// login_process.php
session_start();
include 'db_connect.php'; // Ensure this file sets up a PDO connection and assigns it to $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    if ($userType == 'admin') {
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
    } else {
        $stmt = $conn->prepare("SELECT * FROM residents WHERE email = :email");
    }

    // Bind parameters
    $stmt->bindParam(':email', $email);

    // Execute the statement
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $row['email']; // Use the email from the database
            $_SESSION['userID'] = $row['id'];
            $_SESSION['firstName'] = $row['first_name']; // Store first name
            $_SESSION['lastName'] = $row['last_name']; // Store last name

            // Role should be determined by the table from which the user is fetched
            $_SESSION['role'] = ($userType == 'admin') ? 'Admin' : 'Resident';

            // Redirect user based on userType
            if ($userType == 'admin') {
                header("Location: index.php"); // Change to your admin dashboard page
                exit;
            } else {
                header("Location: resident_dashboard.php"); // Change to your resident dashboard page
                exit;
            }
        } else {
            $_SESSION['error'] = "Invalid email or password!";
            header("Location: login.html"); // Redirect back to the login page with error
            exit;
        }
    } else {
        $_SESSION['error'] = "Invalid email or password!";
        header("Location: login.html"); // Redirect back to the login page with error
        exit;
    }
} else {
    // If the request method is not POST, redirect to the login form.
    header("Location: login.html");
    exit;
}
?>
