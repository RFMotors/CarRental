<?php
session_start();

// ✅ Restrict access to only logged-in users
if (!isset($_SESSION['userID'])) {
    header("Location: ../../login.php");
    exit();
}

// Include Client class and use namespace
require_once '../classes/Client.php';
use classes\Client;

$client = new Client();
$client->setUserID($_SESSION['userID']);

// Fetch user details from database using Option 2
$userDetails = $client->getUserByID($client->getUserID());

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
<?php include("../layout/header.php"); ?>
<header>
    <h2>Welcome, <?php echo htmlspecialchars($userDetails['name']); ?>!</h2>
</header>

<main>
    <p>This is your dashboard where you can book cars, view history, and manage your account.</p>

    <nav class="dashboard-options">
        <ul>
            <li><a href="bookCar.php" class="btn">Book a Car</a></li>
            <li><a href="searchCar.php" class="btn">Search for Cars</a></li>
            <li><a href="viewHistory.php" class="btn">View Booking History</a></li>
            <li><a href="cancelBookings.php" class="btn">Cancel Bookings</a></li>
        </ul>
    </nav>

    <a href="../logout.php" class="btn logout">Logout</a>
</main>

</body>
</html>
