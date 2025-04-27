<?php
require_once '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Client.php';

use classes\Client;

$client = new Client($pdo, $_SESSION['UserID']);
$client->setUserID($_SESSION['UserID']);
$message = "";

if (!isset($_GET['id'])) {
    echo "<p style='color: red;'>Invalid booking ID.</p>";
    echo "<a href='../client/viewHistory.php'><-- Back to Bookings</a>";
    exit;
}

$bookingID = intval($_GET['id']);

if ($client->requestCancelBooking($bookingID)) {
    $message = "<p class='success'>Your cancel request has been sent to admin. We will get back to you soon!</p>";
} else {
    $message = "<p class='error'>Failed to send cancel request. Please try again later.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancel Booking</title>
    <link rel="stylesheet" href="../css/lib.css">
</head>
<body>

<main class="container">
    <h2>Cancel Booking</h2>
    <?= $message ?>
    <a href="../client/viewHistory.php" class="btn">⬅ Back to My Bookings</a>
</main>

<?php require_once '../template/footer.php'; ?>

</body>
</html>