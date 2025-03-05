<?php
$host   = 'localhost';
$port   = 3307;
$dbName = 'CarRentalDB';
$user   = 'root';
$pass   = '';
$conn = mysqli_connect($host, $user, $pass, $dbName, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['id'])) {
    $idToDelete = $_GET['id'];
    $sql  = "DELETE FROM Car WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idToDelete);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
header("Location: read.php");
exit;
