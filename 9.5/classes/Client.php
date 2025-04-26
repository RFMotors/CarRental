<?php
namespace classes;

require_once __DIR__ . '/User.php';

class Client extends User
{
    private $userID;

    public function __construct($pdo, $userID)
    {
        parent::__construct($pdo);
        $this->userID = $userID;
    }

    public function bookCar($carID, $startDate, $endDate, $totalCost)
    {
        $sql = "INSERT INTO bookings (userID, carID, startDate, endDate, totalCost, status)
                VALUES (:userID, :carID, :startDate, :endDate, :totalCost, 'Pending')";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':userID' => $this->userID,
            ':carID' => $carID,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':totalCost' => $totalCost
        ]);
    }

    public function makePayment($bookingID, $totalCost)
    {
        $sql = "UPDATE bookings SET status = 'Confirmed' WHERE bookingID = :bookingID";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':bookingID' => $bookingID]);
    }

    public function viewHistory()
    {
        $sql = "SELECT b.bookingID, b.startDate, b.endDate, b.totalCost, b.status, 
                       c.make, c.model 
                FROM bookings b
                INNER JOIN cars c ON b.carID = c.carID
                WHERE b.userID = :userID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':userID' => $this->userID]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function viewMessages()
    {
        $sql = "SELECT * FROM contacts WHERE userID = :userID ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':userID' => $this->userID]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function sendMessage($name, $email, $messageContent)
    {
        $sql = "INSERT INTO contacts (userID, name, email, message) 
            VALUES (:userID, :name, :email, :message)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':userID' => $this->userID,
            ':name' => $name,
            ':email' => $email,
            ':message' => $messageContent
        ]);
    }
    public function getLastBookingIDForUser($userID)
    {
        $sql = "SELECT bookingID FROM bookings WHERE userID = :userID ORDER BY bookingID DESC LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':userID' => $userID]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ? $result['bookingID'] : null;
    }
}

