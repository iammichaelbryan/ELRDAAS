<?php
// login_process.php
session_start();
include 'db_connect.php'; // Ensure this file sets up a PDO connection and assigns it to $conn

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND role = :userType");
    
    // Bind parameters
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':userType', $userType);

    // Execute the statement
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['userType'] = $userType;
            $_SESSION['userID'] = $row['id']; // Assuming you want to store the user's ID in session as well

            // Redirect user based on userType
            if ($userType == 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                header("Location: resident_dashboard.php");
                exit();
            }
        } else {
            // Password is not correct
            // It's a good security practice not to give away which part of the login credential is incorrect
            $error = "Invalid email or password!";
        }
    } else {
        // No user found with the entered email
        $error = "Invalid email or password!";
    }
} else {
    // Redirect back to the login form if not a POST request
    header("Location: login.html");
    exit();
}

// If there was an error, include the login form again and show the error message
$_SESSION['error'] = $error; // Use session to pass the error message
header("Location: login.html");
exit();
?>
