<?php
include 'auth.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_bahan = $_POST['id_bahan'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $foto_nota = '';
    $dibeli_oleh = $_SESSION['user_id']; // Mengambil ID user yang sedang login

    if (!empty($_FILES['foto_nota']['name'])) {
        $foto_nota = 'uploads/' . basename($_FILES['foto_nota']['name']);
        move_uploaded_file($_FILES['foto_nota']['tmp_name'], $foto_nota);
    }

    $stmt = $pdo->prepare("INSERT INTO pembelian_bahan (id_bahan, dibeli_oleh, jumlah, harga, foto_nota) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id_bahan, $dibeli_oleh, $jumlah, $harga, $foto_nota]);

    // Update jumlah bahan di tabel bahan
    $stmt = $pdo->prepare("UPDATE bahan SET jumlah = jumlah + ? WHERE id = ?");
    $stmt->execute([$jumlah, $id_bahan]);

    header("Location: pembelian_bahan_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembelian Bahan</title>
</head>
<body>
    <h2>Tambah Pembelian Bahan</h2>
    <form method="POST" action="pembelian_bahan_add.php" enctype="multipart/form-data">
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

        <label for="jumlah">Jumlah (mililiter atau liter):</label><br>
        <input type="number" step="0.01" name="jumlah" required><br><br>

        <label for="harga">Harga Pembelian:</label><br>
        <input type="number" step="0.01" name="harga" required><br><br>

        <label for="foto_nota">Foto Nota:</label><br>
        <input type="file" name="foto_nota"><br><br>

        <button type="submit">Tambah Pembelian</button>
    </form>
</body>
</html>

