<?php
$host   = 'localhost';
$port   = 3307;
$dbName = 'CarRentalDB';
$user   = 'root';
$pass   = '';
$conn = mysqli_connect($host, $user, $pass, $dbName, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Make               = $_POST['Make'];
    $Model              = $_POST['Model'];
    $Year               = $_POST['Year'];
    $RegNumber          = $_POST['RegNumber'];
    $PricePerDay        = $_POST['PricePerDay'];
    $EngineType         = $_POST['EngineType'];
    $AvailabilityStatus = $_POST['AvailabilityStatus'];
    $sql  = "INSERT INTO Car (Make, Model, Year, RegNumber, PricePerDay, EngineType, AvailabilityStatus)
             VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "ssssdss",
        $Make,
        $Model,
        $Year,
        $RegNumber,
        $PricePerDay,
        $EngineType,
        $AvailabilityStatus
    );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: read.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Car</title>
    <style>
        form {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="date"], input[type="number"] {
            width: 100%;
        }
    </style>
</head>
<body>
<h2 style="text-align:center;">Create New Car</h2>
<form method="POST" action="create.php">
    <label>Make:</label>
    <input type="text" name="Make" required>
    <label>Model:</label>
    <input type="text" name="Model" required>
    <label>Year (YYYY-MM-DD):</label>
    <input type="date" name="Year" required>
    <label>RegNumber:</label>
    <input type="text" name="RegNumber" required>
    <label>PricePerDay:</label>
    <input type="number" step="0.01" name="PricePerDay" required>
    <label>EngineType:</label>
    <input type="text" name="EngineType" required>
    <label>AvailabilityStatus:</label>
    <input type="text" name="AvailabilityStatus" required>
    <br><br>
    <button type="submit">Create Car</button>
</form>
<p style="text-align:center;">
    <a href="read.php">Go Back to Car List</a>
</p>
</body>
</html>
