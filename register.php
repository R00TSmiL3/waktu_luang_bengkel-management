<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uuid = uniqid();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $profil = 'default.jpg';  // Ganti dengan path profil default

    $stmt = $pdo->prepare("INSERT INTO users (uuid, username, password, email, profil) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$uuid, $username, $password, $email, $profil]);

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>

