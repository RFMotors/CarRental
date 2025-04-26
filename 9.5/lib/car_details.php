<?php
require_once '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Car.php';

use classes\Car;

$carObj = new Car($pdo);

if (!isset($_GET['id'])) {
    echo "<p>⚠️ Invalid request.</p><a href='../index.php'>⬅ Back to Home</a>";
    exit;
}

$carID = intval($_GET['id']);
$car = $carObj->getCarById($carID);

if (!$car) {
    echo "<p>❌ Car not found.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Details</title>
    <link rel="stylesheet" href="../css/Cardetails.css">
</head>
<body>

<main>
    <?php if (!empty($car['image']) && file_exists("../uploads/" . $car['image'])): ?>
        <img src="../uploads/<?= htmlspecialchars($car['image']) ?>" alt="Car Image" class="car-image">
    <?php endif; ?>

    <h2><?= htmlspecialchars($car['make']) ?> <?= htmlspecialchars($car['model']) ?></h2>
    <p>Year: <?= htmlspecialchars($car['year']) ?></p>
    <p>Price: €<?= number_format($car['rentalPrice'], 2) ?> per day</p>
    <p>Status: <?= $car['availabilityStatus'] == 0 ? "Available" : "Rented" ?></p>

    <p>Description: <?= nl2br(htmlspecialchars($car['description'] ?? "No description provided.")) ?></p>

    <?php if ($car['availabilityStatus'] == 0): ?>
        <a href="book_car.php?id=<?= $car['carID'] ?>" class="btn">Book This Car</a>
    <?php endif; ?>

    <br><br><a href="../index.php" class="btn">⬅ Back to Home</a>
</main>

<?php require_once '../template/footer.php'; ?>

</body>
</html>