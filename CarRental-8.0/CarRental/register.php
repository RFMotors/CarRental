<?php
require_once 'config/DBconnect.php';
require_once 'classes/Client.php';

use classes\Client;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $phoneNumber = trim($_POST['phone']);

    // Inserts user into users table
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, phoneNumber, isAdmin) VALUES (?, ?, ?, ?, 0)");
    $stmt->bind_param("ssss", $name, $email, $password, $phoneNumber);

    if ($stmt->execute()) {
        // Retrieve the newly created userID
        $userID = $conn->insert_id;

        // Automatically create a corresponding client entry
        $client = new Client();

        // You might want to ask users for these details in the registration form in the future
        $drivingLicenseNumber = "Not Provided";
        $paymentDetails = "Not Provided";

        if ($client->createClient($userID, $drivingLicenseNumber, $paymentDetails)) {
            echo "User and Client registered successfully!";
        } else {
            echo "User registered, but failed to create Client entry.";
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="phone" placeholder="Phone Number">
    <button type="submit">Register</button>
</form>
<p><a href="login.php">Login</a></p>
<link rel="stylesheet" href="css/register.css">