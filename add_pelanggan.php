<?php
include 'auth.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];
    $jenis_mobil = $_POST['jenis_mobil'];
    $nomor_plat = $_POST['nomor_plat'];
    $warna_cat = $_POST['warna_cat'];

    $stmt = $pdo->prepare("INSERT INTO pelanggan (nama, kontak, alamat, status, jenis_mobil, nomor_plat, warna_cat) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nama, $kontak, $alamat, $status, $jenis_mobil, $nomor_plat, $warna_cat]);

    header("Location: list_pelanggan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pelanggan</title>
</head>
<body>
    <h2>Tambah Data Pelanggan</h2>
    <form method="POST" action="add_pelanggan.php">
        <input type="text" name="nama" placeholder="Nama" required><br>
        <input type="text" name="kontak" placeholder="Kontak" required><br>
        <input type="text" name="alamat" placeholder="Alamat" required><br>
        <input type="text" name="status" placeholder="Status" required><br>
        <input type="text" name="jenis_mobil" placeholder="Jenis Mobil" required><br>
        <input type="text" name="nomor_plat" placeholder="Nomor Plat" required><br>
        <input type="text" name="warna_cat" placeholder="Warna Cat" required><br>
        <button type="submit">Tambah</button>
    </form>
</body>
</html>

