<?php
require_once 'config/DBconnect.php';
require_once 'classes/Client.php';
require 'layout/header.php';
use classes\Client;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $phoneNumber = trim($_POST['phone']);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, phoneNumber, isAdmin) VALUES (?, ?, ?, ?, 0)");
    $stmt->bind_param("ssss", $name, $email, $password, $phoneNumber);

    if ($stmt->execute()) {
        $userID = $conn->insert_id;

        $client = new Client();
        $drivingLicenseNumber = "Not Provided";
        $paymentDetails = "Not Provided";

        if ($client->createClient($userID, $drivingLicenseNumber, $paymentDetails)) {
            echo "<p class='success-msg'>✅ User and Client registered successfully!</p>";
        } else {
            echo "<p class='error-msg'>⚠️ User registered, but failed to create Client entry.</p>";
        }
    } else {
        echo "<p class='error-msg'>❌ Error: " . $conn->error . "</p>";
    }
}
?>

<div class="page-container">
    <h2>Register</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="phone" placeholder="Phone Number">
        <button type="submit">Register</button>
    </form>

    <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
</div>

<link rel="stylesheet" href="css/register.css">
<?php require 'layout/footer.php'; ?>
