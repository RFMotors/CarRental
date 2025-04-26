<?php
require_once '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Client.php';

use classes\Client;

$client = new Client($pdo, $_SESSION['UserID']);
$bookings = $client->viewHistory();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Booking History</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .history-container {
            padding: 2rem;
            max-width: 1000px;
            margin: auto;
        }
        .booking-table {
            width: 100%;
            border-collapse: collapse;
        }
        .booking-table th, .booking-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .booking-table th {
            background-color: #f2f2f2;
        }
        .booking-table tr:hover {
            background-color: #f9f9f9;
        }
        .cancel-btn {
            background-color: #ff4d4d;
            border: none;
            padding: 6px 12px;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }
        .cancel-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
<main class="history-container">
    <h2>My Booking History</h2>

    <?php if (!empty($bookings)): ?>
        <table class="booking-table">
            <thead>
            <tr>
                <th>Booking ID</th>
                <th>Car</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Cost</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
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
                        <?php if ($booking['status'] === 'Confirmed'): ?>
                            <form action="cancelBooking.php" method="POST" style="display:inline;">
                                <input type="hidden" name="bookingID" value="<?= $booking['bookingID'] ?>">
                                <button type="submit" class="cancel-btn" onclick="return confirm('Cancel this booking?')">Cancel</button>
                            </form>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You haven't made any bookings yet.</p>
    <?php endif; ?>
</main>

<?php require_once '../template/footer.php'; ?>

</body>
</html>
