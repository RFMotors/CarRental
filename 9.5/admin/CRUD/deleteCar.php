<?php
require_once '../../template/header.php';
require_once '../../config/config.php';
require_once '../../classes/Car.php';

use classes\Car;

// Check admin login
if (!isset($_SESSION['UserID']) || $_SESSION['isAdmin'] != 1) {
    die("<p style='color: red;'>❌ Admin access only.</p>");
}

// Check if car ID is passed
if (!isset($_GET['id'])) {
    die("<p style='color: red;'>⚠No car selected for deletion.</p>");
}

$carID = intval($_GET['id']);

$carObj = new Car($pdo);

// ✅ Delete the car
if ($carObj->deleteCar($carID)) {
    echo "<p style='color: green;'>Car deleted successfully.</p>";
} else {
    echo "<p style='color: red;'>Failed to delete car. It might not exist.</p>";
}

echo "<br><a href='manageCars.php' class='btn'>⬅ Back to Manage Cars</a>";

require_once '../../template/footer.php';
?>
