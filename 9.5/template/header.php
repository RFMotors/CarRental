<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <nav style="background-color: #333; padding: 10px;">
        <div style="display: flex; justify-content: center; gap: 20px;">
            <a href="/index.php" style="color: white; text-decoration: none;">Home</a>

            <?php if (isset($_SESSION['UserID'])): ?>
                <?php if ($_SESSION['isAdmin'] == 1): ?>
                    <a href="/admin/dashboard.php" style="color: white; text-decoration: none;">Admin Dashboard</a>
                <?php else: ?>
                    <a href="/client/dashboard.php" style="color: white; text-decoration: none;">Client Dashboard</a>
                <?php endif; ?>

                <a href="/lib/contactPage.php" style="color: white; text-decoration: none;">Contact Us</a>
                <a href="/logout.php" style="color: white; text-decoration: none;">Logout</a>
            <?php else: ?>
                <a href="/lib/contactPage.php" style="color: white; text-decoration: none;">Contact Us</a>
                <a href="/login.php" style="color: white; text-decoration: none;">Login</a>
                <a href="/register.php" style="color: white; text-decoration: none;">Register</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
