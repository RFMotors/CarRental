<?php
require_once '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Client.php';

use classes\Client;

if (!isset($_SESSION['UserID'])) {
    header('Location: ../login.php');
    exit;
}

$client = new Client($pdo, $_SESSION['UserID']);
$bookings = $client->viewHistory();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings - RF Motors</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main class="container">
    <h2>My Booking History</h2>

    <?php if (!empty($bookings)): ?>
        <div class="table-container">
            <table class="booking-table">
                <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Car</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Cost</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['bookingID']) ?></td>
                        <td><?= htmlspecialchars($booking['make']) . ' ' . htmlspecialchars($booking['model']) ?></td>
                        <td><?= htmlspecialchars($booking['startDate']) ?></td>
                        <td><?= htmlspecialchars($booking['endDate']) ?></td>
                        <td>€<?= number_format($booking['totalCost'], 2) ?></td>
                        <td><?= htmlspecialchars($booking['status']) ?></td>
                        <td>
                            <?php if ($booking['status'] === 'Pending' || $booking['status'] === 'Confirmed'): ?>
                                <form method="POST" action="cancelBookings.php" style="display:inline;">
                                    <input type="hidden" name="bookingID" value="<?= $booking['bookingID'] ?>">
                                    <button type="submit" class="btn-cancel" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</button>
                                </form>
                            <?php else: ?>
                                <span>Cancelled</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="error">You don't have any bookings yet!</p>
    <?php endif; ?>

    <br><a href="../index.php" class="btn">⬅ Back to Home</a>
</main>

<?php require_once '../template/footer.php'; ?>
</body>
</html>