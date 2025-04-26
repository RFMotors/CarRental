<?php
require_once 'config/config.php';
require_once 'classes/Car.php';

use classes\Car;

$carObj = new Car($pdo);
$cars = $carObj->getAllCars(); // Get all cars (or you can filter available ones only if you want)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - RF Motors Car Rental</title>
    <link rel="stylesheet" href="css/welcome.css">
</head>
<body>

<section class="welcome-section">
    <div class="welcome-content">
        <h1>Welcome to RF Motors</h1>
        <p>Your journey begins here. Find the perfect car, at the perfect price.</p>
        <a href="index.php" class="btn-discover">Discover Now</a>
    </div>

    <div class="slideshow" id="slideshow">
        <?php foreach ($cars as $index => $car): ?>
            <?php if (!empty($car['image']) && file_exists('uploads/' . $car['image'])): ?>
                <img src="uploads/<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?>"
                     class="<?= $index === 0 ? 'active' : '' ?>">
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>

<script>
    // Simple JS to rotate images
    let slides = document.querySelectorAll('#slideshow img');
    let current = 0;

    function showNextSlide() {
        slides[current].classList.remove('active');
        current = (current + 1) % slides.length;
        slides[current].classList.add('active');
    }

    setInterval(showNextSlide, 3000); // Change image every 3 seconds
</script>

</body>
</html>
