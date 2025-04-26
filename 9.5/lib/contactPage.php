<?php
require_once '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Client.php';

use classes\Client;

// Check if user is logged in first
if (!isset($_SESSION['UserID'])) {
    echo "<p>⚠️ You must be logged in to send a message.</p>";
    exit;
}

$client = new Client($pdo, $_SESSION['UserID']);
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $msgContent = htmlspecialchars($_POST['message']);

    if ($client->sendMessage($name, $email, $msgContent)) {
        $message = "<p class='success'>✅ Your message has been sent successfully!</p>";
    } else {
        $message = "<p class='error'>❌ Failed to send your message. Please try again later.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main class="container">
    <h2>Contact Us</h2>

    <?= $message ?>

    <form method="POST" action="" class="contact-form">
        <label for="name">Name:</label><br>
        <input type="text" name="name" id="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea name="message" id="message" rows="6" required></textarea><br><br>

        <button type="submit" class="btn-submit">Send Message</button>
    </form>
</main>

<?php require_once '../template/footer.php'; ?>

</body>
</html>