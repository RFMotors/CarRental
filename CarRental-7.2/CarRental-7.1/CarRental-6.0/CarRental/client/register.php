<?php
session_start();
require_once '../config/DBconnect.php';
require_once '../classes/Client.php';

$clientObj = new Client($conn);
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $driverLicense = $_POST['driverLicense'];

    if ($clientObj->register($firstName, $lastName, $email, $password, $address, $dob, $driverLicense)) {
        $message = "<p style='color: green;'>Registration successful! <a href='login.php'>Login here</a>.</p>";
    } else {
        $message = "<p style='color: red;'>Error registering user. Try again.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Client Registration</h2>
<?= $message; ?>

<form method="POST">
    <label>First Name:</label>
    <input type="text" name="firstName" required><br>

    <label>Last Name:</label>
    <input type="text" name="lastName" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <label>Phone Number:</label>
    <input type="text" name="phone" required><br>

    <label>Address:</label>
    <input type="text" name="address" required><br>

    <label>Date of Birth:</label>
    <input type="date" name="dob" required><br>

    <label>Driver License Number:</label>
    <input type="text" name="driverLicense" required><br>

    <button type="submit">Register</button>
</form>

</body>
</html>
