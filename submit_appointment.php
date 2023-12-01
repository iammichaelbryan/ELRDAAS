<?php

$host = 'localhost';
$username = "root";
$password = "";
$dbname = 'elrdaas';

$subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING);
$content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_STRING);
$currentTime = date('Y-m-d');
$currentDate = date('H:i:s');

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO notices (notice_date, notice_time, notice_subject, notice_content)
            VALUES (:date, :time, :subject, :content)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':date' => $currentTime,
        ':time' => $currentDate,
        ':subject' => $subject,
        ':content' => $content
    ]);

    echo "Record Saved Successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Fetch data from the database (assuming you have a function to fetch appointments)
// Replace this with your actual logic to fetch data from the database.
$data = [
    ['Random Joe', '2023-12-01', '10:00 AM', 'Washing and drying'],
    // Add more data as needed
];

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
