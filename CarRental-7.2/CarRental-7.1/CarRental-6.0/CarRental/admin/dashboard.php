<?php
session_start();
require_once '../config/DBconnect.php';

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php require "CarRental/layout/header.php"; ?>

<main>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?></h2>

    <ul>
        <li>
            <a href="CRUD/create.php"><strong>Create</strong></a> - Add a car entry
        </li>
        <li>
            <a href="CRUD/read.php"><strong>Read</strong></a> - Find a registered car
        </li>
        <li>
            <a href="CRUD/update.php"><strong>Update</strong></a> - Edit a registered car
        </li>
        <li>
            <a href="CRUD/delete.php"><strong>Delete</strong></a> - Delete a registered car
        </li>
    </ul>

    <a href="logout.php" class="btn">Logout</a>
</main>

<?php require "CarRental/layout/footer.php"; ?>

</body>
</html>
