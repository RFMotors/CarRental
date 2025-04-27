<?php
require_once '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Client.php';
require_once '../classes/Car.php';

use classes\Client;
use classes\Car;

if (!isset($_SESSION['UserID'])) {
    echo "<p>You must be logged in to access the payment page.</p>";
    exit;
}

$client = new Client($pdo, $_SESSION['UserID']);
$carObj = new Car($pdo);
$message = "";

// Booking Draft Check
if (!isset($_SESSION['bookingDraft'])) {
    echo "<p>No booking information found. Please select a car first.</p>";
    exit;
}

$carID = $_SESSION['bookingDraft']['carID'];
$startDate = $_SESSION['bookingDraft']['startDate'];
$endDate = $_SESSION['bookingDraft']['endDate'];
$totalCost = $_SESSION['bookingDraft']['totalCost'];
$days = $_SESSION['bookingDraft']['days'];

$car = $carObj->getCarById($carID);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($client->bookCar($carID, $startDate, $endDate, $totalCost)) {
        $bookingID = $client->getLastBookingIDForUser($_SESSION['UserID']);
        if ($client->makePayment($bookingID, $totalCost)) {
            $carObj->updateAvailability($carID, 1); // Car set to Rented
            $message = "Payment successful! Your booking is confirmed.";
            unset($_SESSION['bookingDraft']);
        } else {
            $message = "Payment failed. Please try again.";
        }
    } else {
        $message = "Booking could not be created.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Page</title>
    <link rel="stylesheet" href="../css/lib.css">
</head>
<body>

<main class="checkout-container">
    <h2>Order Summary</h2>

    <?php if (!empty($car)): ?>
        <div class="order-summary">
            <p><strong>Car:</strong> <?= htmlspecialchars($car['make']) ?> <?= htmlspecialchars($car['model']) ?></p>
            <p><strong>Rental Period:</strong> <?= htmlspecialchars($startDate) ?> ➔ <?= htmlspecialchars($endDate) ?> (<?= $days ?> days)</p>
            <p><strong>Price per Day:</strong> €<?= number_format($car['rentalPrice'], 2) ?></p>
            <p class="total"><strong>Total Cost:</strong> €<?= number_format($totalCost, 2) ?></p>
        </div>
    <?php endif; ?>

    <?php if (!empty($message)): ?>
        <div class="success-message">
            <?= $message ?>
        </div>
        <div class="button-area">
            <a href="../client/viewHistory.php" class="btn">View Your Bookings</a>
        </div>
    <?php else: ?>
        <h2>Enter Payment Details</h2>
        <form method="POST" class="payment-form">
            <input type="text" name="card-name" placeholder="Name on Card" required><br><br>
            <input type="text" name="card-number" maxlength="16" placeholder="Card Number" required><br><br>
            <input type="month" name="expiry-date" required><br><br>
            <input type="text" name="cvv" maxlength="4" placeholder="CVV" required><br><br>
            <input type="text" name="billing-address" placeholder="Billing Address" required><br><br>
            <button type="submit" class="btn-submit">Complete Payment</button>
        </form>
    <?php endif; ?>

    <br><a href="../index.php" class="btn-back">⬅ Back to Home</a>
</main>

<?php require_once '../template/footer.php'; ?>
</body>
</html>