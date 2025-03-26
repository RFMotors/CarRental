<?php
require_once '../config/common.php';
require_once '../config/DBconnect.php';

$cars = [];

if (isset($_POST['submit'])) {
    try {
        $sql = "SELECT * FROM Car WHERE AvailabilityStatus = ?";
        $status = $_POST['status'];
        $statement = $conn->prepare($sql);
        $statement->bind_param("s", $status);
        $statement->execute();
        $result = $statement->get_result();
        $cars = $result->fetch_all(MYSQLI_ASSOC);
    } catch (mysqli_sql_exception $error) {
        echo "Error fetching cars: " . $error->getMessage();
    }
}
?>

<h2>Search Cars by Availability</h2>
<link rel="stylesheet" href="../css/read.css">
<form method="post">
    <label for="status">Select Availability:</label>
    <select name="status" id="status">
        <option value="Available">Available</option>
        <option value="Rented">Rented</option>
    </select>
    <input type="submit" name="submit" value="View Results">
</form>

<?php if (isset($_POST['submit'])): ?>
    <?php if (!empty($cars)): ?>
        <h2>Results</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Car ID</th>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Reg Number</th>
                <th>Price Per Day</th>
                <th>Status</th>
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
                    <td>$<?php echo number_format($car["PricePerDay"], 2); ?></td>
                    <td><?php echo htmlspecialchars($car["AvailabilityStatus"]); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No cars found for status: <strong><?php echo htmlspecialchars($_POST['status']); ?></strong>.</p>
    <?php endif; ?>
<?php endif; ?>

<a href="../admin/dashboard.php">Back to Admin Dashboard</a>
