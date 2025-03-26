<?php
session_start();
require_once __DIR__ . '/../config/DBconnect.php';

//Check if Car ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("<p style='color: red;'>Error: No Car ID provided.</p>");
}

$carID = $_GET['id'];

try {
    $sql = "SELECT * FROM Car WHERE CarID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $carID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("<p style='color: red;'>Error: Car not found.</p>");
    }

    $car = $result->fetch_assoc();
} catch (mysqli_sql_exception $error) {
    die("<p style='color: red;'>Error fetching car details: " . htmlspecialchars($error->getMessage()) . "</p>");
}

// Set image path with fallback
$imagePath = (!empty($car['Image']) && file_exists("../uploads/" . $car['Image']))
    ? "../uploads/" . htmlspecialchars($car['Image'])
    : "../images/default_car.jpg";

//Check if user is logged in and is a client
$isClientLoggedIn = isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'client';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($car['Make']) . " " . htmlspecialchars($car['Model']); ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php require 'header.php'; ?>

<main>
    <div class="container car-details-page">
        <h2><?php echo htmlspecialchars($car['Make']) . " " . htmlspecialchars($car['Model']); ?></h2>
        <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($car['Make']) . " " . htmlspecialchars($car['Model']); ?>" width="300">

        <p><strong>Year:</strong> <?php echo htmlspecialchars($car['Year']); ?></p>
        <p><strong>Registration Number:</strong> <?php echo htmlspecialchars($car['RegNumber']); ?></p>
        <p><strong>Price Per Day:</strong> $<?php echo htmlspecialchars($car['PricePerDay']); ?></p>
        <p><strong>Engine Type:</strong> <?php echo htmlspecialchars($car['EngineType']); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($car['AvailabilityStatus']); ?></p>

        <?php if ($isClientLoggedIn): ?>
            <a href="book_car.php?id=<?php echo htmlspecialchars($car['CarID']); ?>" class="btn">Book Now</a>
        <?php else: ?>
            <p style="color: red;">You must <a href="../login.php">log in</a> as a client to book this car.</p>
        <?php endif; ?>
    </div>
</main>

<?php require 'footer.php'; ?>

</body>
</html>
