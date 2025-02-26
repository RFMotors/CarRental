<?php
// 1. Database credentials (adjust as needed)
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "CarRentalDB";

// 2. Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// 3. Check the connection for errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If no error, let’s confirm we’re connected
echo "Connected successfully to the database!<br>";

// 4. Run a query to retrieve data from the `Car` table
$sql = "SELECT * FROM Car";
$result = $conn->query($sql);

// 5. Check if any rows are returned and display them
if ($result->num_rows > 0) {
    echo "<h3>Car Table Data:</h3>";
    while ($row = $result->fetch_assoc()) {
        echo "Car #{$row['id']}: {$row['Make']} {$row['Model']} ({$row['Year']}) - Engine: {$row['EngineType']} - Availability: {$row['AvailabilityStatus']}<br>";
    }
} else {
    echo "No records found in the Car table.";
}

// 6. Close the connection
$conn->close();
?>
