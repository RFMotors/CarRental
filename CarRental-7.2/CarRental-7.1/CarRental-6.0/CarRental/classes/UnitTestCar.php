<?php
require_once 'Car.php';

echo "Unit Test for Car Class\n";

// Create a new Car object
$car = new Car("Toyota", "Corolla", 2020);

// Test getters
echo "<h3>Testing Car Object</h3>";
echo "<b>Make Test Passed:</b> " . ($car->getMake() == "Toyota" ? "Passed" : "Failed") . "<br>";
echo "<b>Model Test Passed:</b> " . ($car->getModel() == "Corolla" ? "Passed" : "Failed") . "<br>";
echo "<b>Year Test Passed:</b> " . ($car->getYear() == 2020 ? "Passed" : "Failed") . "<br>";

// Test setters
$car->setMake("Honda");
$car->setModel("Civic");
$car->setYear(2022);

// Retest after setters
echo "<h3>Updated Car Object</h3>";
echo "<b>Make Test Passed:</b> " . ($car->getMake() == "Honda" ? "Passed" : "Failed") . "<br>";
echo "<b>Model Test Passed:</b> " . ($car->getModel() == "Civic" ? "Passed" : "Failed") . "<br>";
echo "<b>Year Test Passed:</b> " . ($car->getYear() == 2022 ? "Passed" : "Failed") . "<br>";
?>