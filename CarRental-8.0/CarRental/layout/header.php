<?php
// layout/header.php

// Start the session if not started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// (Optional) Set a session variable for testing
if (!isset($_SESSION['myVar'])) {
    $_SESSION['myVar'] = 'Hello World!';
    // If you'd like to see when it first gets set:
    echo "<p>Session variable 'myVar' was not set; setting it to: {$_SESSION['myVar']}</p>";
} else {
    // If you'd like to see it on subsequent loads:
    echo "<p>Session variable 'myVar' is already set to: {$_SESSION['myVar']}</p>";
}
?>

<link rel="stylesheet" href="/CarRental/css/headerFooter.css">
<header>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                <a href="/CarRental/index.php">
                    <img src="/CarRental/images/RFMotorsLOGO.png" alt="RF Motors"> RF Motors Car Rental
                </a>
            </div>
            <ul>
                <button><a href="/CarRental/index.php">Home</a></button>
                <button><a href="/CarRental/ContactPage.php">Contact</a></button>
                <?php if (isset($_SESSION['userID'])): ?>
                    <button><a href="/CarRental/client/dashboard.php">Dashboard</a></button>
                    <button><a href="/CarRental/logout.php">Logout</a></button>
                <?php else: ?>
                    <button><a href="/CarRental/login.php">Login/Register</a></button>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>

