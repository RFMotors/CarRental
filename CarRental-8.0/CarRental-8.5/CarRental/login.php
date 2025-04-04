<?php
session_start();
require_once 'config/DBconnect.php';
require 'layout/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT userID, name, password, isAdmin FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['isAdmin'] = $user['isAdmin'];
            $_SESSION['user_role'] = $user['isAdmin'] == 1 ? 'admin' : 'client';

            if ($_SESSION['user_role'] === 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: client/dashboard.php");
            }
            exit();
        } else {
            $error = "❌ Invalid password!";
        }
    } else {
        $error = "❌ User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - CarRental</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<!-- Page Content -->
<div class="page-container">
    <div class="login-box">
        <h2>Login</h2>

        <?php if (!empty($error)) echo "<p class='error-msg'>$error</p>"; ?>

        <form method="POST">
            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <p class="register-link">
            Don't have an account? <a href="register.php">Register here</a>
        </p>
    </div>
</div>

<?php require 'layout/footer.php'; ?>
</body>
</html>
