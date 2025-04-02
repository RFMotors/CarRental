<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../classes/Client.php';
require_once '../classes/Car.php';
require_once '../config/DBconnect.php';

use classes\Client;
use classes\Car;

$client = new Client();
$client->setUserID($_SESSION['userID']);

$carObj = new Car($conn);
$availableCars = $carObj->getAllCars();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $carID = $_POST['carID'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $carDetails = $carObj->getCarDetails($carID);
    $rentalPrice = $carDetails['rentalPrice'];

    $totalCost = $client->calculateTotalCost($startDate, $endDate, $rentalPrice);

    if ($client->bookCar($carID, $startDate, $endDate, $totalCost)) {
        // ✅ Redirect immediately to payment page
        header("Location: processPayment.php?bookingID=" . urlencode($conn->insert_id));
        exit();
    } else {
        echo "Failed to book car.";
    }
}
?>

<h2>Book a Car</h2>

<form method="POST">
    <label>Select Available Car:</label><br>
    <select name="carID" required>
        <?php foreach ($availableCars as $car): ?>
            <option value="<?= htmlspecialchars($car['carID']) ?>">
                <?= htmlspecialchars($car['make']) ?> <?= htmlspecialchars($car['model']) ?>
                (Year: <?= htmlspecialchars($car['year']) ?>) - $<?= htmlspecialchars($car['rentalPrice']) ?>/day
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Start Date:</label><br>
    <input type="date" name="startDate" required><br><br>

    <label>End Date:</label><br>
    <input type="date" name="endDate" required><br><br>

    <button type="submit">Book Car</button>
</form>
