<?php require 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Rental Car Service</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/payment.css">
</head>
<body>
    <main class="checkout-container">
        <section class="checkout-details">
            <h2>Order Summary</h2>
            <div class="order-summary">
                <p><strong>Car:</strong> BMW X5</p>
                <p><strong>Rental Period:</strong> 3 Days</p>
                <p><strong>Price per Day:</strong> €70</p>
                <p class="total"><strong>Total:</strong> €210</p>
            </div>

            <h2>Payment Information</h2>
            <form action="process_payment.php" method="POST" class="payment-form">
                <div class="form-group">
                    <label for="card-name">Name on Card</label>
                    <input type="text" id="card-name" name="card-name" required>
                </div>
                
                <div class="form-group">
                    <label for="card-number">Card Number</label>
                    <input type="text" id="card-number" name="card-number" maxlength="16" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="expiry-date">Expiry Date</label>
                        <input type="month" id="expiry-date" name="expiry-date" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" maxlength="3" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-submit">Complete Payment</button>
            </form>
        </section>
    </main>
    
<?php require "footer.php"; ?>
</body>
</html>