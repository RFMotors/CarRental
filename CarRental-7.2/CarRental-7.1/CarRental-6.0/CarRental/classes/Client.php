<?php
require_once __DIR__ . '/../config/DBconnect.php';

class Client
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register($firstName, $lastName, $email, $password, $driverLicenseNumber)
    {
        try {
            $sql = "SELECT Email FROM Client WHERE Email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            if ($stmt->get_result()->num_rows > 0) {
                return ['status' => false, 'message' => 'Email is already registered'];
            }

            $sql = "SELECT DriverLicenseNumber FROM Client WHERE DriverLicenseNumber = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $driverLicenseNumber);
            $stmt->execute();
            if ($stmt->get_result()->num_rows > 0) {
                return ['status' => false, 'message' => 'Driver’s License already registered'];
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO Client (FirstName, SecondName, Email, Password, DriverLicenseNumber) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssss", $firstName, $lastName, $email, $hashedPassword, $driverLicenseNumber);

            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'Registration successful!'];
            } else {
                return ['status' => false, 'message' => 'Error registering user. Try again.'];
            }
        } catch (mysqli_sql_exception $e) {
            return ['status' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT idClient, FirstName, SecondName, Email, Password FROM Client WHERE LOWER(Email) = LOWER(?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $client = $result->fetch_assoc();

            if (!$client) {
                return ['status' => false, 'message' => 'User not found.'];
            }

            if (!password_verify($password, $client['Password'])) {
                return ['status' => false, 'message' => 'Incorrect password.'];
            }

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['client_id'] = $client['idClient'];
            $_SESSION['user_type'] = 'client';
            $_SESSION['client_email'] = $client['Email'];
            $_SESSION['client_name'] = $client['FirstName'] . " " . $client['SecondName'];
            $_SESSION['LAST_ACTIVITY'] = time();

            return ['status' => true, 'message' => 'Login successful'];
        } catch (mysqli_sql_exception $e) {
            return ['status' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }
}
?>
