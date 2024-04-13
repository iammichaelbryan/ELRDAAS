<?php
#session_start();
include 'db_connect.php'; // Ensure this is the path to your DB connection script

// Check if the user is logged in and has a resident ID
if (isset($_SESSION['loggedin'])) {
    $first_name = $_SESSION['firstName'];
    $last_name = $_SESSION['lastName'];
    $email = $_SESSION['email'];
    $user_id = $_SESSION['userID'];

    // Output the results as JSON
    #echo json_encode(['firstName' => $first_name, 'lastName' => $last_name, 'email' => $email]);
} 
else {
    echo json_encode(array('error' => 'User not logged in or ID not found'));
}
?>
