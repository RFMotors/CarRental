<?php
require_once 'config/config.php';
require_once 'classes/User.php';
require_once 'template/header.php';

use classes\User;

$loginError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $userObj = new User($pdo);
    $user = $userObj->getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['UserID'] = $user['userID'];
        $_SESSION['UserName'] = $user['name'];
        $_SESSION['isAdmin'] = $user['isAdmin'];

        if ($user['isAdmin'] == 1) {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: client/dashboard.php");
        }
        exit;
    } else {
        $loginError = "❌ Incorrect email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - RF Motors</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <?php if (!empty($loginError)): ?>
        <p class="error"><?= $loginError ?></p>
    <?php endif; ?>

    <?php if (isset($_GET['registered']) && $_GET['registered'] == 1): ?>
        <p class="success">✅ Registered successfully! You can now log in.</p>
    <?php endif; ?>

    <form method="post" action="">
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <p class="link">Don't have an account? <a href="register.php">Register here</a>.</p>
</div>

<?php require_once 'template/footer.php'; ?>
</body>
</html>
