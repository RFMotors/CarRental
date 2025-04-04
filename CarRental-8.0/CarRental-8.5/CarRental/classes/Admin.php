<?php

namespace classes;

require_once __DIR__ . '/../config/DBconnect.php';
require_once 'User.php';
require_once 'Car.php';

class Admin extends User
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addCar($userID, $make, $model, $year, $regNumber, $rentalPrice, $availabilityStatus, $image)
    {
        $car = new Car();
        return $car->createCar($make, $model, $year, $regNumber, $userID, $rentalPrice, $availabilityStatus, $image);
    }
    public function removeCar($carID)
    {
        $sql = "DELETE FROM cars WHERE carID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $carID);
        return $stmt->execute();
    }

    public function viewAllUsers()
    {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteUser($userID)
    {
        $sql = "DELETE FROM users WHERE userID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        return $stmt->execute();
    }

    public function approveBooking($bookingID)
    {
        $sql = "UPDATE bookings SET status = 'Approved' WHERE bookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $bookingID);
        return $stmt->execute();
    }
}
?>