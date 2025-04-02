<?php

namespace classes;

require_once __DIR__ . '/../config/DBconnect.php';

abstract class User
{
    protected $conn;
    protected $userID;
    protected $name;
    protected $email;
    protected $password;
    protected $phoneNumber;
    protected $isAdmin;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function createUser($name, $email, $password, $phoneNumber, $isAdmin)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password, phoneNumber, isAdmin) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $email, $hashedPassword, $phoneNumber, $isAdmin);
        return $stmt->execute();
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getUserByID($userID)
    {
        $sql = "SELECT * FROM users WHERE userID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function setUserID($userID) {
        $this->userID = $userID;
    }
    public function getUserID() {
        return $this->userID;
    }
}
?>
