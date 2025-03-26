<?php
class Car {
    private $conn;
    private $make;
    private $model;
    private $year;
    private $pricePerDay;
    private $transmission;
    private $engineType;
    private $imagePath;

    // Constructor
    public function __construct($db, $make = null, $model = null, $year = null, $pricePerDay = null, $transmission = null, $engineType = null, $imagePath = null) {
        $this->conn = $db;
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
        $this->pricePerDay = $pricePerDay;
        $this->transmission = $transmission;
        $this->engineType = $engineType;
        $this->imagePath = $imagePath;
    }

    // Getter methods
    public function getMake() {
        return $this->make;
    }

    public function getModel() {
        return $this->model;
    }

    public function getYear() {
        return $this->year;
    }

    public function getPricePerDay() {
        return $this->pricePerDay;
    }

    public function getTransmission() {
        return $this->transmission;
    }

    public function getEngineType() {
        return $this->engineType;
    }

    public function getImagePath() {
        return $this->imagePath;
    }

    // Setter methods
    public function setMake($make) {
        $this->make = $make;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function setPricePerDay($pricePerDay) {
        $this->pricePerDay = $pricePerDay;
    }

    public function setTransmission($transmission) {
        $this->transmission = $transmission;
    }

    public function setEngineType($engineType) {
        $this->engineType = $engineType;
    }

    public function setImagePath($imagePath) {
        $this->imagePath = $imagePath;
    }

    // Method to create a new car in the database
    public function createCar() {
        try {
            $sql = "INSERT INTO Car (Make, Model, Year, PricePerDay, Transmission, EngineType, Image) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssidsss", $this->make, $this->model, $this->year, $this->pricePerDay, $this->transmission, $this->engineType, $this->imagePath);
            return $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }

    // Method to fetch all available cars
    public function getAllCars() {
        try {
            $sql = "SELECT * FROM Car WHERE AvailabilityStatus = 'Available'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $error) {
            die("Error fetching cars: " . $error->getMessage());
        }
    }
}
?>
