<?php
require_once 'config/config.php';
require_once 'classes/User.php';
require_once 'template/header.php';

use classes\User;

$registerError = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phoneNumber = trim($_POST['phone']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    $userObj = new User($pdo);

    if ($userObj->emailExists($email)) {
        $registerError = "❌ Email already exists. Please use a different email.";
    } else {
        if ($userObj->createUser($name, $email, $password, $phoneNumber)) {
            header("Location: login.php?registered=1");
            exit;
        } else {
            $registerError = "❌ Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - RF Motors</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

<div class="register-container">
    <h2>Register</h2>

    <?php if (!empty($registerError)): ?>
        <p class="error"><?= $registerError ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <input type="text" name="name" placeholder="Full Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="text" name="phone" placeholder="Phone Number" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Register</button>
    </form>

    <p class="link">Already have an account? <a href="login.php">Login here</a>.</p>
</div>

<?php require_once 'template/footer.php'; ?>
</body>
</html>
