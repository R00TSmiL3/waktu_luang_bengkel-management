<?php
include 'auth.php';
require 'db.php';

// Ambil semua data bahan dari database
$stmt = $pdo->query("SELECT * FROM bahan");
$bahan_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bahan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Daftar Bahan</h2>

    <a href="bahan_add.php">Tambah Bahan Baru</a><br><br>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga (per unit)</th>
                <th>Jumlah Stok</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bahan_list as $bahan): ?>
                <tr>
                    <td><?php echo htmlspecialchars($bahan['id']); ?></td>
                    <td><?php echo htmlspecialchars($bahan['nama']); ?></td>
                    <td><?php echo htmlspecialchars($bahan['kategori']); ?></td>
                    <td><?php echo number_format($bahan['harga'], 2); ?></td>
                    <td><?php echo number_format($bahan['jumlah'], 2); ?> ml/l</td>
                    <td>
                        <?php if (!empty($bahan['foto'])): ?>
                            <img src="<?php echo htmlspecialchars($bahan['foto']); ?>" alt="Foto Bahan" width="100">
                        <?php else: ?>
                            Tidak ada foto
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

