<?php

require_once '../../RFMCarRental/classes/User.php';

$user = new User('Chid', 'test@gmail.com', 'test123', '0123456789');

if ($user->getName() === 'test') {
    echo "✅ Test Passed: getName() returns correct name.<br>";
} else {
    echo "❌ Test Failed: getName() does not return correct name.<br>";
}

if ($user->getEmail() === 'test@gmail.com') {
    echo "✅ Test Passed: getEmail() returns correct email.<br>";
} else {
    echo "❌ Test Failed: getEmail() does not return correct email.<br>";
}

if ($user->getPassword() === 'test123') {
    echo "✅ Test Passed: getPassword() returns correct password.<br>";
} else {
    echo "❌ Test Failed: getPassword() does not return correct password.<br>";
}

if ($user->getPhoneNumber() === '0123456789') {
    echo "✅ Test Passed: getPhoneNumber() returns correct phone number.<br>";
} else {
    echo "❌ Test Failed: getPhoneNumber() does not return correct phone number.<br>";
}

if ($user->isAdmin() === false) {
    echo "✅ Test Passed: isAdmin() returns false for normal user.<br>";
} else {
    echo "❌ Test Failed: isAdmin() does not return false for normal user.<br>";
}

?>