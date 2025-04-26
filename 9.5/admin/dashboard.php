<?php
require_once '../template/header.php';
if (!isset($_SESSION['UserID']) || $_SESSION['isAdmin'] != 1) {
    die("<p>⚠️ Access Denied. Admins only.</p>");
}
?>

    <main>
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="/admin/CRUD/manageCars.php">Manage Cars</a></li>
            <li><a href="/admin/CRUD/manageUsers.php">Manage Users</a></li>
            <li><a href="/admin/CRUD/viewMessages.php">View Contact Messages</a></li>
        </ul>
    </main>

<?php require_once '../template/footer.php'; ?>