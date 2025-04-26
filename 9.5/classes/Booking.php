<?php

namespace classes;

require_once __DIR__ . '/../config/config.php';

class Booking
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createBooking($customerID, $carID, $startDate, $endDate, $totalCost)
    {
        $stmt = $this->pdo->prepare("INSERT INTO bookings (customerID, carID, startDate, endDate, totalCost, status) 
                                     VALUES (?, ?, ?, ?, ?, 'Pending')");
        return $stmt->execute([$customerID, $carID, $startDate, $endDate, $totalCost]);
    }

    public function confirmBooking($bookingID)
    {
        $stmt = $this->pdo->prepare("UPDATE bookings SET status = 'Confirmed' WHERE bookingID = ?");
        return $stmt->execute([$bookingID]);
    }

    public function cancelBooking($bookingID)
    {
        $stmt = $this->pdo->prepare("UPDATE bookings SET status = 'Cancelled' WHERE bookingID = ?");
        return $stmt->execute([$bookingID]);
    }

    public function calculateTotalCost($startDate, $endDate, $rentalPrice)
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        $days = $start->diff($end)->days;
        return $days * $rentalPrice;
    }

    public function getUserBookings($userID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM bookings WHERE customerID = ?");
        $stmt->execute([$userID]);
        return $stmt->fetchAll();
    }

    public function getBookingById($bookingID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM bookings WHERE bookingID = ?");
        $stmt->execute([$bookingID]);
        return $stmt->fetch();
    }
}
