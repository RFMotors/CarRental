<?php
session_start();
require_once '../config/DBconnect.php';
require_once '../classes/Admin.php';

$adminObj = new Admin($conn);
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($adminObj->login($email, $password)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $errorMessage = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<h2>Admin Login</h2>
<?php if ($errorMessage): ?>
    <p style="color: red;"><?php echo $errorMessage; ?></p>
<?php endif; ?>
<form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>
</body>
</html>
