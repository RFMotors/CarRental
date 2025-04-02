<?php

namespace classes;

require_once __DIR__ . '/../config/DBconnect.php';

class Review
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function addReview($customerID, $carID, $rating, $comments)
    {
        $sql = "INSERT INTO reviews (customerID, carID, rating, comments) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiis", $customerID, $carID, $rating, $comments);
        return $stmt->execute();
    }

    public function updateReview($reviewID, $rating, $comments)
    {
        $sql = "UPDATE reviews SET rating = ?, comments = ? WHERE reviewID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isi", $rating, $comments, $reviewID);
        return $stmt->execute();
    }

    public function deleteReview($reviewID)
    {
        $sql = "DELETE FROM reviews WHERE reviewID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $reviewID);
        return $stmt->execute();
    }
}
?>
