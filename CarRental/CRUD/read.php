<?php
$host   = 'localhost';
$port   = 3307;
$dbName = 'CarRentalDB';
$user   = 'root';
$pass   = '';
$conn = mysqli_connect($host, $user, $pass, $dbName, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql    = "SELECT * FROM Car";
$result = mysqli_query($conn, $sql);
$cars   = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>All Cars</title>
    <style>
        table {
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #666;
            padding: 8px;
        }
        th {
            background: #eee;
        }
        .actions a {
            margin-right: 5px;
        }
        .create-link {
            display: block;
            text-align: center;
            margin: 20px;
        }
    </style>
</head>
<body>
<h2 style="text-align:center;">All Cars</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>RegNumber</th>
        <th>PricePerDay</th>
        <th>EngineType</th>
        <th>AvailabilityStatus</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($cars as $car): ?>
        <tr>
            <td><?php echo $car['id']; ?></td>
            <td><?php echo htmlspecialchars($car['Make']); ?></td>
            <td><?php echo htmlspecialchars($car['Model']); ?></td>
            <td><?php echo htmlspecialchars($car['Year']); ?></td>
            <td><?php echo htmlspecialchars($car['RegNumber']); ?></td>
            <td><?php echo htmlspecialchars($car['PricePerDay']); ?></td>
            <td><?php echo htmlspecialchars($car['EngineType']); ?></td>
            <td><?php echo htmlspecialchars($car['AvailabilityStatus']); ?></td>
            <td class="actions">
                <a href="update.php?id=<?php echo $car['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $car['id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this car?');">
                    Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="create-link">
    <a href="admin.php">Go Back to Admin Page</a>
</div>
</body>
</html>
