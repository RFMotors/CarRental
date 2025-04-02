<?php
session_start();
require_once 'config/DBconnect.php';
require_once 'classes/Car.php';

use classes\Car;

$carObj = new Car($conn);
$cars = $carObj->getAllCars();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/headerFooter.css">
</head>
<body>

<?php require 'layout/header.php'; ?>

<main>
    <div class="container">
        <h2>Available Cars</h2>

        <div class="row">
            <?php
            if (!$cars || count($cars) === 0) {
                echo "<p style='color: red;'>No cars available at the moment.</p>";
            } else {
                foreach ($cars as $car) {
                    echo "
                    <div class='car-list-item'>
                        <h3>{$car['make']} {$car['model']}</h3>
                        <p>Year: {$car['year']}</p>
                        <p>Price: $ {$car['rentalPrice']} / day</p>
                        <p>Status: " . ($car['availabilityStatus'] == 0 ? "Available" : "Rented") . "</p>";

                    if (!empty($car['image']) && file_exists("uploads/" . $car['image'])) {
                        echo "<img src='uploads/{$car['image']}' alt='Car Image' class='car-thumb'>";
                    } else {
                        echo "<img src='images/no-image.jpg' alt='No Image' class='car-thumb'>";
                    }

                    echo "<br><a href='lib/car_details.php?id={$car['carID']}' class='btn'>View Details</a>
                    </div>";
                }
            }
            ?>
        </div>
    </div>

    <div class="user-options">
        <?php if (!isset($_SESSION['userID'])): ?>
            <p><a href="login.php">Login</a> or <a href="register.php">Register</a> to book a car.</p>
        <?php else: ?>
            <p>Welcome, <strong><?= htmlspecialchars($_SESSION['name']) ?></strong>!</p>
            <a href="logout.php" class="btn">Logout</a>
        <?php endif; ?>
    </div>
</main>

<?php require 'layout/footer.php'; ?>

</body>
</html>
