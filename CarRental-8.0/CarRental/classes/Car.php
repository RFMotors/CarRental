<?php

namespace classes;

require_once __DIR__ . '/../config/DBconnect.php';

class Car {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllCars()
    {
        $sql = "SELECT * FROM cars WHERE availabilityStatus = 'Available'";
        return $this->conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }


    public function getCarDetails($carID)
    {
        $sql = "SELECT * FROM cars WHERE carID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $carID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateAvailability($carID, $availabilityStatus)
    {
        $sql = "UPDATE cars SET AvailabilityStatus = ? WHERE carID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $availabilityStatus, $carID);
        return $stmt->execute();
    }

    public function createCar($make, $model, $year, $regNumber, $userID, $rentalPrice, $availabilityStatus, $image) {
        $sql = "INSERT INTO cars (make, model, year, regNumber, userID, rentalPrice, AvailabilityStatus, image)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssisisds", $make, $model, $year, $regNumber, $userID, $rentalPrice, $availabilityStatus, $image);
        return $stmt->execute();
    }
}
?>
