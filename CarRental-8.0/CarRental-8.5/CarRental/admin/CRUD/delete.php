<?php
require_once '../../config/DBconnect.php';
require_once '../../config/common.php';

$success = "";

// Check if an ID is provided for deletion
if (isset($_GET["id"])) {
    try {
        $carID = intval($_GET["id"]); // Sanitize input

        // Delete car from database
        $sql = "DELETE FROM cars WHERE carID = ?";
        $statement = $conn->prepare($sql);
        $statement->bind_param("i", $carID);
        $statement->execute();

        if ($statement->affected_rows > 0) {
            $success = "Car ID " . htmlspecialchars($carID) . " successfully deleted.";
        } else {
            $success = "Error: Car not found or already deleted.";
        }
    } catch (mysqli_sql_exception $error) {
        $success = "Error deleting car: " . $error->getMessage();
    }
}

// Fetch all cars for display
try {
    $sql = "SELECT * FROM cars";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $cars = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $error) {
    die("Error fetching cars: " . $error->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Car</title>
    <link rel="stylesheet" href="../../css/crud.css">
</head>
<body>

<h2>Delete Cars</h2>

<?php if (!empty($success)): ?>
    <p style="color: green; font-weight: bold;"><?php echo $success; ?></p>
<?php endif; ?>

<table>
    <thead>
    <tr>
        <th>Car ID</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Reg Number</th>
        <th>Price Per Day</th>
        <th>Status</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($cars as $car) : ?>
        <tr>
            <td><?php echo htmlspecialchars($car["carID"]); ?></td>
            <td><?php echo htmlspecialchars($car["make"]); ?></td>
            <td><?php echo htmlspecialchars($car["model"]); ?></td>
            <td><?php echo htmlspecialchars($car["year"]); ?></td>
            <td><?php echo htmlspecialchars($car["regNumber"]); ?></td>
            <td>$<?php echo htmlspecialchars($car["rentalPrice"]); ?></td>
            <td><?php echo htmlspecialchars($car["availabilityStatus"]); ?></td>
            <td>
                <a href="delete.php?id=<?php echo htmlspecialchars($car["carID"]); ?>"
                   onclick="return confirm('Are you sure you want to delete this car?');">
                    Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="../dashboard.php">Back to Admin Dashboard</a>

</body>
</html>
