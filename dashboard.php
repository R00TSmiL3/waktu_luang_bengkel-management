<?php
include 'auth.php'; // Tambahkan auth.php untuk mengamankan halaman ini

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>This is your dashboard.</p>
    <a href="list_pelanggan.php">Manajemen Pelanggan Bengkel</a><br/><br/>
    <a href="transaksi_list.php">Managament Keuangan Bengkel</a><br/><br/>
    <a href="bahan_list.php">Managment Bahan Bengkel</a><br/><br/>
    <a href="logout.php">Logout</a>
</body>
</html>

