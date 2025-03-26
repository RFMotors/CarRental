<?php
/**
 * Use an HTML form to edit an entry in the Car table.
 */
require_once '../config/DBconnect.php';
require_once '../config/common.php';

$message = "";

if (isset($_POST['submit'])) {
    try {
        $car = [
            "CarID" => htmlspecialchars($_POST['CarID']),
            "Make" => htmlspecialchars($_POST['Make']),
            "Model" => htmlspecialchars($_POST['Model']),
            "Year" => htmlspecialchars($_POST['Year']),
            "RegNumber" => htmlspecialchars($_POST['RegNumber']),
            "PricePerDay" => htmlspecialchars($_POST['PricePerDay']),
            "AvailabilityStatus" => htmlspecialchars($_POST['AvailabilityStatus']),
        ];

        $sql = "UPDATE Car 
                SET Make = ?, Model = ?, Year = ?, RegNumber = ?, PricePerDay = ?, AvailabilityStatus = ? 
                WHERE CarID = ?";

        $statement = $conn->prepare($sql);
        $statement->bind_param("ssisdsi", $car['Make'], $car['Model'], $car['Year'],
            $car['RegNumber'], $car['PricePerDay'], $car['AvailabilityStatus'], $car['CarID']);
        $statement->execute();

        $message = "<p style='color: green; font-weight: bold;'>Car ID {$car['CarID']} successfully updated.</p>";

    } catch (mysqli_sql_exception $e) {
        $message = "<p style='color: red;'>Error updating car: " . $e->getMessage() . "</p>";
    }
}

if (isset($_GET['id'])) {
    try {
        $carID = $_GET['id'];
        $sql = "SELECT * FROM Car WHERE CarID = ?";
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

<?= $message; ?>

<h2>Edit Car ID: <?= htmlspecialchars($car["CarID"]) ?></h2>
<link rel="stylesheet" href="../css/crud.css">
<form method="post">
    <input type="hidden" name="CarID" value="<?= htmlspecialchars($car["CarID"]) ?>">

    <label for="Make">Make:</label>
    <input type="text" name="Make" id="Make" value="<?= htmlspecialchars($car["Make"]) ?>" required><br>

    <label for="Model">Model:</label>
    <input type="text" name="Model" id="Model" value="<?= htmlspecialchars($car["Model"]) ?>" required><br>

    <label for="Year">Year:</label>
    <input type="number" name="Year" id="Year" value="<?= htmlspecialchars($car["Year"]) ?>" required><br>

    <label for="RegNumber">Registration Number:</label>
    <input type="text" name="RegNumber" id="RegNumber" value="<?= htmlspecialchars($car["RegNumber"]) ?>" required><br>

    <label for="PricePerDay">Price Per Day:</label>
    <input type="number" name="PricePerDay" id="PricePerDay" step="0.01"
           value="<?= htmlspecialchars($car["PricePerDay"]) ?>" required><br>

    <label for="AvailabilityStatus">Availability Status:</label>
    <select name="AvailabilityStatus" id="AvailabilityStatus" required>
        <option value="Available" <?= ($car["AvailabilityStatus"] == "Available") ? "selected" : "" ?>>Available</option>
        <option value="Rented" <?= ($car["AvailabilityStatus"] == "Rented") ? "selected" : "" ?>>Rented</option>
    </select><br>

    <input type="submit" name="submit" value="Submit">
</form>

<a href="read.php">Back to Car List</a>

