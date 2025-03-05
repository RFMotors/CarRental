<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "CarRentalDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully to the database!<br>";

$sql = "SELECT * FROM Car";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h3>Car Table Data:</h3>";
    while ($row = $result->fetch_assoc()) {
        echo "Car #{$row['id']}: {$row['Make']} {$row['Model']} ({$row['Year']}) - Engine: {$row['EngineType']} - Availability: {$row['AvailabilityStatus']}<br>";
    }
} else {
    echo "No records found in the Car table.";
}

$conn->close();
?>