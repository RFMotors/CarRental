<link rel="stylesheet" href="/CarRental/css/headerFooter.css">
<header>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                <a href="/CarRental/index.php">
                    <img src="/CarRental/images/RFMotorsLOGO.png" alt="RF Motors"> RF Motors Car Rental
                </a>
            </div>
            <ul>
                <button><a href="/CarRental/index.php">Home</a></button>
                <button><a href="/CarRental/ContactPage.php">Contact</a></button>
                <?php if (isset($_SESSION['userID'])): ?>
                    <button><a href="/CarRental/client/dashboard.php">Dashboard</a></button>
                    <button><a href="/CarRental/logout.php">Logout</a></button>
                <?php else: ?>
                    <button><a href="/CarRental/login.php">Login/Register</a></button>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
