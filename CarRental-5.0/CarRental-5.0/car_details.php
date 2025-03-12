<?php require 'lib/functions.php';
$selected_car = get_car_id($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $selected_car['name']; ?> Details</title>
    <link rel="stylesheet" href="/css/cardetails.css">
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
        <br>
        <button><a href="PaymentPage.php">Rent</a></button>
    </div>
</main>

<?php require 'layout/footer.php'; ?>

</body>
</html>
