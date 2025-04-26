<?php

namespace classes;

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/User.php';

class Admin extends User
{
    public function __construct($pdo)
    {
        parent::__construct($pdo);
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users WHERE isAdmin = 0";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteUser($userID)
    {
        $sql = "DELETE FROM users WHERE userID = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$userID]);
    }

    public function getUserBookings($userID)
    {
        $sql = "SELECT * FROM bookings WHERE userID = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userID]);
        return $stmt->fetchAll();
    }
    public function deleteBooking($bookingID)
    {
        $sql = "DELETE FROM bookings WHERE bookingID = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$bookingID]);
    }

    public function viewAllMessages()
    {
        $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllMessages()
    {
        $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

// Reply to a message
    public function replyToMessage($contactID, $reply)
    {
        $sql = "UPDATE contacts SET adminReply = :reply WHERE messageID = :messageID";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':reply' => $reply,
            ':messageID' => $contactID
        ]);
    }
}
