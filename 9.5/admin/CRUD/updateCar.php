<?php
require_once '../../template/header.php';
require_once '../../config/config.php';
require_once '../../classes/Car.php';

use classes\Car;

$carObj = new Car($pdo);

if (!isset($_SESSION['UserID']) || $_SESSION['isAdmin'] != 1) {
    die("<p style='color: red;'>❌ Admin access only.</p>");
}

if (!isset($_GET['id'])) {
    die('⚠️ Car ID is required.');
}

$carID = intval($_GET['id']);
$car = $carObj->getCarById($carID);

/**
 * @param string $image
 * @return string
 */
function getImageName(string $image): string
{
    if (!empty($_FILES['car_image']['name'])) {
        $uploadDir = '../../uploads/';
        $imageName = time() . '_' . basename($_FILES['car_image']['name']);
        $uploadPath = $uploadDir . $imageName;
        if (move_uploaded_file($_FILES['car_image']['tmp_name'], $uploadPath)) {
            $image = $imageName;
        }
    }
    return $image;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = trim($_POST['model']);
    $year = intval($_POST['year']);
    $rentalPrice = floatval($_POST['rentalPrice']);
    $availabilityStatus = intval($_POST['availabilityStatus']);
    $description = trim($_POST['description']);

    $image = $car['image'];
    $image = getImageName($image);

    if ($carObj->updateCar($carID, $make, $model, $year, $rentalPrice, $availabilityStatus, $image, $description)) {
        header('Location: manageCars.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Car</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<main class="container">
    <h2>Edit Car</h2>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="make" value="<?= htmlspecialchars($car['make']) ?>" required>
        <input type="text" name="model" value="<?= htmlspecialchars($car['model']) ?>" required>
        <input type="number" name="year" value="<?= $car['year'] ?>" required>
        <input type="number" step="0.01" name="rentalPrice" value="<?= $car['rentalPrice'] ?>" required>
        <textarea name="description" required><?= htmlspecialchars($car['description']) ?></textarea>
        <select name="availabilityStatus" required>
            <option value="0" <?= $car['availabilityStatus'] == 0 ? 'selected' : '' ?>>Available</option>
            <option value="1" <?= $car['availabilityStatus'] == 1 ? 'selected' : '' ?>>Rented</option>
        </select>
        <input type="file" name="car_image" accept="image/*">
        <button type="submit" class="btn">Update Car</button>
    </form>

    <br><a href="manageCars.php" class="btn">Back to Manage Cars</a>
</main>
<?php require_once '../../template/footer.php'; ?>
</body>
</html>
