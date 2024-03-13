<?php
session_start();
include 'db_connect.php'; // Ensure this file establishes a PDO connection to your database.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate a unique complaint ID
    $complaint_id = 'C-' . time() . '-' . rand(1000, 9999);
    
    // Retrieve resident details from the session
    $resident_id = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
    $first_name = isset($_SESSION['firstName']) ? $_SESSION['firstName'] : null;
    $last_name = isset($_SESSION['lastName']) ? $_SESSION['lastName'] : null;
    $tower = isset($_SESSION['tower']) ? $_SESSION['tower'] : null;
    
    $complaint_type = $_POST['complaint_type'];
    $complaint_body = filter_input(INPUT_POST, 'complaint_body', FILTER_SANITIZE_STRING);
    $date_submitted = date('Y-m-d H:i:s'); // Current date and time
    $status = 'Pending Assignment'; // Default status
    $priority = 'Medium'; // Default priority
    $assigned_to = ''; // Initially not assigned

    try {
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
            header('Location: request-submitted.html'); // Redirect to a confirmation page
            exit;
        } else {
            echo "Error: Submission failed.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close connection
    $stmt = null;
    $conn = null;
} else {
    // Redirect or inform the user appropriately if the method is not POST
    echo "Invalid request method.";
}
?>
