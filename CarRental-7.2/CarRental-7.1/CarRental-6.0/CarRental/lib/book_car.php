<?php
session_start();
require_once '../config/DBconnect.php';

//Ensure the user is logged in and is a client
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'client') {
    header("Location: login.php");
    exit();
}

//Ensure Car ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("<p style='color: red;'>Error: No Car ID provided.</p>");
}

$carID = $_GET['id'];
$clientID = $_SESSION['client_id'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    try {
        //Check if car is already booked
        $checkSQL = "SELECT * FROM Booking WHERE Car_idCar = ? AND BookingStatus = 'Confirmed'";
        $stmt = $conn->prepare($checkSQL);
        $stmt->bind_param("i", $carID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "<p style='color: red;'>Error: This car is already booked.</p>";
        } else {
            //Insert new booking
            $insertSQL = "INSERT INTO Booking (StartDate, EndDate, BookingStatus, Client_idClient, Car_idCar) 
                          VALUES (?, ?, 'Pending', ?, ?)";
            $stmt = $conn->prepare($insertSQL);
            $stmt->bind_param("ssii", $startDate, $endDate, $clientID, $carID);

            if ($stmt->execute()) {
                header("Location: client/dashboard.php?booking=success");
                exit();
            } else {
                $message = "<p style='color: red;'>Error booking the car. Please try again.</p>";
            }
        }
    } catch (mysqli_sql_exception $error) {
        $message = "<p style='color: red;'>Database error: " . htmlspecialchars($error->getMessage()) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Car</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php require 'header.php'; ?>

<main>
    <div class="container">
        <h2>Book This Car</h2>
        <?= $message; ?>

        <form method="POST">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required><br><br>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required><br><br>

            <button type="submit">Confirm Booking</button>
        </form>

        <a href="index.php" class="btn">Back to Home</a>
    </div>
</main>

<?php require 'footer.php'; ?>

</body>
</html>
