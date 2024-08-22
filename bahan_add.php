<?php
include 'auth.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $foto = '';

    if (!empty($_FILES['foto']['name'])) {
        $foto = 'uploads/' . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
    }

    $stmt = $pdo->prepare("INSERT INTO bahan (nama, kategori, harga, jumlah, foto) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nama, $kategori, $harga, $jumlah, $foto]);

    header("Location: bahan_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bahan</title>
</head>
<body>
    <h2>Tambah Bahan</h2>
    <form method="POST" action="bahan_add.php" enctype="multipart/form-data">
        <label for="nama">Nama Bahan:</label><br>
        <input type="text" name="nama" required><br><br>

        <label for="kategori">Kategori:</label><br>
        <input type="text" name="kategori" required><br><br>

        <label for="harga">Harga:</label><br>
        <input type="number" step="0.01" name="harga" required><br><br>

        <label for="jumlah">Jumlah (mililiter atau liter):</label><br>
        <input type="number" step="0.01" name="jumlah" required><br><br>

        <label for="foto">Foto Bahan:</label><br>
        <input type="file" name="foto"><br><br>

        <button type="submit">Tambah Bahan</button>
    </form>
</body>
</html>

