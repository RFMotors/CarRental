<?php
require '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Client.php';

use classes\Client;

$client = new Client($pdo, $_SESSION['UserID']);

if (!isset($_GET['bookingID'])) {
    echo "<p>❌ Invalid booking selection.</p>";
    exit;
}

$bookingID = intval($_GET['bookingID']);

if ($client->cancelBooking($bookingID)) {
    echo "<div class='message' style='padding: 20px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin: 20px;'>
        ✅ Your cancellation request has been sent to the admin. We will get back to you soon!
    </div>";
} else {
    echo "<div class='error' style='padding: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; margin: 20px;'>
        ❌ Error sending cancellation request. Please try again later.
    </div>";
}

echo "<br><a href='viewHistory.php' class='btn' style='margin-left: 20px;'>⬅ Back to Booking History</a>";

require_once '../template/footer.php';
