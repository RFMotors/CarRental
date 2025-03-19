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

$carToEdit = [
    'id'                => '',
    'Make'              => '',
    'Model'             => '',
    'Year'              => '',
    'RegNumber'         => '',
    'PricePerDay'       => '',
    'EngineType'        => '',
    'AvailabilityStatus'=> ''
];

if (isset($_GET['id'])) {
    $idToEdit = $_GET['id'];
    $sql  = "SELECT * FROM Car WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idToEdit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $carToEdit = $row;
    }
    mysqli_stmt_close($stmt);
} else {
    // Redirect to read.php if no ID provided
    header("Location: read.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id                 = $_POST['id'];
    $Make               = $_POST['Make'];
    $Model              = $_POST['Model'];
    $Year               = $_POST['Year'];
    $RegNumber          = $_POST['RegNumber'];
    $PricePerDay        = $_POST['PricePerDay'];
    $EngineType         = $_POST['EngineType'];
    $AvailabilityStatus = $_POST['AvailabilityStatus'];

    $sql  = "UPDATE Car
             SET Make = ?, Model = ?, Year = ?, RegNumber = ?, PricePerDay = ?, EngineType = ?, AvailabilityStatus = ?
             WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "ssssdssi",
        $Make,
        $Model,
        $Year,
        $RegNumber,
        $PricePerDay,
        $EngineType,
        $AvailabilityStatus,
        $id
    );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // After successful update, redirect to read.php
    header("Location: read.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update Car</title>
    <style>
        form {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], input[type="date"], input[type="number"] {
            width: 100%;
        }
    </style>
</head>
<body>
<h2 style="text-align:center;">
    Update Car ID: <?php echo htmlspecialchars($carToEdit['id']); ?>
</h2>
<form method="POST" action="update.php?id=<?php echo htmlspecialchars($carToEdit['id']); ?>">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($carToEdit['id']); ?>">
    <label>Make:</label>
    <input type="text" name="Make" required
           value="<?php echo htmlspecialchars($carToEdit['Make']); ?>">
    <label>Model:</label>
    <input type="text" name="Model" required
           value="<?php echo htmlspecialchars($carToEdit['Model']); ?>">
    <label>Year (YYYY-MM-DD):</label>
    <input type="date" name="Year" required
           value="<?php echo htmlspecialchars($carToEdit['Year']); ?>">
    <label>RegNumber:</label>
    <input type="text" name="RegNumber" required
           value="<?php echo htmlspecialchars($carToEdit['RegNumber']); ?>">
    <label>PricePerDay:</label>
    <input type="number" step="0.01" name="PricePerDay" required
           value="<?php echo htmlspecialchars($carToEdit['PricePerDay']); ?>">
    <label>EngineType:</label>
    <input type="text" name="EngineType" required
           value="<?php echo htmlspecialchars($carToEdit['EngineType']); ?>">
    <label>AvailabilityStatus:</label>
    <input type="text" name="AvailabilityStatus" required
           value="<?php echo htmlspecialchars($carToEdit['AvailabilityStatus']); ?>">
    <br><br>
    <button type="submit" name="update">Update Car</button>
</form>
<p style="text-align:center;">
    <a href="admin.php">Go Back to Admin Page</a>
</p>
</body>
</html>
