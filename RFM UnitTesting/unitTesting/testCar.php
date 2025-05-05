<?php

require_once '../../RFMCarRental/classes/Car.php';

$car = new Car('Honda', 'Civic', 2018, 'REG012', 83.00, true, 'HondaCivic.png', 'The Honda Civic Type R is a high-performance hot hatch featuring a turbocharged 2.0L engine with 315 hp, a 6-speed manual transmission, adaptive suspension, and aggressive styling. It offers track-ready performance with everyday usability'
);

if ($car->getMake() === 'Honda') {
    echo "✅ Test Passed: getMake() returns correct make.<br>";
} else {
    echo "❌ Test Failed: getMake() does not return correct make.<br>";
}

if ($car->getModel() === 'Civic') {
    echo "✅ Test Passed: getModel() returns correct model.<br>";
} else {
    echo "❌ Test Failed: getModel() does not return correct model.<br>";
}

if ($car->getYear() === 2018) {
    echo "✅ Test Passed: getYear() returns correct year.<br>";
} else {
    echo "❌ Test Failed: getYear() does not return correct year.<br>";
}

if ($car->getRegNumber() === 'REG012') {
    echo "✅ Test Passed: getRegNumber() returns correct registration number.<br>";
} else {
    echo "❌ Test Failed: getRegNumber() does not return correct registration number.<br>";
}

if ($car->getRentalPrice() === 83.00) {
    echo "✅ Test Passed: getRentalPrice() returns correct rental price.<br>";
} else {
    echo "❌ Test Failed: getRentalPrice() does not return correct rental price.<br>";
}

$car->updateAvailability(false);
if ($car->getAvailabilityStatus() === false) {
    echo "✅ Test Passed: updateAvailability() updates status correctly.<br>";
} else {
    echo "❌ Test Failed: updateAvailability() does not update status correctly.<br>";
}

?>