<?php
require_once '../../template/header.php';
require_once '../../config/config.php';
require_once '../../classes/Car.php';

use classes\Car;

$carObj = new Car($pdo);

if (!isset($_SESSION['UserID']) || $_SESSION['isAdmin'] != 1) {
    die("<p style='color: red;'>❌ Admin access only.</p>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $make = trim($_POST['make']);
    $model = trim($_POST['model']);
    $year = intval($_POST['year']);
    $rentalPrice = floatval($_POST['rentalPrice']);
    $availabilityStatus = intval($_POST['availabilityStatus']);
    $description = trim($_POST['description']);

    $image = '';
    $image = getImageName($image);

    if ($carObj->createCar($make, $model, $year, $rentalPrice, $availabilityStatus, $image, $description)) {
        header('Location: manageCars.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Car</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<main class="container">
    <h2>Add New Car</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="make" placeholder="Make" required>
        <input type="text" name="model" placeholder="Model" required>
        <input type="number" name="year" placeholder="Year" required>
        <input type="number" step="0.01" name="rentalPrice" placeholder="Rental Price (€)" required>
        <textarea name="description" placeholder="Car Description" rows="4" required></textarea>
        <select name="availabilityStatus" required>
            <option value="0">Available</option>
            <option value="1">Rented</option>
        </select>
        <input type="file" name="car_image" accept="image/*">
        <button type="submit" class="btn">Add Car</button>
    </form>

    <br><a href="manageCars.php" class="btn">Back to Manage Cars</a>
</main>
<?php require_once '../../template/footer.php'; ?>
</body>
</html>
