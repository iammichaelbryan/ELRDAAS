<?php
session_start();
include 'db_connect.php'; // Ensure this is the path to your DB connection script

// Check if the user is logged in and has a resident ID
if (isset($_SESSION['loggedin'])) {
    $first_name = $_SESSION['firstName'];

    // Output the results as JSON
    echo json_encode($first_name);
} 
else {
    echo json_encode(array('error' => 'User not logged in or ID not found'));
}