<?php
include 'auth.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_bahan = $_POST['id_bahan'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $jumlah_digunakan = $_POST['jumlah_digunakan'];

    $stmt = $pdo->prepare("INSERT INTO penggunaan_bahan (id_bahan, id_pelanggan, jumlah_digunakan) VALUES (?, ?, ?)");
    $stmt->execute([$id_bahan, $id_pelanggan, $jumlah_digunakan]);

    // Update jumlah bahan di tabel bahan
    $stmt = $pdo->prepare("UPDATE bahan SET jumlah = jumlah - ? WHERE id = ?");
    $stmt->execute([$jumlah_digunakan, $id_bahan]);

    header("Location: bahan_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penggunaan Bahan</title>
</head>
<body>
    <h2>Tambah Penggunaan Bahan</h2>
    <form method="POST" action="penggunaan_bahan_add.php">
        <label for="id_bahan">Bahan:</label><br>
        <select name="id_bahan" required>
            <?php
            // Ambil daftar bahan dari database
            $stmt = $pdo->query("SELECT * FROM bahan");
            while ($row = $stmt->fetch()) {
                echo '<option value="'.$row['id'].'">'.htmlspecialchars($row['nama']).'</option>';
            }
            ?>
        </select><br><br>

        <label for="id_pelanggan">Pelanggan:</label><br>
        <select name="id_pelanggan" required>
            <?php
            // Ambil daftar pelanggan dari database
            $stmt = $pdo->query("SELECT * FROM pelanggan");
            while ($row = $stmt->fetch()) {
                echo '<option value="'.$row['id'].'">'.htmlspecialchars($row['nama']).'</option>';
            }
            ?>
        </select><br><br>

        <label for="jumlah_digunakan">Jumlah Digunakan (mililiter atau liter):</label><br>
        <input type="number" step="0.01" name="jumlah_digunakan" required><br><br>

        <button type="submit">Tambah Penggunaan</button>
    </form>
</body>
</html>

