<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../classes/Client.php';
use classes\Client;

$client = new Client();
$client->setUserID($_SESSION['userID']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bookingID = $_POST['bookingID'];

    if ($client->cancelBooking($bookingID)) {
        echo "Booking canceled successfully!";
    } else {
        echo "Failed to cancel booking.";
    }
}

$bookings = $client->viewHistory();

// Filter only bookings not already cancelled
$activeBookings = array_filter($bookings, function($booking) {
    return $booking['status'] !== 'Cancelled';
});
?>

<?php if (!empty($activeBookings)): ?>
    <form method="POST">
        <label>Select Booking to Cancel:</label><br>
        <select name="bookingID" required>
            <?php foreach ($activeBookings as $booking): ?>
                <option value="<?= htmlspecialchars($booking['bookingID']) ?>">
                    <?= htmlspecialchars($booking['make']) ?> <?= htmlspecialchars($booking['model']) ?> |
                    <?= htmlspecialchars($booking['startDate']) ?> to <?= htmlspecialchars($booking['endDate']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Cancel Booking</button>
    </form>
<?php else: ?>
    <p>No cars booked!</p>
<?php endif; ?>