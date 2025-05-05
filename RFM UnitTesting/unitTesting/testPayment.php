<?php

require_once '../../RFMCarRental/classes/Payment.php';

$payment = new Payment(55, 5, 110.00);

if ($payment->getBookingID() === 55) {
    echo "✅ Test Passed: getBookingID() returns correct booking ID.<br>";
} else {
    echo "❌ Test Failed: getBookingID() does not return correct booking ID.<br>";
}

if ($payment->getCustomerID() === 5) {
    echo "✅ Test Passed: getCustomerID() returns correct customer ID.<br>";
} else {
    echo "❌ Test Failed: getCustomerID() does not return correct customer ID.<br>";
}

if ($payment->getAmount() === 110.00) {
    echo "✅ Test Passed: getAmount() returns correct amount.<br>";
} else {
    echo "❌ Test Failed: getAmount() does not return correct amount.<br>";
}

if ($payment->getPaymentStatus() === 'Completed') {
    echo "✅ Test Passed: Initial paymentStatus is Completed.<br>";
} else {
    echo "❌ Test Failed: Initial paymentStatus is not Completed.<br>";
}

$payment->refund();
if ($payment->getPaymentStatus() === 'Refunded') {
    echo "✅ Test Passed: refund() changes paymentStatus to Refunded.<br>";
} else {
    echo "❌ Test Failed: refund() does not change paymentStatus correctly.<br>";
}

?>