<?php

namespace classes;

require_once __DIR__ . '/../config/DBconnect.php';
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/Booking.php';
require_once __DIR__ . '/Payment.php';

class Client extends User
{
    private $booking;
    private $payment;

    public function __construct()
    {
        parent::__construct();
        $this->booking = new Booking();
        $this->payment = new Payment();
    }

    public function createClient($userID, $drivingLicenseNumber, $paymentDetails)
    {
        $sql = "INSERT INTO clients (clientID, drivingLicenseNumber, paymentDetails) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iss", $userID, $drivingLicenseNumber, $paymentDetails);
        return $stmt->execute();
    }

    public function bookCar($carID, $startDate, $endDate, $totalCost)
    {
        return $this->booking->createBooking($this->userID, $carID, $startDate, $endDate, $totalCost);
    }

    public function viewHistory()
    {
        $sql = "SELECT b.bookingID, c.make, c.model, b.startDate, b.endDate, b.totalCost, b.status
                FROM bookings b
                JOIN cars c ON b.carID = c.carID
                WHERE b.customerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->userID);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function cancelBooking($bookingID)
    {
        return $this->booking->cancelBooking($bookingID);
    }

    public function calculateTotalCost($startDate, $endDate, $rentalPrice)
    {
        return $this->booking->calculateTotalCost($startDate, $endDate, $rentalPrice);
    }

    public function makePayment($bookingID, $amount)
    {
        return $this->payment->processPayment($bookingID, $this->userID, $amount);
    }

    public function refundPayment($paymentID)
    {
        return $this->payment->refundPayment($paymentID);
    }
}