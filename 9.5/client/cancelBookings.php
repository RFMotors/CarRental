<?php
require_once '../config/config.php';
require_once '../classes/Client.php';

use classes\Client;

session_start();

if (!isset($_SESSION['UserID'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingID'])) {
    $client = new Client($pdo, $_SESSION['UserID']);
    $bookingID = intval($_POST['bookingID']);

    if ($client->cancelBooking($bookingID)) {
        header('Location: viewHistory.php?msg=cancelled');
        exit;
    } else {
        echo "Failed to cancel booking.";
    }
} else {
    echo "Invalid request.";
}
?>