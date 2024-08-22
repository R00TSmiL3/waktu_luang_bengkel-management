<?php
include 'auth.php';
require 'db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM pelanggan WHERE id = ?");
$stmt->execute([$id]);

header("Location: list_pelanggan.php");
exit();
?>

