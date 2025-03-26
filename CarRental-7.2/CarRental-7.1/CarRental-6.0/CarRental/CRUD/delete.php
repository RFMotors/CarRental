<?php
require_once '../config/common.php';
$success = "";

if (isset($_GET["id"])) {
    try {
        require_once '../config/DBconnect.php';
        $carID = $_GET["id"];

        $sql = "DELETE FROM Car WHERE CarID = ?";
        $statement = $conn->prepare($sql);
        $statement->bind_param("i", $carID);
        $statement->execute();

        if ($statement->affected_rows > 0) {
            $success = "Car ID " . htmlspecialchars($carID) . " successfully deleted.";
        } else {
            $success = "Error: Car not found or already deleted.";
        }
    } catch (mysqli_sql_exception $error) {
        echo "Error deleting car: " . $error->getMessage();
    }
}

try {
    require_once '../config/DBconnect.php';
    $sql = "SELECT * FROM Car";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $cars = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $error) {
    echo "Error fetching cars: " . $error->getMessage();
}
?>

<link rel="stylesheet" href="../css/crud.css">
<h2>Delete Cars</h2>

<?php if ($success) echo "<p style='color: green; font-weight: bold;'>$success</p>"; ?>

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
            <td><?php echo htmlspecialchars($car["CarID"]); ?></td>
            <td><?php echo htmlspecialchars($car["Make"]); ?></td>
            <td><?php echo htmlspecialchars($car["Model"]); ?></td>
            <td><?php echo htmlspecialchars($car["Year"]); ?></td>
            <td><?php echo htmlspecialchars($car["RegNumber"]); ?></td>
            <td>$<?php echo htmlspecialchars($car["PricePerDay"]); ?></td>
            <td><?php echo htmlspecialchars($car["AvailabilityStatus"]); ?></td>
            <td><a href="delete.php?id=<?php echo htmlspecialchars($car["CarID"]); ?>" onclick="return confirm('Are you sure you want to delete this car?');">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="../admin/dashboard.php">Back to Admin Dashboard</a>

