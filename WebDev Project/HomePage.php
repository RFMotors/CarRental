<?php
// Start session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Car Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Welcome to Our Rental Car Service</h1>
    <nav>
        <ul>
            <li><a href="HomePage.php">Home</a></li>
            <li><a href="ContactPage.php">Contact</a></li>
            <li><a href="LoginPage.php">Login/Register</a></li>
        </ul>
    </nav>
</header>

<main>
    <!-- Search and Filter Section -->
    <section class="search-filter">
        <h2>Find Your Perfect Car</h2>
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Search by car name..." />

            <select name="car-type">
                <option value="">All Car Types</option>
                <option value="SUV">SUV</option>
                <option value="Sedan">Sedan</option>
                <option value="Sports">Sports</option>
                <option value="Electric">Electric</option>
            </select>

            <input type="number" name="min-price" placeholder="Min Price (€)">
            <input type="number" name="max-price" placeholder="Max Price (€)">

            <!-- Booking Navigation Bar inside the search section -->
            <label for="pickup-date">Pickup Date:</label>
            <input type="date" id="pickup-date" name="pickup-date" required>

            <label for="pickup-time">Pickup Time:</label>
            <input type="time" id="pickup-time" name="pickup-time" required>

            <label for="return-date">Return Date:</label>
            <input type="date" id="return-date" name="return-date" required>

            <label for="return-time">Return Time:</label>
            <input type="time" id="return-time" name="return-time" required>

            <button type="submit">Search</button>
        </form>
    </section>

    <!-- Featured Cars Section -->
    <section class="featured">
        <h2>Top 5 Bestselling Cars</h2>
        <div class="car-list">
            <?php
            $cars = [
                ['image' => 'images/BMWX5.png', 'name' => 'BMW X5', 'price' => 70],
                ['image' => 'images/ToyotaCorolla.png', 'name' => 'Toyota Corolla', 'price' => 25],
                ['image' => 'images/HondaCivic.png', 'name' => 'Honda Civic', 'price' => 50],
                ['image' => 'images/FordMustang.png', 'name' => 'Ford Mustang', 'price' => 60],
                ['image' => 'images/TeslaModel3.png', 'name' => 'Tesla Model 3', 'price' => 65]
            ];
            foreach ($cars as $car) {
                echo "<div class='car-item'>";
                echo "<img src='{$car['image']}' alt='{$car['name']}'>";
                echo "<h3>{$car['name']}</h3>";
                echo "<p>Price: €{$car['price']}/day</p>";
                echo "<a href='CarDetails.php' class='button'>View More Details</a>";
                echo "</div>";
            }
            ?>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2025 Rental Car Service</p>
</footer>
</body>
</html>