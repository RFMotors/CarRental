<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Rental Car Service</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Checkout</h1>
        <nav>
            <ul>
                <li><a href="HomePage.php">Home</a></li>
                <li><a href="ContactPage.php">Contact</a></li>
                <li><a href="LoginPage.php">Login/Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="checkout-details">
            <h2>Order Summary</h2>
            <div class="order-summary">
                <p><strong>Car: </strong>BMW X5</p>
                <p><strong>Rental Period: </strong>3 Days</p>
                <p><strong>Price per Day: </strong>€70</p>
                <p><strong>Total: </strong>€210</p>
            </div>

            <h2>Payment Information</h2>
            <form action="process_payment.php" method="POST">
                <label for="card-name">Name on Card</label>
                <input type="text" id="card-name" name="card-name" required>

                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="card-number" maxlength="16" required>

                <label for="expiry-date">Expiry Date</label>
                <input type="month" id="expiry-date" name="expiry-date" required>

                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" maxlength="3" required>

                <button type="submit">Complete Payment</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Rental Car Service</p>
    </footer>
</body>
</html>
