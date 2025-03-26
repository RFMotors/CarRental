<?php
require_once '../config/DBconnect.php';
require_once '../classes/Car.php';

$carObj = new Car($conn);
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $regNumber = $_POST['regNumber'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $image = "";

    if (!empty($_FILES['car_image']['name'])) {
        $imageDir = "../uploads/";
        $imageName = time() . "_" . basename($_FILES["car_image"]["name"]);
        $imagePath = $imageDir . $imageName;

        if (!is_dir($imageDir)) {
            mkdir($imageDir, 0777, true);
        }

        if (move_uploaded_file($_FILES["car_image"]["tmp_name"], $imagePath)) {
            $image = $imageName;
        } else {
            $message = "<div class='error'>Error uploading image.</div>";
        }
    }

    if ($carObj->createCar($make, $model, $year, $regNumber, $price, $status, $image)) {
        $message = "<div class='message'>Car added successfully!</div>";
    } else {
        $message = "<div class='error'>Error adding car.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <link rel="stylesheet" href="../css/crud.css">
</head>
<body>

<?= $message; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Make:</label>
    <input type="text" name="make" required><br>

    <label>Model:</label>
    <input type="text" name="model" required><br>

    <label>Year:</label>
    <input type="number" name="year" required><br>

    <label>Registration Number:</label>
    <input type="text" name="regNumber" required><br>

    <label>Price Per Day:</label>
    <input type="number" name="price" step="0.01" required><br>

    <label>Status:</label>
    <select name="status" required>
        <option value="Available">Available</option>
        <option value="Rented">Rented</option>
    </select><br>

    <label>Upload Image:</label>
    <input type="file" name="car_image" accept="image/*"><br>

    <button type="submit">Add Car</button>
</form>

</body>
</html>
