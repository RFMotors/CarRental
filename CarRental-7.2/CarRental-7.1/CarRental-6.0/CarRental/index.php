<?php
session_start();
require_once 'config/DBconnect.php';
require_once 'classes/Car.php';

//Initialize Car object
$carObj = new Car($conn);
$cars = $carObj->getAllCars();

//Check if a user is logged in
$isClientLoggedIn = isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'client';
$isAdminLoggedIn = isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require 'layout/header.php'; ?>

<main>
    <?php require 'layout/searchbar.php'; ?>

    <div class="container">
        <h2>Available Cars</h2>

        <div class="row">
            <?php
            if (!$cars) {
                echo "<p style='color: red;'>No cars available at the moment.</p>";
            } else {
                foreach ($cars as $car) {
                    // ✅ Set the correct image path
                    $imagePath = (!empty($car['Image']) && file_exists("uploads/" . $car['Image']))
                        ? "uploads/" . htmlspecialchars($car['Image'])
                        : "images/default_car.jpg";

                    echo "
                    <div class='car-list-item'>
                        <img src='$imagePath' alt='{$car['Make']} {$car['Model']}' width='250' height='150'>
                        <h3>{$car['Make']} {$car['Model']}</h3>
                        <p>Year: {$car['Year']}</p>
                        <p>Price: $ {$car['PricePerDay']} / day</p>
                        <p>Status: {$car['AvailabilityStatus']}</p>
                        <a href='lib/car_details.php?id={$car['CarID']}' class='btn'>View Details</a>";

                    // ✅ Show "Book Car" button only for logged-in clients
                    if ($isClientLoggedIn) {
                        echo "<a href='lib/book_car.php?id={$car['CarID']}' class='btn'>Book This Car</a>";
                    }

                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>

    <div class="user-options">
        <?php if (!$isClientLoggedIn && !$isAdminLoggedIn): ?>
            <p><a href="login.php">Login</a> or <a href="register.php">Register</a> to book a car.</p>
        <?php endif; ?>

        <?php if ($isClientLoggedIn): ?>
            <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['client_name']); ?></strong>!</p>
            <a href="client/dashboard.php" class="btn">Client Dashboard</a>
            <a href="logout.php" class="btn">Logout</a>
        <?php elseif ($isAdminLoggedIn): ?>
            <p>Welcome, Admin <strong><?php echo htmlspecialchars($_SESSION['admin_name']); ?></strong>!</p>
            <a href="admin/dashboard.php" class="btn">Admin Dashboard</a>
            <a href="logout.php" class="btn">Logout</a>
        <?php endif; ?>
    </div>
</main>

<?php require 'layout/footer.php'; ?>

</body>
</html>
