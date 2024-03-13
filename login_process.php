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
            $_SESSION['userType'] = $userType;
            $_SESSION['userID'] = $row['id'];
            $_SESSION['firstName'] = $row['first_name']; // Store first name
            $_SESSION['lastName'] = $row['last_name'];
            $_SESSION['role'] = $user['role'];
            // Store last name

            // Redirect user based on userType
            if ($userType == 'admin') {
                header("Location: index.html");
                exit;
            } else {
                header("Location: resident_dashboard.html");
                exit;
            }
        } else {
            $_SESSION['error'] = "Invalid email or password!";
        }
    } else {
        $_SESSION['error'] = "Invalid email or password!";
    }
} else {
    $_SESSION['error'] = "Invalid email or password!";
}

// Redirect back to the login form with error
header("Location: login.html");
exit;      
?>
