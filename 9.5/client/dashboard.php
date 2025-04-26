<?php
require_once '../template/header.php';
if (!isset($_SESSION['UserID']) || $_SESSION['isAdmin'] != 0) {
    die("<p>⚠️ Access Denied. Clients only.</p>");
}
?>

    <main>
        <h2>My Dashboard</h2>
        <ul>
            <li><a href="/client/viewHistory.php">My Bookings</a></li>
            <li><a href="/client/messagesSent.php">My Messages</a></li>
            <li><a href="/index.php">Book a Car</a></li>
        </ul>
    </main>

<?php require_once '../template/footer.php'; ?>