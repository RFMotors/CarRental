<?php
require_once '../template/header.php';
require_once '../config/config.php';

if (!isset($_SESSION['UserID']) || $_SESSION['isAdmin'] != 0) {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Dashboard - RF Motors</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main class="container dashboard-container">
    <h2>Client Dashboard</h2>

    <div class="dashboard-links">
        <a href="viewHistory.php" class="dashboard-card">View My Bookings</a>
        <a href="../lib/contactPage.php" class="dashboard-card">Contact Admin</a>
        <a href="messagesSent.php" class="dashboard-card">View Sent Messages</a>
    </div>

    <br><a href="../index.php" class="btn"><--Back to Home</a>
</main>

<?php require_once '../template/footer.php'; ?>
</body>
</html>