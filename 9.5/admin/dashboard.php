<?php
require_once '../template/header.php';
require_once '../config/config.php';

if (!isset($_SESSION['UserID']) || $_SESSION['isAdmin'] != 1) {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - RF Motors</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main class="container dashboard-container">
    <h2>Admin Dashboard</h2>

    <div class="dashboard-links">
        <a href="CRUD/manageCars.php" class="dashboard-card">Manage Cars</a>
        <a href="CRUD/manageUsers.php" class="dashboard-card">Manage Users</a>
        <a href="CRUD/viewMessages.php" class="dashboard-card">View Client Messages</a>
    </div>

    <br><a href="../index.php" class="btn"><--Back to Home</a>
</main>

<?php require_once '../template/footer.php'; ?>
</body>
</html>
