<?php
require_once '../../template/header.php';
require_once '../../config/config.php';
require_once '../../classes/Admin.php';

use classes\Admin;

if (!isset($_SESSION['UserID']) || $_SESSION['isAdmin'] != 1) {
    header('Location: ../../index.php');
    exit;
}

$admin = new Admin($pdo);

// Handle admin reply
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply'])) {
    $contactID = intval($_POST['contactID']);
    $reply = trim($_POST['adminReply']);
    if (!empty($reply)) {
        $admin->replyToMessage($contactID, $reply);
    }
}

$messages = $admin->getAllMessages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Messages - Admin</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<main class="container">
    <h2>Client Messages</h2>

    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $msg): ?>
            <div class="message-card">
                <p><strong>Name:</strong> <?= htmlspecialchars($msg['name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($msg['email']) ?></p>
                <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($msg['message'])) ?></p>

                <?php if (!empty($msg['adminReply'])): ?>
                    <div class="admin-reply">
                        <strong>Admin Reply:</strong><br>
                        <?= nl2br(htmlspecialchars($msg['adminReply'])) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="reply-form">
                    <input type="hidden" name="contactID" value="<?= $msg['messageID'] ?>">
                    <textarea name="adminReply" rows="3" placeholder="Write a reply..." required><?= htmlspecialchars($msg['adminReply']) ?></textarea><br>
                    <button type="submit" name="reply" class="btn-small">Send Reply</button>
                </form>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No messages found.</p>
    <?php endif; ?>

    <br><a href="../dashboard.php" class="btn">⬅ Back to Admin Dashboard</a>
</main>

<?php require_once '../../template/footer.php'; ?>

</body>
</html>
