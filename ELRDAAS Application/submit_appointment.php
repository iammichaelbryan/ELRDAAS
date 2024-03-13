<?php

$host = 'localhost';
$username = "root";
$password = "";
$dbname = 'elrdaas';

// Assuming these fields are provided in the form submission
$residentFirstName = filter_input(INPUT_POST, "residentFirstName", FILTER_SANITIZE_STRING);
$residentLastName = filter_input(INPUT_POST, "residentLastName", FILTER_SANITIZE_STRING);
$appointmentDate = filter_input(INPUT_POST, "appointmentDate", FILTER_SANITIZE_STRING); // YYYY-MM-DD for the appointment date
$createdDate = date("Y-m-d"); // Assuming the current date as the created date
$appointmentTime = filter_input(INPUT_POST, "appointmentTime", FILTER_SANITIZE_STRING); // HH:MM
$service = filter_input(INPUT_POST, "service", FILTER_SANITIZE_STRING);
$loads = filter_input(INPUT_POST, "loads", FILTER_SANITIZE_NUMBER_INT);

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO appointments (resident_first_name, resident_last_name, created_date, appointment_date, appointment_time, service, loads)
            VALUES (:residentFirstName, :residentLastName, :createdDate, :appointmentDate, :appointmentTime, :service, :loads)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':residentFirstName' => $residentFirstName,
        ':residentLastName' => $residentLastName,
        ':createdDate' => $createdDate,
        ':appointmentDate' => $appointmentDate,
        ':appointmentTime' => $appointmentTime,
        ':service' => $service,
        ':loads' => $loads
    ]);

    // Redirect to app_submitted.html
    header("Location: app_submitted.html");
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
