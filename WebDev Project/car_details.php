<?php
require 'lib/functions.php';

// Get car ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid car ID.");
}

$car_id = (int) $_GET['id']; // Convert to integer
$cars = get_cars(); // Fetch all cars

// Find the car by ID
$selected_car = null;
foreach ($cars as $car) {
    if ($car['id'] === $car_id) {
        $selected_car = $car;
        break;
    }
}

// If car not found
if (!$selected_car) {
    die("Car not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $selected_car['name']; ?> Details</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php require 'layout/header.php'; ?>

<main>
    <div class="car-details-page">
        <h1><?php echo $selected_car['name']; ?></h1>
        <img src="<?php echo $selected_car['image']; ?>" alt="Car Image">
        <p><strong>Status:</strong> <?php echo $selected_car['status']; ?></p>
        <p><strong>Year:</strong> <?php echo $selected_car['year']; ?></p>
        <p><strong>Engine Type:</strong> <?php echo $selected_car['engineType']; ?></p>
        <p><strong>Price:</strong> $<?php echo $selected_car['price']; ?></p>
        <p><strong>Description:</strong> <?php echo $selected_car['bio']; ?></p>
    </div>
</main>

<?php require 'layout/footer.php'; ?>

</body>
</html>
