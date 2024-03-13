<?php

$host = 'localhost';
$username = "root";
$password = "";
$dbname = 'elrdaas';

// Create connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Check connection
if ($conn) {
    echo "Connected successfully";
} else {
    echo "Connection failed: " . $conn->error;
}
?>
