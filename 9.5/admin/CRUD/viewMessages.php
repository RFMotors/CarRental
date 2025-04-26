<?php
require_once '../../template/header.php';
require_once '../../config/config.php';
require_once '../../classes/Admin.php';

use classes\Admin;

if (!isset($_SESSION['UserID']) || $_SESSION['isAdmin'] != 1) {
    die("<p style='color: red;'>❌ Admin access only.</p>");
}

$admin = new Admin($pdo);
$replyMessage = ""; // 🔥 For success message

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply'])) {
    $contactID = intval($_POST['contactID']);
    $reply = trim($_POST['adminReply']);
    if (!empty($reply)) {
        if ($admin->replyToMessage($contactID, $reply)) {
            $replyMessage = "<p class='success'>✅ Reply sent successfully!</p>";
        } else {
            $replyMessage = "<p class='error'>❌ Failed to send reply.</p>";
        }
    }
}

// Load all contact messages
$messages = $admin->getAllMessages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Messages - Admin</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<main class="container">
    <h2>Client Messages</h2>

    <?= $replyMessage ?> <!-- 🔥 Display success or error message -->

    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $msg): ?>
            <div class="message-card">
                <p><strong>Name:</strong> <?= htmlspecialchars($msg['name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($msg['email']) ?></p>
                <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($msg['message'])) ?></p>

                <form method="POST" style="margin-top:10px;">
                    <input type="hidden" name="contactID" value="<?= $msg['messageID'] ?>">
                    <textarea name="adminReply" rows="3" placeholder="Reply here..." required><?= htmlspecialchars($msg['adminReply']) ?></textarea><br><br>
                    <button type="submit" name="reply" class="btn">Send Reply</button>
                </form>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No messages yet.</p>
    <?php endif; ?>

    <br><a href="../dashboard.php" class="btn">⬅ Back to Admin Dashboard</a>
</main>

<?php require_once '../../template/footer.php'; ?>

</body>
</html>
