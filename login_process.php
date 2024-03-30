<?php
// login_process.php
session_start();

// It's good practice to report all errors except notices during development
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);

include 'db_connect.php'; // Ensure this file sets up a PDO connection and assigns it to $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    $table = ($userType == 'admin') ? 'admins' : 'residents';
    $stmt = $conn->prepare("SELECT * FROM {$table} WHERE email = :email");

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
            $_SESSION['role'] = ($userType == 'admin') ? 'Admin' : 'Resident';

            /*
            // Debug: Check the session values before redirecting
            echo "<pre>Session Variables:";
            print_r($_SESSION);
            echo "</pre>";
            exit; // Remove or comment out after debugging
            */

            // Redirect user based on userType
            $redirectPage = ($userType == 'admin') ? 'index.php' : 'resident_dashboard.php';
            header("Location: $redirectPage");
            exit;
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
