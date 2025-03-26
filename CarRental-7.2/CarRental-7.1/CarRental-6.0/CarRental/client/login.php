<?php
session_start();
require_once '../config/DBconnect.php';
require_once '../lib/Client.php';

$clientObj = new Client($conn);
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($clientObj->login($email, $password)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "<p style='color: red;'>Invalid email or password.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Client Login</h2>
<?= $message; ?>

<form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a>.</p>

</body>
</html>

