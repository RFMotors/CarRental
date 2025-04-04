<?php
require_once '../config/DBconnect.php';
require_once '../classes/Car.php';

use classes\Car;
$carObj = new Car($conn);


if (isset($_GET['id'])) {
    $carID = $_GET['id'];
    $car = $carObj->getCarDetails($carID);

    if ($car) {
        echo "<h2>{$car['make']} {$car['model']}</h2>";
        echo "<p>Year: {$car['year']}</p>";
        echo "<p>Price: $ {$car['rentalPrice']} / day</p>";
        echo "<p>Status: " . ($car['availabilityStatus'] == 0 ? "Available" : "Rented") . "</p>";


        if (!empty($car['image']) && file_exists("../uploads/" . $car['image'])) {
            echo "<img src='../uploads/{$car['image']}' alt='Car Image' class='car-image'>";
        }

        if ($car['availabilityStatus'] === 'Available') {
            echo "<a href='book_car.php?id={$car['carID']}' class='btn'>Book This Car</a>";
        }
    } else {
        echo "Car not found.";
    }
} else {
    echo "Invalid request.";
}
echo "<br><br><a href='../index.php' class='btn'>Back to Home</a>";

?>
<main>
<link rel="stylesheet" href="../css/Cardetails.css">
</main>