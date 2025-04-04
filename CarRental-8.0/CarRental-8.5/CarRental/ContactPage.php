<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    echo "<p>Thank you, $name! Your message has been received.</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Message: $message</p>";
} else {

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Us</title>
        <link rel="stylesheet" href="css/ContactCss.css">
    </head>
    <body>

    <?php require 'layout/header.php'; ?>

    <h2>Contact Us</h2>

    <form method="POST" action="ContactPage.php">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Message:</label><br>
        <textarea name="message" rows="6" required></textarea><br><br>

        <button type="submit">Send Message</button>
    </form>

    <?php require 'layout/footer.php'; ?>

    </body>
    </html>

<?php } ?>
