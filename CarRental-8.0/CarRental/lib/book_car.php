<?php
session_start();
require_once '../config/DBconnect.php';
require_once '../classes/Car.php';

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

$carObj = new Car($conn);

if (isset($_GET['id'])) {
    $carID = $_GET['id'];
    $userID = $_SESSION['userID'];

    // ✅ Book the car (insert into bookings)
    $sql = "INSERT INTO bookings (customerID, carID, startDate, endDate, totalCost, status) 
            VALUES (?, ?, NOW(), DATE_ADD(NOW(), INTERVAL 3 DAY), 100, 'Confirmed')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userID, $carID);

    if ($stmt->execute()) {
        // ✅ Update car availability
        $carObj->updateAvailability($carID, 0);
        echo "Booking successful!";
    } else {
        echo "Failed to book the car.";
    }
}
?>
