<?php
session_start();
require_once __DIR__ . '/config/DBconnect.php';
require_once __DIR__ . '/classes/Client.php';

//Handle Registration
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);
    $driverLicenseNumber = trim($_POST['driver_license']);

    //Check if passwords match
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match!";
    } else {
        $client = new Client($conn);
        $registrationResult = $client->register($firstName, $lastName, $email, $password, $driverLicenseNumber);

        if ($registrationResult['status']) {
            $success = $registrationResult['message'];
        } else {
            $error = $registrationResult['message'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Registration</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<?php require 'layout/header.php'; ?>

<main>
    <h2>Register as a Client</h2>

    <?php if (!empty($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
    <?php if (!empty($success)) { echo "<p style='color: green;'>$success</p>"; } ?>

    <form method="POST">
        <label>First Name:</label>
        <input type="text" name="first_name" required><br><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required><br><br>

        <label>Driver's License Number:</label>
        <input type="text" name="driver_license" required><br><br>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</main>

<?php require 'layout/footer.php'; ?>

</body>
</html>