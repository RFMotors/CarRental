<?php
require_once '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Car.php';

use classes\Car;

$carObj = new Car($pdo);

if (!isset($_GET['id'])) {
    echo "<p class='error'>Invalid car selection.</p><a href='../index.php' class='btn'>⬅ Back to Home</a>";
    exit;
}

$carID = intval($_GET['id']);
$car = $carObj->getCarById($carID);

if (!$car) {
    echo "<p class='error'>Car not found.</p><a href='../index.php' class='btn'>⬅ Back to Home</a>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Details - <?= htmlspecialchars($car['make']) ?> <?= htmlspecialchars($car['model']) ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main class="container">
    <div class="car-details-card">
        <?php if (!empty($car['image']) && file_exists("../uploads/" . $car['image'])): ?>
            <img src="../uploads/<?= htmlspecialchars($car['image']) ?>" alt="Car Image" class="car-details-image">
        <?php else: ?>
            <img src="../images/no-image.jpg" alt="No Image" class="car-details-image">
        <?php endif; ?>

        <div class="car-info">
            <h2><?= htmlspecialchars($car['make']) ?> <?= htmlspecialchars($car['model']) ?></h2>
            <p><strong>Year:</strong> <?= htmlspecialchars($car['year']) ?></p>
            <p><strong>Price per day:</strong> €<?= number_format($car['rentalPrice'], 2) ?></p>
            <p><strong>Status:</strong> <?= $car['availabilityStatus'] == 0 ? "Available" : "Rented" ?></p>
            <p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($car['description'])) ?></p>

            <?php if ($car['availabilityStatus'] == 0): ?>
                <a href="book_car.php?id=<?= $car['carID'] ?>" class="btn">Book This Car</a>
            <?php else: ?>
                <p class="error">This car is currently rented.</p>
            <?php endif; ?>
        </div>
    </div>

    <br><a href="../index.php" class="btn"><--Back to Home</a>
</main>

<?php require_once '../template/footer.php'; ?>
</body>
</html>
