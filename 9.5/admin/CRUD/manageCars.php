<?php
require_once '../../template/header.php';
require_once '../../config/config.php';
require_once '../../classes/Car.php';

use classes\Car;

$carObj = new Car($pdo);
$cars = $carObj->getAllCars();

if (!isset($_SESSION['UserID']) || $_SESSION['isAdmin'] != 1) {
    die("<p style='color: red;'> Admin access only.</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Cars</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<main class="container">
    <h2>Manage Cars</h2>

    <a href="addCar.php" class="btn">+ Add New Car</a>

    <table class="admin-table">
        <thead>
        <tr>
            <th>ID</th><th>Make</th><th>Model</th><th>Price</th><th>Status</th><th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cars as $car): ?>
            <tr>
                <td><?= $car['carID'] ?></td>
                <td><?= htmlspecialchars($car['make']) ?></td>
                <td><?= htmlspecialchars($car['model']) ?></td>
                <td>€<?= number_format($car['rentalPrice'], 2) ?></td>
                <td><?= $car['availabilityStatus'] == 0 ? "Available" : "Rented" ?></td>
                <td>
                    <a href="updateCar.php?id=<?= $car['carID'] ?>" class="btn">Edit</a>
                    |
                    <a href="deleteCar.php?id=<?= $car['carID'] ?>" class="btn" style="color:red;" onclick="return confirm('⚠️ Are you sure you want to delete this car?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <br><a href="../dashboard.php" class="btn">⬅ Back to Admin Dashboard</a>
</main>
<?php require_once '../../template/footer.php'; ?>
</body>
</html>
