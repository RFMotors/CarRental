<?php
<link rel="stylesheet" href="../css/login.css">
require_once '../config/DBconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // ✅ Check if user exists
    $stmt = $conn->prepare("SELECT userID, name, password FROM users WHERE email = ? AND isAdmin = 0");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // ✅ Verify hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['userID'] = $row['userID'];
            $_SESSION['name'] = $row['name'];

            // ✅ Redirect to user dashboard
            header("Location: CarRental/client/dashboard.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<?php require '../layout/footer.php'; ?>
