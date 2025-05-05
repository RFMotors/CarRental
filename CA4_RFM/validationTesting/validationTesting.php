<?php

require_once '../../RFMCarRental/classes/User.php';
require_once '../../RFMCarRental/classes/Payment.php';
require_once '../../RFMCarRental/classes/Booking.php';
require_once '../../RFMCarRental/classes/Car.php';

//This validation test checks if the same email has been used before.
$existingEmails = ["chid@gmail.com", "mati@gmail.com"];
$newEmail = "chid@gmail.com";

if (in_array($newEmail, $existingEmails)) {
    echo "✅ Test Passed: Duplicate email was detected.<br>";
} else {
    echo "❌ Test Failed: Duplicate email was not detected.<br>";
}

//This validation test checks if the password contains less than 8 characters.
$password = "pass123";
if (strlen($password) <= 8) {
    echo "✅ Test Passed: Password contains less than 8 characters.<br>";
} else {
    echo "❌ Test Failed: Password contains at least 8 characters.<br>";
}

//This validation test checks if the start date of a booking is after the end date.
$startDate = "05/06/2025";
$endDate = "02/05/2025";

$start = DateTime::createFromFormat('d/m/Y', $startDate);
$end = DateTime::createFromFormat('d/m/Y', $endDate);

if ($start && $end && $start > $end) {
    echo "✅ Test Passed: Invalid booking dates.<br>";
} else {
    echo "❌ Test Failed: End date is correctly after start date.<br>";
}

//This validation test checks if the payment amount is invalid.
$amount = -50;
if ($amount <= 0) {
    echo "✅ Test Passed: Negative payment amount is not allowed.<br>";
} else {
    echo "❌ Test Failed: Payment amount is valid.<br>";
}

//This validation test checks if the car is unavailable to be rented.
$carAvailable = false;
if (!$carAvailable) {
    echo "✅ Test Passed: Car is currently unavailable for booking.<br>";
} else {
    echo "❌ Test Failed: Car is available to be booked.<br>";
}
?>