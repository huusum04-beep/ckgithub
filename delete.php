<?php
// Kết nối DB
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM employees WHERE id = ?";
    $conn->prepare($sql)->execute([$id]);
}
header("Location: index.php");
?>