<?php
session_start();
require_once __DIR__ . '/config/DBconnect.php';
require_once __DIR__ . '/classes/Admin.php';
require_once __DIR__ . '/classes/Client.php';

//Handle Login
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $admin = new Admin($conn);
    $client = new Client($conn);

    //Check if Admin
    if ($admin->login($email, $password)) {
        header("Location: admin/dashboard.php");
        exit();
    }

    //Check if Client
    $clientLogin = $client->login($email, $password);
    if ($clientLogin['status']) {
        header("Location: client/dashboard.php");
        exit();
    }

    //Invalid Credentials
    $error = "Invalid email or password.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<?php require 'layout/header.php'; ?>

<main>
    <h2>Login</h2>

    <?php if (!empty($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <p>New user? <a href="register.php">Register here</a></p>
</main>

<?php require 'layout/footer.php'; ?>

</body>
</html>
