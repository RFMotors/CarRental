<?php

namespace classes;

require_once __DIR__ . '/../config/config.php';

class Car
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllCars()
    {
        $stmt = $this->pdo->query("SELECT * FROM cars ORDER BY rentalPrice ASC");
        return $stmt->fetchAll();
    }

    public function getCarById($carID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cars WHERE carID = ?");
        $stmt->execute([$carID]);
        return $stmt->fetch();
    }

    public function createCar($make, $model, $year, $regNumber, $userID, $price, $status, $image = '', $description = '')
    {
        $stmt = $this->pdo->prepare("INSERT INTO cars (make, model, year, regNumber, userID, rentalPrice, availabilityStatus, image, description) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$make, $model, $year, $regNumber, $userID, $price, $status, $image, $description]);
    }

    public function updateCar($carID, $make, $model, $year, $rentalPrice, $availabilityStatus, $image, $description)
    {
        $sql = "UPDATE cars 
            SET make = :make, 
                model = :model, 
                year = :year, 
                rentalPrice = :rentalPrice, 
                availabilityStatus = :availabilityStatus, 
                image = :image,
                description = :description
            WHERE carID = :carID";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':make' => $make,
            ':model' => $model,
            ':year' => $year,
            ':rentalPrice' => $rentalPrice,
            ':availabilityStatus' => $availabilityStatus,
            ':image' => $image,
            ':description' => $description,
            ':carID' => $carID
        ]);
    }
    public function deleteCar($carID)
    {
        $sql = "DELETE FROM cars WHERE carID = :carID";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':carID' => $carID]);
    }
    public function updateAvailability($carID, $availabilityStatus)
    {
        $stmt = $this->pdo->prepare("UPDATE cars SET availabilityStatus = ? WHERE carID = ?");
        return $stmt->execute([$availabilityStatus, $carID]);
    }

    public function searchCars($search = '', $sortPrice = false, $onlyAvailable = false)
    {
        $sql = "SELECT * FROM cars WHERE 1"; // Start with a dummy WHERE 1

        if (!empty($search)) {
            $sql .= " AND (make LIKE :search OR model LIKE :search)";
        }

        if ($onlyAvailable) {
            $sql .= " AND availabilityStatus = 0"; // 0 = Available
        }

        if ($sortPrice) {
            $sql .= " ORDER BY rentalPrice ASC";
        }

        $stmt = $this->pdo->prepare($sql);

        if (!empty($search)) {
            $stmt->bindValue(':search', "%$search%", \PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
