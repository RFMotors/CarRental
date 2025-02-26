<?php
$bestSellingCars = [
    "Toyota Corolla", 
    "Honda Civic", 
    "Ford Mustang", 
    "Tesla Model 3", 
    "BMW 3 Series"
];

echo "<h2>Top 5 Bestselling Cars</h2><ul>";
for ($i = 0; $i < count($bestSellingCars); $i++) {
    echo "<li>" . $bestSellingCars[$i] . "</li>";
}
echo "</ul>";
?>