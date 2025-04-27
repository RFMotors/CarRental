<?php
require_once '../template/header.php';
require_once '../config/config.php';
require_once '../classes/Client.php';

use classes\Client;

if (!isset($_SESSION['UserID'])) {
    header('Location: ../login.php');
    exit;
}

$client = new Client($pdo, $_SESSION['UserID']);
$messages = $client->viewMessages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Messages</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main class="container">
    <h2>My Sent Messages</h2>

    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $msg): ?>
            <div class="message-card">
                <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($msg['message'])) ?></p>

                <?php if (!empty($msg['adminReply'])): ?>
                    <div class="admin-reply">
                        <strong>Admin Reply:</strong><br>
                        <?= nl2br(htmlspecialchars($msg['adminReply'])) ?>
                    </div>
                <?php else: ?>
                    <p style="color: #aaa; margin-top: 10px;">(No reply yet)</p>
                <?php endif; ?>

                <small>Sent on: <?= htmlspecialchars($msg['created_at']) ?></small>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You haven't sent any messages yet.</p>
    <?php endif; ?>

    <br><a href="dashboard.php" class="btn">⬅ Back to Dashboard</a>
</main>

<?php require_once '../template/footer.php'; ?>

</body>
</html>
