<?php
require_once 'config/config.php';
require_once 'classes/Car.php';
require_once 'template/header.php';
require_once 'template/searchbar.php';

use classes\Car;

$carObj = new Car($pdo);

// Get search inputs
$search = isset($_GET['query']) ? trim($_GET['query']) : '';
$sortPrice = isset($_GET['sort_price']);
$onlyAvailable = isset($_GET['only_available']);

$cars = $carObj->searchCars($search, $sortPrice, $onlyAvailable);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Cars - RF Motors</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<main class="container">
    <h2>Available Cars</h2>

    <div class="row">
        <?php if (empty($cars)): ?>
            <p style="color: red;">❌ No cars available at the moment.</p>
        <?php else: ?>
            <?php foreach ($cars as $car): ?>
                <div class="car-list-item">
                    <h3><?= htmlspecialchars($car['make']) . ' ' . htmlspecialchars($car['model']) ?></h3>
                    <p>Year: <?= htmlspecialchars($car['year']) ?></p>
                    <p>Price: €<?= number_format($car['rentalPrice'], 2) ?> / day</p>
                    <p>Status: <?= $car['availabilityStatus'] == 0 ? 'Available' : 'Rented' ?></p>

                    <?php if (!empty($car['image']) && file_exists("uploads/" . $car['image'])): ?>
                        <img src="uploads/<?= htmlspecialchars($car['image']) ?>" alt="Car Image" class="car-thumb">
                    <?php else: ?>
                        <img src="images/no-image.jpg" alt="No Image" class="car-thumb">
                    <?php endif; ?>

                    <br>
                    <a href="lib/car_details.php?id=<?= $car['carID'] ?>" class="btn">View Details</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="user-options">
        <?php if (!isset($_SESSION['UserID'])): ?>
            <p><a href="login.php">Login</a> or <a href="register.php">Register</a> to book a car.</p>
        <?php else: ?>
            <p>Welcome, <strong><?= htmlspecialchars($_SESSION['UserName']) ?></strong>!</p>
            <a href="logout.php" class="btn">Logout</a>
        <?php endif; ?>
    </div>
</main>

<?php require_once 'template/footer.php'; ?>
</body>
</html>