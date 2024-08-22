<?php
include 'auth.php';
require 'db.php';

$stmt = $pdo->prepare("SELECT * FROM pelanggan ORDER BY tanggal DESC");
$stmt->execute();
$pelanggan = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
</head>
<body>
    <h2>Data Pelanggan Bengkel</h2>
    <a href="add_pelanggan.php">Tambah Data</a><br><br>
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Kontak</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Jenis Mobil</th>
            <th>Nomor Plat</th>
            <th>Warna Cat</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($pelanggan as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['nama']); ?></td>
            <td><?php echo htmlspecialchars($item['kontak']); ?></td>
            <td><?php echo htmlspecialchars($item['alamat']); ?></td>
            <td><?php echo htmlspecialchars($item['status']); ?></td>
            <td><?php echo htmlspecialchars($item['jenis_mobil']); ?></td>
            <td><?php echo htmlspecialchars($item['nomor_plat']); ?></td>
            <td><?php echo htmlspecialchars($item['warna_cat']); ?></td>
            <td><?php echo htmlspecialchars($item['tanggal']); ?></td>
            <td>
                <a href="edit_pelanggan.php?id=<?php echo $item['id']; ?>">Edit</a> | 
                <a href="delete_pelanggan.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

