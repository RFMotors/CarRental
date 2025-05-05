<?php

require_once '../../RFMCarRental/classes/userManager.php';
require_once '../../RFMCarRental/classes/User.php';

$userManager = new userManager();

$newUser = new User('Mati', 'mati@gmail.com', '123', '0123456789');

$userManager->addUser($newUser);

if (count($userManager->getAllUsers()) === 1) {
    echo "✅ Test Passed: addUser() successfully added a user.<br>";
} else {
    echo "❌ Test Failed: addUser() did not add a user.<br>";
}

$foundUser = $userManager->findUserByEmail('mati@gmail.com');

if ($foundUser !== null && $foundUser->getEmail() === 'mati@gmail.com') {
    echo "✅ Test Passed: findUserByEmail() returns correct user.<br>";
} else {
    echo "❌ Test Failed: findUserByEmail() does not return correct user.<br>";
}

if ($foundUser->getName() === 'Mati') {
    echo "✅ Test Passed: found user has correct name.<br>";
} else {
    echo "❌ Test Failed: found user does not have correct name.<br>";
}

$secondUser = new User('Jacob', 'jacob@gmail.com', '321', '9876543210');
$userManager->addUser($secondUser);

if (count($userManager->getAllUsers()) === 2) {
    echo "✅ Test Passed: addUser() adds multiple users correctly.<br>";
} else {
    echo "❌ Test Failed: addUser() does not add multiple users correctly.<br>";
}

?>