<?php
require_once '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Client.php';

use classes\Client;

$client = new Client($pdo, $_SESSION['UserID']);
$messages = $client->viewMessages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Messages - RF Motors</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .messages-container {
            padding: 2rem;
            max-width: 1000px;
            margin: auto;
        }
        .message-box {
            background: #f9f9f9;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .admin-reply {
            margin-top: 10px;
            padding: 0.8rem;
            background: #e6f7e6;
            border-left: 5px solid #4CAF50;
        }
    </style>
</head>
<body>

<main class="messages-container">
    <h2>My Messages</h2>

    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $msg): ?>
            <div class="message-box">
                <strong>Message:</strong><br>
                <?= nl2br(htmlspecialchars($msg['message'])) ?><br><br>
                <small>Sent at: <?= htmlspecialchars($msg['created_at']) ?></small>

                <?php if (!empty($msg['adminReply'])): ?>
                    <div class="admin-reply">
                        <strong>Admin Reply:</strong><br>
                        <?= nl2br(htmlspecialchars($msg['adminReply'])) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No messages sent yet.</p>
    <?php endif; ?>

</main>

<?php require_once '../template/footer.php'; ?>

</body>
</html>
