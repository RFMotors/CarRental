<?php

try {
    require_once '../config/common.php';
    require_once '../config/DBconnect.php';

    $sql = "SELECT * FROM Car";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $error) {
    echo "Error fetching cars: " . $error->getMessage();
}
?>
<link rel="stylesheet" href="../css/crud.css">
<h2>Update Cars</h2>

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
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo htmlspecialchars($row["CarID"]); ?></td>
            <td><?php echo htmlspecialchars($row["Make"]); ?></td>
            <td><?php echo htmlspecialchars($row["Model"]); ?></td>
            <td><?php echo htmlspecialchars($row["Year"]); ?></td>
            <td><?php echo htmlspecialchars($row["RegNumber"]); ?></td>
            <td>$<?php echo htmlspecialchars($row["PricePerDay"]); ?></td>
            <td><?php echo htmlspecialchars($row["AvailabilityStatus"]); ?></td>
            <td><a href="update_single.php?id=<?php echo htmlspecialchars($row["CarID"]); ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="../admin/dashboard.php">Back to Dashboard</a>


