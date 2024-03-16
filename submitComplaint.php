<?php
session_start();
include 'db_connect.php'; // Ensure this file establishes a PDO connection to your database.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate a unique complaint ID
    $complaint_id = 'C-' . time() . '-' . rand(1000, 9999);

    // Retrieve resident details from the session
    $resident_id = $_SESSION['userID'] ?? null;
    $first_name = $_SESSION['firstName'] ?? null;
    $last_name = $_SESSION['lastName'] ?? null;
    $tower = $_SESSION['tower'] ?? null; // Retrieve tower from session

    // If tower is not set in the session, fetch it from the database
    if (!$tower && $resident_id) {
        $stmt = $conn->prepare("SELECT tower FROM residents WHERE id = :resident_id");
        $stmt->execute([':resident_id' => $resident_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $tower = $result['tower'] ?? ''; // Default to empty if not found
    }

    $complaint_type = $_POST['complaint_type'] ?? '';
    $complaint_body = $_POST['complaint_body'] ?? '';
    $date_submitted = date('Y-m-d H:i:s'); // Current date and time
    $status = 'Pending Assignment'; // Default status
    $priority = 'Medium'; // Default priority
    $assigned_to = ''; // Initially not assigned

    if (!$resident_id) {
        echo "You must be logged in to submit a complaint.";
        exit;
    }

    if (empty($complaint_type) || empty($complaint_body)) {
        echo "Complaint type and body are required.";
        exit;
    }

    try {
        $stmt = $conn->prepare("INSERT INTO complaints (complaint_id, resident_id, first_name, last_name, complaint_type, complaint_body, date_submitted, status, priority, assigned_to, tower) VALUES (:complaint_id, :resident_id, :first_name, :last_name, :complaint_type, :complaint_body, :date_submitted, :status, :priority, :assigned_to, :tower)");

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

        if ($stmt->execute()) {
            header('Location: request-submitted.html');
            exit;
        } else {
            echo "Error: Submission failed.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $stmt = null;
    $conn = null;
} else {
    echo "Invalid request method.";
}
?>
