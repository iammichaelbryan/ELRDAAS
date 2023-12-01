<?php

class User {

    private $fname;
    private $lname;
    private $email;
    private $role;

    public function __construct($fname, $lname, $email, $role) {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->role = $role;
    }

    public function getFname() {
        return $this->fname;
    }

    public function setFname($fname) {
        $this->fname = $fname;
    }

    public function getLname() {
        return $this->lname;
    }

    public function setLname($lname) {
        $this->lname = $lname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }
}
$host = 'localhost';
$username = 'admin';
$password = 'Midnighto!l';
$dbname = 'eldraas'; 

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$fname = '';
$lname = '';
$email = '';
$role = '';
