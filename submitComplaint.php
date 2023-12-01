<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connect.php'; // Your database connection file


$requestID = $_POST['requestID'];


/*
    $issueType = $_POST['issueType'] ?? ''; // Null coalescing operator to avoid undefined index notice
    $requestDetails = $_POST['requestDetails'] ?? ''; // Null coalescing operator to avoid undefined index notice

    // Generate a unique ID, for example, using current timestamp
    $complaintId = "DC-" . time();

    // Randomly assign an admin (Example: fetch from a list of admins in the database)
    $assignedAdmin = "Admin-" . rand(1, 10);

    // Insert the complaint into the database
    $sql = "INSERT INTO complaints (complaint_id, complaint_type, complaint_body, assigned_to) VALUES ('$complaintId', '$issueType', '$requestDetails', '$assignedAdmin')";
    */
// After successful insertion
if ($conn->query($sql) === TRUE) {
    // Instead of echoing the success message, redirect to the 'request-submitted.html' page
    header('Location: request-submitted.html');
    exit;
} else {
    // Handle the error case as needed
    echo "Error: " . $sql . "<br>" . $conn->error;
}


    $conn->close();
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
