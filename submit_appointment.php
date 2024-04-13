<?php
session_start();
include 'db_connect.php'; // Ensure this file establishes a PDO connection to your database.
function isTimeSlotAvailable($date, $time) {
    include 'db_connect.php'; // Connection script

    // Query to count the number of appointments for the specific time slot
    $sql = "SELECT COUNT(*) AS appointment_count FROM appointments WHERE appointment_date = :date AND appointment_time = :time";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':date' => $date, ':time' => $time]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['appointment_count'] < 3; // Assuming a limit of 3 appointments per slot
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isTimeSlotAvailable($appointmentDate, $appointmentTime)) {
    $residentFirstName = filter_input(INPUT_POST, "residentFirstName", FILTER_SANITIZE_STRING);
    $residentLastName = filter_input(INPUT_POST, "residentLastName", FILTER_SANITIZE_STRING);
    $appointmentDate = filter_input(INPUT_POST, "appointmentDate", FILTER_SANITIZE_STRING);
    $appointmentTime = filter_input(INPUT_POST, "appointmentTime", FILTER_SANITIZE_STRING);
    $service = filter_input(INPUT_POST, "service", FILTER_SANITIZE_STRING);
    $loads = filter_input(INPUT_POST, "loads", FILTER_SANITIZE_NUMBER_INT);
    $resident_id = $_SESSION['userID'] ?? null;
// Use the name attribute `calculatedCost` not `appointmentCost`
$cost = filter_input(INPUT_POST, "calculatedCost", FILTER_SANITIZE_NUMBER_INT);

    // Generate a unique appointment ID
    $appointment_id = 'A-' . time() . '-' . rand(1000, 9999);

    // Assuming status needs to be set as 'Confirmed' by default
    $status = 'Confirmed';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO appointments (appointment_id, status, resident_first_name, resident_last_name, resident_id, appointment_date, appointment_time, service, loads, cost) VALUES (:appointment_id, :status, :residentFirstName, :residentLastName,:resident_id, :appointmentDate, :appointmentTime, :service, :loads, :cost)";

        $stmt = $conn->prepare($sql); 

        $stmt->execute([
            ':appointment_id' => $appointment_id,
            ':status' => $status,
            ':residentFirstName' => $residentFirstName,
            ':residentLastName' => $residentLastName,
            ':resident_id' => $resident_id,
            ':appointmentDate' => $appointmentDate,
            ':appointmentTime' => $appointmentTime,
            ':service' => $service,
            ':loads' => $loads,
            ':cost' => $cost

        ]);
        $notification_message = "Your appointment has been scheduled successfully for $appointmentDate at $appointmentTime. Appointment ID: $appointment_id";
        $stmt = $conn->prepare("INSERT INTO notifications (user_id, notification_type, notification_id, message, status) VALUES (:user_id, 'Appointment', :notification_id, :message, 'Unread')");
        $stmt->execute([':user_id' => $resident_id, ':notification_id' => $appointment_id, ':message' => $notification_message]);

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
