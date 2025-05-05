<?php

require_once '../../RFMCarRental/classes/Booking.php';

$booking = new Booking(5, 10, '02-05-2025', '05-06-2025', 400.00);

if ($booking->getCustomerID() === 5) {
    echo "✅ Test Passed: getCustomerID() returns correct customer ID.<br>";
} else {
    echo "❌ Test Failed: getCustomerID() does not return correct customer ID.<br>";
}

if ($booking->getCarID() === 10) {
    echo "✅ Test Passed: getCarID() returns correct car ID.<br>";
} else {
    echo "❌ Test Failed: getCarID() does not return correct car ID.<br>";
}

if ($booking->getStartDate() === '02-05-2025') {
    echo "✅ Test Passed: getStartDate() returns correct start date.<br>";
} else {
    echo "❌ Test Failed: getStartDate() does not return correct start date.<br>";
}

if ($booking->getEndDate() === '05-06-2025') {
    echo "✅ Test Passed: getEndDate() returns correct end date.<br>";
} else {
    echo "❌ Test Failed: getEndDate() does not return correct end date.<br>";
}

if ($booking->getTotalCost() === 400.00) {
    echo "✅ Test Passed: getTotalCost() returns correct total cost.<br>";
} else {
    echo "❌ Test Failed: getTotalCost() does not return correct total cost.<br>";
}

if ($booking->getStatus() === 'Pending') {
    echo "✅ Test Passed: Initial status is Pending.<br>";
} else {
    echo "❌ Test Failed: Initial status is not Pending.<br>";
}

$booking->confirm();
if ($booking->getStatus() === 'Confirmed') {
    echo "✅ Test Passed: confirm() changes status to Confirmed.<br>";
} else {
    echo "❌ Test Failed: confirm() does not change status correctly.<br>";
}

$booking->cancel();
if ($booking->getStatus() === 'Cancelled') {
    echo "✅ Test Passed: cancel() changes status to Cancelled.<br>";
} else {
    echo "❌ Test Failed: cancel() does not change status correctly.<br>";
}

$calculatedCost = $booking->calculateTotalCost(100);
if ($calculatedCost === 3400) {
    echo "✅ Test Passed: calculateTotalCost() returns correct cost based on days.<br>";
} else {
    echo "❌ Test Failed: calculateTotalCost() does not return correct cost.<br>";
}

?>