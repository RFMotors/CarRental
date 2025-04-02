<?php
session_start(); // Start the session

require_once '../../config/common.php';
require_once '../../config/DBconnect.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../../login.php"); // Redirect to login if not admin
    exit();
}

try {
    $sql = "SELECT * FROM cars ORDER BY carID ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $error) {
    die("Error fetching cars: " . $error->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Cars - Admin</title>
    <link rel="stylesheet" href="../../css/crud.css">
</head>
<body>

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
            <td><?php echo htmlspecialchars($row["carID"]); ?></td>
            <td><?php echo htmlspecialchars($row["make"]); ?></td>
            <td><?php echo htmlspecialchars($row["model"]); ?></td>
            <td><?php echo htmlspecialchars($row["year"]); ?></td>
            <td><?php echo htmlspecialchars($row["regNumber"]); ?></td>
            <td>$<?php echo htmlspecialchars($row["rentalPrice"]); ?></td>
            <td><?php echo htmlspecialchars($row["availabilityStatus"]); ?></td>
            <td>
                <a href="update_single.php?id=<?php echo htmlspecialchars($row["carID"]); ?>">Edit</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="../dashboard.php">Back to Dashboard</a>

</body>
</html>
