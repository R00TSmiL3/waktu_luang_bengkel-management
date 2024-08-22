<?php
include 'auth.php';
require 'db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT t.*, p.nama FROM transaksi t JOIN pelanggan p ON t.id_pelanggan = p.id WHERE t.id = ?");
$stmt->execute([$id]);
$transaksi = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT tp.*, u.username FROM transaksi_pekerja tp JOIN users u ON tp.id_user = u.id WHERE tp.id_transaksi = ?");
$stmt->execute([$id]);
$pekerja = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
</head>
<body>
    <h2>Detail Transaksi</h2>
    <p>Pelanggan: <?php echo htmlspecialchars($transaksi['nama']); ?></p>
    <p>Total Pendapatan: <?php echo htmlspecialchars($transaksi['total_pendapatan']); ?></p>
    <p>Biaya Bahan: <?php echo htmlspecialchars($transaksi['biaya_bahan']); ?></p>
    <p>Biaya Jasa: <?php echo htmlspecialchars($transaksi['biaya_jasa']); ?></p>
    <p>Tanggal: <?php echo htmlspecialchars($transaksi['tanggal']); ?></p>

    <h3>Pembagian Jasa untuk Pekerja:</h3>
    <table border="1">
        <tr>
            <th>Pekerja</th>
            <th>Bagian Jasa</th>
        </tr>
        <?php foreach ($pekerja as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['username']); ?></td>
            <td><?php echo htmlspecialchars($item['bagian_jasa']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="transaksi_list.php">Kembali</a>
</body>
</html>

