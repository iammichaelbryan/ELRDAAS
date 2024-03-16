<?php
session_start();
include 'db_connect.php'; // Ensure this file establishes a PDO connection to your database.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $residentFirstName = filter_input(INPUT_POST, "residentFirstName", FILTER_SANITIZE_STRING);
    $residentLastName = filter_input(INPUT_POST, "residentLastName", FILTER_SANITIZE_STRING);
    $appointmentDate = filter_input(INPUT_POST, "appointmentDate", FILTER_SANITIZE_STRING);
    $appointmentTime = filter_input(INPUT_POST, "appointmentTime", FILTER_SANITIZE_STRING);
    $service = filter_input(INPUT_POST, "service", FILTER_SANITIZE_STRING);
    $loads = filter_input(INPUT_POST, "loads", FILTER_SANITIZE_NUMBER_INT);

    // Generate a unique appointment ID
    $appointment_id = 'A-' . time() . '-' . rand(1000, 9999);

    // Assuming status needs to be set as 'Confirmed' by default
    $status = 'Confirmed';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO appointments (appointment_id, status, resident_first_name, resident_last_name, appointment_date, appointment_time, service, loads) VALUES (:appointment_id, :status, :residentFirstName, :residentLastName, :appointmentDate, :appointmentTime, :service, :loads)";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':appointment_id' => $appointment_id,
            ':status' => $status,
            ':residentFirstName' => $residentFirstName,
            ':residentLastName' => $residentLastName,
            ':appointmentDate' => $appointmentDate,
            ':appointmentTime' => $appointmentTime,
            ':service' => $service,
            ':loads' => $loads
        ]);

        header("Location: app_submitted.html"); // Redirect to a confirmation page
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $stmt = null;
        $conn = null;
    }
} else {
    echo "Invalid request method.";
}
?>
