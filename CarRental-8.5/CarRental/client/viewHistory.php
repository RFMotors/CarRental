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

$bookings = $client->viewHistory();
?>

<h2>Your Booking Activity & Payments</h2>

<?php if (!empty($bookings)): ?>
    <table border="1" cellpadding="10">
        <thead>
        <tr>
            <th>Car</th>
            <th>Rental Period</th>
            <th>Total Cost</th>
            <th>Status</th>
            <th>Payment Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= htmlspecialchars($booking['make']) ?> <?= htmlspecialchars($booking['model']) ?></td>
                <td><?= htmlspecialchars($booking['startDate']) ?> to <?= htmlspecialchars($booking['endDate']) ?></td>
                <td>$<?= htmlspecialchars($booking['totalCost']) ?></td>
                <td><?= htmlspecialchars($booking['status']) ?></td>
                <td><?= ($booking['status'] === 'Confirmed') ? "Paid" : "Pending" ?></td>
                <td>
                    <?php if ($booking['status'] !== 'Confirmed' && $booking['status'] !== 'Cancelled'): ?>
                        <a href="processPayment.php?bookingID=<?= htmlspecialchars($booking['bookingID']) ?>">Pay Now</a>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No booking activities found.</p>
<?php endif; ?>
