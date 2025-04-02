<?php
session_start();
if (!isset($_SESSION['userID']) || !isset($_GET['bookingID'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../classes/Client.php';
require_once '../classes/Booking.php';
require_once '../config/DBconnect.php';

use classes\Client;
use classes\Booking;

$client = new Client();
$client->setUserID($_SESSION['userID']);

$bookingID = $_GET['bookingID'];

// Fetch booking details
$stmt = $conn->prepare("SELECT totalCost, status FROM bookings WHERE bookingID = ? AND customerID = ?");
$stmt->bind_param("ii", $bookingID, $_SESSION['userID']);
$stmt->execute();
$booking = $stmt->get_result()->fetch_assoc();

if (!$booking || $booking['status'] == 'Cancelled' || $booking['status'] == 'Confirmed') {
    echo "Invalid or already processed booking.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardNumber = $_POST['cardNumber'];
    $cardHolderName = $_POST['cardHolderName'];
    $expiryDate = $_POST['expiryDate'];
    $cvv = $_POST['cvv'];
    $amount = $booking['totalCost'];

    // Here you'd integrate with an actual payment gateway.
    // For now, we assume payment details are correctly provided and payment succeeds.

    if ($client->makePayment($bookingID, $amount)) {
        $confirmBooking = new Booking();
        $confirmBooking->confirmBooking($bookingID);

        echo "Payment successful! Your booking is confirmed.";
    } else {
        echo "Payment failed!";
    }
}
?>

<h2>Process Payment</h2>
<p>Total Amount: $<?= htmlspecialchars($booking['totalCost']) ?></p>

<form method="POST">
    <label>Card Number:</label><br>
    <input type="text" name="cardNumber" required><br><br>

    <label>Card Holder Name:</label><br>
    <input type="text" name="cardHolderName" required><br><br>

    <label>Expiry Date:</label><br>
    <input type="month" name="expiryDate" required><br><br>

    <label>CVV:</label><br>
    <input type="text" name="cvv" required><br><br>

    <button type="submit">Pay Now</button>
</form>
