<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Car Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<?php require 'layout/header.php'; ?>
<main>
    <?php require 'layout/searchbar.php'; ?>
    <!-- Featured Cars Block -->
    <div class="container">
        <div class="row">
            <?php
            require 'lib/functions.php';
            $cars = get_cars();

            if (!$cars) {
                echo "<p>Error: No cars found.</p>";
            } else {
                foreach ($cars as $car) {
                    echo display_car($car);
                }
            }
            ?>
        </div>
    </div>
</main>
<?php require 'layout/footer.php'; ?>
</html>
