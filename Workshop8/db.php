<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'school_db';
$port = 3306;

$conn = mysqli_connect($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>
