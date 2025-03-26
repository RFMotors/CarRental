<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'client') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php require "../layout/header.php"; ?>

<main>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['client_name']); ?>!</h2>

    <a href="../index.php" class="btn">Back to Home</a>
    <a href="../logout.php" class="btn">Logout</a>
</main>

<?php require "../layout/footer.php"; ?>

</body>
</html>
