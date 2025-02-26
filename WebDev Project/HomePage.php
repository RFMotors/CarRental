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
                
                <button type="submit">Search</button>
            </form>
        </section>

        <!-- Featured Cars Section -->
        <section class="featured">
            <h2>Top 5 Bestselling Cars</h2>
            <div class="car-list">
                <div class="car-item">
                    <img src="images/BMWX5.png" alt="BMW X5">
                    <h3>BMW X5</h3>
                    <p>Price: €70/day</p>
                    <a href="CarDetails.php" class="button">View More Details</a>
                </div>
                <div class="car-item">
                    <img src="images/ToyotaCorolla.png" alt="Toyota Corolla">
                    <h3>Toyota Corolla</h3>
                    <p>Price: €25/day</p>
                    <a href="CarDetails.php" class="button">View More Details</a>
                </div>
                <div class="car-item">
                    <img src="images/HondaCivic.png" alt="Honda Civic">
                    <h3>Honda Civic</h3>
                    <p>Price: €50/day</p>
                    <a href="CarDetails.php" class="button">View More Details</a>
                </div>
                <div class="car-item">
                    <img src="images/FordMustang.png" alt="Ford Mustang">
                    <h3>Ford Mustang</h3>
                    <p>Price: €60/day</p>
                    <a href="CarDetails.php" class="button">View More Details</a>
                </div>
                <div class="car-item">
                    <img src="images/TeslaModel3.png" alt="Tesla Model 3">
                    <h3>Tesla Model 3</h3>
                    <p>Price: €65/day</p>
                    <a href="CarDetails.php" class="button">View More Details</a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Rental Car Service</p>
    </footer>
</body>
</html>
