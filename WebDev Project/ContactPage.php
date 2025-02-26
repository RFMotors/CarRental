<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Support - Rental Car Service</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="ContactCss.css">
</head>
<body>
    <header>
        <h1>Contact Support</h1>
        <nav>
            <ul>
                <li><a href="HomePage.php">Home</a></li>
                <li><a href="ContactPage.php">Contact</a></li>
                <li><a href="LoginPage.php">Login/Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="contact-form">
            <h2>Send Us a Message</h2>
            <form action="submit_form.php" method="POST">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone">

                <label for="message">Your Message</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </section>

        <section class="contact-info">
            <h2>Other Ways to Reach Us</h2>
            <p><strong>Email Support:</strong> RFMotors@gmail.com</p>
            <p><strong>Phone Support:</strong> (+353) 860 8888</p>
            <p><strong>Live Chat:</strong> Available during business hours.</p>
        </section>

    
        <section class="office-location">
            <h2>Our Office</h2>
            <p>Visit us at:</p>
            <p>industrial estate, Blanchardstown, Ireland</p>
            
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Rental Car Service</p>
    </footer>
</body>
</html>
