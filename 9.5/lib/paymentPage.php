<?php
require_once '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Client.php';
require_once '../classes/Car.php';

use classes\Client;
use classes\Car;

$client = new Client($pdo, $_SESSION['UserID']);
$carObj = new Car($pdo);
$message = "";

// Ensure the user is logged in
if (!isset($_SESSION['UserID'])) {
    echo "<p>⚠️ You must be logged in to access payment page.</p>";
    exit;
}

// Booking Draft Check
if (!isset($_SESSION['bookingDraft'])) {
    echo "<p>⚠️ No booking information found. Please select a car first.</p>";
    exit;
}

$carID = $_SESSION['bookingDraft']['carID'];
$startDate = $_SESSION['bookingDraft']['startDate'];
$endDate = $_SESSION['bookingDraft']['endDate'];
$totalCost = $_SESSION['bookingDraft']['totalCost'];
$days = $_SESSION['bookingDraft']['days'];

$car = $carObj->getCarById($carID);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_SESSION['UserID'];

    if ($client->bookCar($carID, $startDate, $endDate, $totalCost)) {
        $bookingID = $client->getLastBookingIDForUser($userID);

        if ($client->makePayment($bookingID, $totalCost)) {
            $carObj->updateAvailability($carID, 1); // Car set to Rented
            $message = "<div class='success'>
                ✅ Payment successful! Your booking is confirmed.<br>
                <a href='../client/viewHistory.php' class='btn'>View Your Bookings</a>
            </div>";
            unset($_SESSION['bookingDraft']);
        } else {
            $message = "<p class='error'>❌ Payment failed. Please try again later.</p>";
        }
    } else {
        $message = "<p class='error'>❌ Booking could not be created.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Page</title>
    <link rel="stylesheet" href="../css/payment.css">
</head>
<body>

<main class="checkout-container">
    <h2>Order Summary</h2>

    <?php if (!empty($car)): ?>
        <div class="order-summary">
            <p><strong>Car:</strong> <?= htmlspecialchars($car['make']) ?> <?= htmlspecialchars($car['model']) ?></p>
            <p><strong>Rental Period:</strong> <?= $startDate ?> to <?= $endDate ?> (<?= $days ?> days)</p>
            <p><strong>Price per Day:</strong> €<?= htmlspecialchars($car['rentalPrice']) ?></p>
            <p class="total"><strong>Total Cost:</strong> €<?= number_format($totalCost, 2) ?></p>
        </div>
    <?php endif; ?>

    <?= $message ?>

    <?php if (empty($message)): ?>
        <h2>Enter Payment Details</h2>
        <form action="" method="POST" class="payment-form">
            <input type="text" name="card-name" placeholder="Name on Card" required><br><br>
            <input type="text" name="card-number" maxlength="16" placeholder="Card Number" required><br><br>
            <input type="month" name="expiry-date" required><br><br>
            <input type="text" name="cvv" maxlength="4" placeholder="CVV" required><br><br>
            <input type="text" name="billing-address" placeholder="Billing Address" required><br><br>

            <button type="submit" class="btn-submit">Complete Payment</button>
        </form>
    <?php endif; ?>
</main>

<?php require_once '../template/footer.php'; ?>

</body>
</html>