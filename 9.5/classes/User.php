<?php

namespace classes;

use PDO;
use PDOException;

class User
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createUser($name, $email, $password, $phoneNumber)
    {
        try {
            $sql = "INSERT INTO users (name, email, password, phoneNumber, isAdmin) 
                    VALUES (:name, :email, :password, :phoneNumber, 0)";
            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $password,
                ':phoneNumber' => $phoneNumber
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Check if an email already exists
    public function emailExists($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    // Get user by email (for login)
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
