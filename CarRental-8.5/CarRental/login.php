<?php
session_start();
require_once 'config/DBconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // ✅ Fetch user from database
    $stmt = $conn->prepare("SELECT userID, name, password, isAdmin FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // ✅ Verify password
        if (password_verify($password, $user['password'])) {
            // ✅ Set session variables
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['isAdmin'] = $user['isAdmin'];
            $_SESSION['user_role'] = $user['isAdmin'] == 1 ? 'admin' : 'client';

            // ✅ Redirect based on role
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
    
</head>
<body>
<?php require 'layout/header.php'; ?>
<link rel="stylesheet" href="css/login.css">
<h2>Login</h2>

<?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>

<form method="POST" action="">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
