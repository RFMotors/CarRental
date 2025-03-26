<?php
require_once 'DBconnect.php';

function fetchAll($table) {
    global $conn;
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function fetchById($table, $id) {
    global $conn;
    $sql = "SELECT * FROM $table WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
?>
