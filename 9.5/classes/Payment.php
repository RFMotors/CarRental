<?php

namespace classes;

require_once __DIR__ . '/../config/config.php';

class Payment
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function processPayment($bookingID, $customerID, $amount)
    {
        $sql = "INSERT INTO payments (bookingID, customerID, amount, paymentStatus)
                VALUES (?, ?, ?, 'Completed')";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$bookingID, $customerID, $amount]);
    }

    public function refundPayment($paymentID)
    {
        $sql = "UPDATE payments SET paymentStatus = 'Refunded' WHERE paymentID = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$paymentID]);
    }
}
