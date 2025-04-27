<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RF Motors Car Rental</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>
<body>

<header>
    <nav>
        <a href="/index.php">
            <img src="/images/RFMotorsLOGO.png" alt="RF Motors Logo" style="height: 60px;">
        </a>

        <a href="/index.php">Home</a>
        <a href="/aboutUs.php">About Us</a>
        <?php if (isset($_SESSION['UserID'])): ?>
            <?php if ($_SESSION['isAdmin'] == 1): ?>
                <a href="/admin/dashboard.php">Dashboard</a>
            <?php else: ?>
                <a href="/client/dashboard.php">Dashboard</a>
            <?php endif; ?>
            <a href="/lib/contactPage.php">Contact</a>
            <a href="/logout.php">Logout</a>
        <?php else: ?>
            <a href="/login.php">Login</a>
            <a href="/register.php">Register</a>
            <a href="/lib/contactPage.php">Contact</a>
        <?php endif; ?>
    </nav>
</header>