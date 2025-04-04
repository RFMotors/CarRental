<?php

namespace classes;

require_once __DIR__ . '/../config/DBconnect.php';

class Payment
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function processPayment($bookingID, $customerID, $amount)
    {
        $sql = "INSERT INTO payments (bookingID, customerID, amount, paymentStatus) VALUES (?, ?, ?, 'Completed')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iid", $bookingID, $customerID, $amount);
        return $stmt->execute();
    }

    public function refundPayment($paymentID)
    {
        $sql = "UPDATE payments SET paymentStatus = 'Refunded' WHERE paymentID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $paymentID);
        return $stmt->execute();
    }
}
?>
