<?php
// login_process.php
session_start();
include 'db_connect.php'; // Include your database connection file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Database query to check the user credentials
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            // Password is correct, start a new session
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['userType'] = $userType;

            // Redirect user based on userType
            if ($userType == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: resident_dashboard.php");
            }
        } else {
            // Password is not correct
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
} else {
    header("Location: login.html");
}
?>
