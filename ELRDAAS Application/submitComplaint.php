<?php
session_start();
include 'db_connect.php'; // Make sure this file has the PDO connection to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate a unique complaint ID
    $complaint_id = 'C-' . time() . '-' . rand(1000, 9999);
    // Retrieve resident details from the session
    $resident_id = $_SESSION['userId'];
    $first_name = $_SESSION['firstName'];
    $last_name = $_SESSION['lastName'];
    $tower = $_SESSION['tower'];
    
    $complaint_type = $_POST['complaint_type'];
    $complaint_body = filter_input(INPUT_POST, 'complaint_body', FILTER_SANITIZE_STRING);
    $date_submitted = date('Y-m-d H:i:s'); // Current date and time
    $status = 'Pending Assignment'; // Default status
    $priority = 'Medium'; // Default priority
    $assigned_to = ''; // Not assigned yet

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO complaints (complaint_id, resident_id, first_name, last_name, complaint_type, complaint_body, date_submitted, status, priority, assigned_to, tower) VALUES (:complaint_id, :resident_id, :first_name, :last_name, :complaint_type, :complaint_body, :date_submitted, :status, :priority, :assigned_to, :tower)");

    // Bind parameters
    $stmt->bindParam(':complaint_id', $complaint_id);
    $stmt->bindParam(':resident_id', $resident_id);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':complaint_type', $complaint_type);
    $stmt->bindParam(':complaint_body', $complaint_body);
    $stmt->bindParam(':date_submitted', $date_submitted);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':priority', $priority);
    $stmt->bindParam(':assigned_to', $assigned_to);
    $stmt->bindParam(':tower', $tower);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Submission successful!";
        header('Location: request-submitted.html');
        exit;
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
    $stmt = null;
    $conn = null;
}
?>
