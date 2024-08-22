<?php
include 'auth.php';
require 'db.php';

$stmt = $pdo->prepare("SELECT t.*, p.nama FROM transaksi t JOIN pelanggan p ON t.id_pelanggan = p.id ORDER BY t.tanggal DESC");
$stmt->execute();
$transaksi = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
</head>
<body>
    <h2>Data Transaksi Bengkel</h2>
    <a href="transaksi_add.php">Tambah Transaksi</a><br><br>
    <table border="1">
        <tr>
            <th>Pelanggan</th>
            <th>Total Pendapatan</th>
            <th>Biaya Bahan</th>
            <th>Biaya Jasa</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($transaksi as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['nama']); ?></td>
            <td><?php echo htmlspecialchars($item['total_pendapatan']); ?></td>
            <td><?php echo htmlspecialchars($item['biaya_bahan']); ?></td>
            <td><?php echo htmlspecialchars($item['biaya_jasa']); ?></td>
            <td><?php echo htmlspecialchars($item['tanggal']); ?></td>
            <td>
                <a href="transaksi_view.php?id=<?php echo $item['id']; ?>">Detail</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

