<?php

function get_cars() {
    $carsJson = file_get_contents('data/cars.json');
    $cars = json_decode($carsJson, true);
    return $cars;
}
function display_car($car) {
    // Handle missing or invalid price
    if (!isset($car['price']) || $car['price'] == '') {
        $price = 'Unknown';
    } elseif ($car['price'] == "#") {
        $price = 'Unavailable';
    } else {
        $price = '$' . $car['price'];
    }

    // Check if car has an ID (for the URL)
    if (!isset($car['id'])) {
        return "<p>Error: Car ID missing.</p>";
    }

    // Create clickable card linking to car_details.php
    return "
    <a href='/car_details.php?id={$car["id"]}' class='car-link'>
        <div class='col-md-4 car-list-item'>
            <h2>{$car['name']}</h2>
            <img src='{$car['image']}' alt='Car Image'>
            <blockquote class='car-details'>
                <span class='label label-info'>{$car['status']}</span> $price
                <p>{$car['year']} | {$car['engineType']}</p>
            </blockquote>
        </div>
    </a>";
}


