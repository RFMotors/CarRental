<?php
require_once __DIR__ . '/../config/DBconnect.php';

class Admin {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $password) {
        try {
            $sql = "SELECT * FROM Admin WHERE Email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $admin = $result->fetch_assoc();

            if ($admin && password_verify($password, $admin['Password'])) {
                session_start();
                $_SESSION['admin_id'] = $admin['idAdmin'];
                $_SESSION['user_type'] = 'admin';
                $_SESSION['admin_email'] = $admin['Email'];
                $_SESSION['admin_name'] = $admin['FirstName'] . " " . $admin['LastName'];
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }

    public function isLoggedIn() {
        return isset($_SESSION['admin_id']) && $_SESSION['user_type'] === 'admin';
    }
}
?>
