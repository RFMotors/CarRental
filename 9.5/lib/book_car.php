<?php
require_once '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Car.php';
require_once '../classes/Booking.php';

use classes\Car;
use classes\Booking;

$carObj = new Car($pdo);
$bookingObj = new Booking($pdo);
$message = "";

// ✅ Check car ID
if (!isset($_GET['id'])) {
    echo "<p>⚠️ Invalid car selection.</p><a href='../index.php'>⬅ Back to Home</a>";
    exit;
}

$carID = intval($_GET['id']);
$car = $carObj->getCarById($carID);

if (!$car) {
    echo "<p>❌ Car not found.</p>";
    exit;
}

// ✅ If user is NOT logged in, save intended car and redirect to login
if (!isset($_SESSION['UserID'])) {
    $_SESSION['intendedCar'] = $carID;
    header("Location: /login.php");
    exit;
}

// ✅ If user is logged in and submits booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = $_POST['startDate'];
    $days = intval($_POST['days']);
    $userID = $_SESSION['UserID'];

    $endDate = date('Y-m-d', strtotime("$startDate +$days days"));
    $totalCost = $bookingObj->calculateTotalCost($startDate, $endDate, $car['rentalPrice']);

    $_SESSION['bookingDraft'] = [
        'carID' => $carID,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'totalCost' => $totalCost,
        'days' => $days
    ];

    header("Location: paymentPage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book <?= htmlspecialchars($car['make']) ?> <?= htmlspecialchars($car['model']) ?></title>
    <link rel="stylesheet" href="../css/book_car.css">
    <script>
        function updateCost() {
            const days = parseInt(document.getElementById('days').value) || 0;
            const price = parseFloat(<?= $car['rentalPrice'] ?>);
            const total = days * price;
            document.getElementById('costDisplay').textContent = total.toFixed(2);
        }
    </script>
</head>
<body>

<h2>Book <?= htmlspecialchars($car['make']) ?> <?= htmlspecialchars($car['model']) ?></h2>

<?php if (!empty($message)) echo $message; ?>

<form method="POST">
    <label for="startDate">Start Date:</label><br>
    <input type="date" name="startDate" id="startDate" required><br><br>

    <label for="days">How many days:</label><br>
    <input type="number" name="days" id="days" min="1" value="1" required oninput="updateCost()"><br><br>

    <p><strong>Estimated Total Cost:</strong> €<span id="costDisplay"><?= $car['rentalPrice'] ?></span></p>

    <button type="submit">Book Now</button>
</form>

<br><a href="../index.php">⬅ Back to Home</a>

<?php require_once '../template/footer.php'; ?>
</body>
</html>
