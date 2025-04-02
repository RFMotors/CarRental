<?php
session_start();

require_once '../../classes/Admin.php';

use classes\Admin;

$admin = new Admin();
$message = "";

if (!isset($_SESSION['userID'])) {
    die("<div class='error'>You must be logged in as an admin to access this page.</div>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_SESSION['userID'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $regNumber = $_POST['regNumber'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $image = "";

    if (!empty($_FILES['car_image']['name'])) {
        $imageDir = "../../uploads/";
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

    if ($admin->addCar($userID, $make, $model, $year, $regNumber, $price, $status, $image)) {
        $message = "<div class='message'>✅ Car added successfully!</div>";
    } else {
        $message = "<div class='error'>❌ Error adding car.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Car</title>
    <link rel="stylesheet" href="../../css/crud.css">
</head>
<body>

<?= $message; ?>

<h2>Add a New Car</h2>

<form method="POST" enctype="multipart/form-data">
    <label>Make:</label><br>
    <input type="text" name="make" required><br>

    <label>Model:</label><br>
    <input type="text" name="model" required><br>

    <label>Year:</label><br>
    <input type="number" name="year" required><br>

    <label>Registration Number:</label><br>
    <input type="text" name="regNumber" required><br>

    <label>Price Per Day:</label><br>
    <input type="number" name="price" step="0.01" required><br>

    <label>Status:</label><br>
    <select name="status" required>
        <option value="Available">Available</option>
        <option value="Rented">Rented</option>
    </select><br>

    <label>Upload Image:</label><br>
    <input type="file" name="car_image" accept="image/*"><br><br>

    <button type="submit">Add Car</button>
</form>

<a href="../dashboard.php">Back to Admin Dashboard</a>

</body>
</html>
