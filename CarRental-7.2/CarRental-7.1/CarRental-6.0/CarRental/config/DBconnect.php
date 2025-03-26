<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";
$port = 3306;

//Secure Database Connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

//Check Connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

//Set Charset to UTF-8 for Security & Compatibility
$conn->set_charset("utf8mb4");
?>
