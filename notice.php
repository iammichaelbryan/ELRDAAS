<?php

class Notice {
    private $content;
    private $date;
    private $time;
    private $noticeType;
    private $noticeLocation;
    private $author;

    public function __construct($content, $date, $time, $noticeType, $noticeLocation, $author) {
        $this->content = $content;
        $this->date = $date;
        $this->time = $time;
        $this->noticeType = $noticeType;
        $this->noticeLocation = $noticeLocation;
        $this->author = $author;
    }

    // You can add getters if needed
    public function getContent() {
        return $this->content;
    }

    public function getDate() {
        return $this->date;
    }

    public function getTime() {
        return $this->time;
    }

    public function getNoticeType() {
        return $this->noticeType;
    }

    public function getNoticeLocation() {
        return $this->noticeLocation;
    }

    public function getAuthor() {
        return $this->author;
    }
} 

$host = 'localhost';
$username = 'admin';
$password = 'Midnighto!l';
$dbname = 'elraas'; 

$subject = $_POST[name];
$content = $_POST[content];

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$stmt = $conn->prepare("INSERT INTO notices (notice_subject, notice_content) VALUES (:subject, :content)");

$stmt->bindParam(':subject', $subject);
$stmt->bindParam(':content', $content);

$stmt->execute();
?> 


