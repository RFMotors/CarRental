<?php
require_once '../../template/header.php';
require_once '../../config/config.php';
require_once '../../classes/Admin.php';

use classes\Admin;

$admin = new Admin($pdo);

if (!isset($_SESSION['UserID']) || $_SESSION['isAdmin'] != 1) {
    die("<p style='color: red;'>❌ Admin access only.</p>");
}

if (isset($_GET['deleteUser'])) {
    $admin->deleteUser(intval($_GET['deleteUser']));
    header("Location: manageUsers.php");
}

if (isset($_GET['deleteBooking'])) {
    $admin->deleteBooking(intval($_GET['deleteBooking']));
    header("Location: manageUsers.php");
}

$users = $admin->getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<main class="container">
    <h2>Manage Users</h2>

    <?php foreach ($users as $user): ?>
        <div class="user-card">
            <h3><?= htmlspecialchars($user['name']) ?> (<?= $user['email'] ?>)</h3>
            <p>Phone: <?= htmlspecialchars($user['phoneNumber']) ?></p>
            <a href="?deleteUser=<?= $user['userID'] ?>" onclick="return confirm('Are you sure you want to delete this user?')">🗑️ Delete</a>

            <h4>Bookings:</h4>
            <ul>
                <?php
                $bookings = $admin->getUserBookings($user['userID']);
                if (empty($bookings)) {
                    echo "<li>No bookings found.</li>";
                } else {
                    foreach ($bookings as $booking) {
                        echo "<li>Booking ID {$booking['bookingID']} | Car ID {$booking['carID']} | {$booking['startDate']} - {$booking['endDate']} <a href='?deleteBooking={$booking['bookingID']}' onclick='return confirm(\"Delete this booking?\")'>❌</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    <?php endforeach; ?>

    <br><a href="../dashboard.php" class="btn">Back to Admin Dashboard</a>
</main>
<?php require_once '../../template/footer.php'; ?>
</body>
</html>
