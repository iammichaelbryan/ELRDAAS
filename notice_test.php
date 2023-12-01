<?php 

$host = 'localhost';
$username = "root";
$password = "";
$dbname = 'elrdaas'; 

$subject=filter_input(INPUT_POST, "subject", FILTER_SANITIZE_STRING);
$content=filter_input(INPUT_POST, "content", FILTER_SANITIZE_STRING);
$currentTime=date('d-m-Y');
$currentDate=date('h:i:sa');

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$sql="INSERT INTO notices (notice_date, notice_time, notice_subject, notice_content)
        VALUES (:date, :time, :subject, :content)";

$stmt= $conn->prepare($sql);

$stmt->execute([
	':date' => $currentTime,
    ':time' => $currentDate,
    ':subject' => $subject,
    ':content' => $content
]);

echo "Record Saved Successfully."

?>