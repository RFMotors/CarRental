<?php
session_start();

require_once '../../config/DBconnect.php';
require_once '../../config/common.php';

$message = "";

if (isset($_POST['submit'])) {
    try {
        // Sanitize input
        $car = [
            "carID" => htmlspecialchars($_POST['carID']),
            "make" => htmlspecialchars($_POST['make']),
            "model" => htmlspecialchars($_POST['model']),
            "year" => htmlspecialchars($_POST['year']),
            "regNumber" => htmlspecialchars($_POST['regNumber']),
            "rentalPrice" => htmlspecialchars($_POST['rentalPrice']),
            "availabilityStatus" => htmlspecialchars($_POST['availabilityStatus']),
        ];

        // Update query
        $sql = "UPDATE cars 
                SET make = ?, model = ?, year = ?, regNumber = ?, rentalPrice = ?, availabilityStatus = ? 
                WHERE carID = ?";

        $statement = $conn->prepare($sql);
        $statement->bind_param(
            "ssisdsi",
            $car['make'],
            $car['model'],
            $car['year'],
            $car['regNumber'],
            $car['rentalPrice'],
            $car['availabilityStatus'],
            $car['carID']
        );
        $statement->execute();

        $message = "<p style='color: green; font-weight: bold;'>Car ID {$car['carID']} successfully updated.</p>";

    } catch (mysqli_sql_exception $e) {
        $message = "<p style='color: red;'>Error updating car: " . $e->getMessage() . "</p>";
    }
}

// Fetch car details
if (isset($_GET['id'])) {
    try {
        $carID = $_GET['id'];
        $sql = "SELECT * FROM cars WHERE carID = ?";
        $statement = $conn->prepare($sql);
        $statement->bind_param("i", $carID);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows === 0) {
            echo "Error: Car not found!";
            exit;
        }

        $car = $result->fetch_assoc();
    } catch (mysqli_sql_exception $e) {
        echo "Error fetching car details: " . $e->getMessage();
        exit;
    }
} else {
    echo "Error: Missing Car ID!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Car</title>
    <link rel="stylesheet" href="../../css/crud.css">
</head>
<body>

<?= $message; ?>

<h2>Edit Car ID: <?= htmlspecialchars($car["carID"]) ?></h2>

<form method="post">
    <input type="hidden" name="carID" value="<?= htmlspecialchars($car["carID"]) ?>">

    <label for="make">Make:</label>
    <input type="text" name="make" id="make" value="<?= htmlspecialchars($car["make"]) ?>" required><br>

    <label for="model">Model:</label>
    <input type="text" name="model" id="model" value="<?= htmlspecialchars($car["model"]) ?>" required><br>

    <label for="year">Year:</label>
    <input type="number" name="year" id="year" value="<?= htmlspecialchars($car["year"]) ?>" required><br>

    <label for="regNumber">Registration Number:</label>
    <input type="text" name="regNumber" id="regNumber" value="<?= htmlspecialchars($car["regNumber"]) ?>" required><br>

    <label for="rentalPrice">Price Per Day:</label>
    <input type="number" name="rentalPrice" id="rentalPrice" step="0.01"
           value="<?= htmlspecialchars($car["rentalPrice"]) ?>" required><br>

    <label for="availabilityStatus">Availability Status:</label>
    <select name="availabilityStatus" id="availabilityStatus" required>
        <option value="Available" <?= ($car["availabilityStatus"] === "Available") ? "selected" : "" ?>>Available</option>
        <option value="Rented" <?= ($car["availabilityStatus"] === "Rented") ? "selected" : "" ?>>Rented</option>
    </select><br>

    <input type="submit" name="submit" value="Submit">
</form>

<a href="read.php">Back to Car List</a>

</body>
</html>
