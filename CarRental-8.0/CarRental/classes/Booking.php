<?php

namespace classes;

require_once __DIR__ . '/../config/DBconnect.php';

class Booking
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function createBooking($customerID, $carID, $startDate, $endDate, $totalCost)
    {
        $sql = "INSERT INTO bookings (customerID, carID, startDate, endDate, totalCost, status) VALUES (?, ?, ?, ?, ?, 'Pending')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iissd", $customerID, $carID, $startDate, $endDate, $totalCost);
        return $stmt->execute();
    }

    public function confirmBooking($bookingID)
    {
        $sql = "UPDATE bookings SET status = 'Confirmed' WHERE bookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $bookingID);
        return $stmt->execute();
    }

    public function cancelBooking($bookingID)
    {
        $sql = "UPDATE bookings SET status = 'Cancelled' WHERE bookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $bookingID);
        return $stmt->execute();
    }
    public function calculateTotalCost($startDate, $endDate, $rentalPrice)
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        $days = $start->diff($end)->days;
        return $days * $rentalPrice;
    }
}
?>
