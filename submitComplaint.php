<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connect.php'; // Your database connection file

    // Input validation and sanitization here (very important)

    $complaintId = $_POST['complaintID']; // Unique ID generation
    $complaintType = $_POST['complaintType'] ?? '';
    $complaintBody = $_POST['complaintBody'] ?? '';
    $assignedTo = $_POST['assignedTo'] ?? ''; // This should probably be set by the application, not the user
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    
    // Bind parameters and execute
    $stmt->bind_param("ssssss", $complaintId, $first_name, $last_name, $complaintType, $complaintBody, $assignedTo);
    

    if ($stmt->execute()) {
        // Redirect to the 'request-submitted.html' page
        header('Location: request-submitted.html');
        exit;
    } else {
        // Handle the error case as needed
        // Log the error, don't display it
    }

    $stmt->null;
} else {
    // If not a POST request, redirect to the form or handle accordingly
    header('Location: make_request.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Submitted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .message {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f3f3f3;
        }
        .button {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message">
        <h1>Request Submitted Successfully!</h1>
        <p>Your request has been submitted. We will process it as soon as possible.</p>
        <!-- Provide options for the user -->
        <a href="make_requests.html" class="button">Submit Another Request</a>
        <a href="resident_dashboard.html" class="button">General Notice Board</a>
        <a href="logout_res.html" class="button">Logout</a>
    </div>
</body>
</html>
