<?php
include 'auth.php';
require 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $kontak = $_POST['kontak'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];
    $jenis_mobil = $_POST['jenis_mobil'];
    $nomor_plat = $_POST['nomor_plat'];
    $warna_cat = $_POST['warna_cat'];

    $stmt = $pdo->prepare("UPDATE pelanggan SET nama = ?, kontak = ?, alamat = ?, status = ?, jenis_mobil = ?, nomor_plat = ?, warna_cat = ? WHERE id = ?");
    $stmt->execute([$nama, $kontak, $alamat, $status, $jenis_mobil, $nomor_plat, $warna_cat, $id]);

    header("Location: pelanggan_list.php");
    exit();
} else {
    $stmt = $pdo->prepare("SELECT * FROM pelanggan WHERE id = ?");
    $stmt->execute([$id]);
    $pelanggan = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pelanggan</title>
</head>
<body>
    <h2>Edit Data Pelanggan</h2>
    <form method="POST" action="edit_pelanggan.php?id=<?php echo $id; ?>">
        <input type="text" name="nama" value="<?php echo htmlspecialchars($pelanggan['nama']); ?>" required><br>
        <input type="text" name="kontak" value="<?php echo htmlspecialchars($pelanggan['kontak']); ?>" required><br>
        <input type="text" name="alamat" value="<?php echo htmlspecialchars($pelanggan['alamat']); ?>" required><br>
        <input type="text" name="status" value="<?php echo htmlspecialchars($pelanggan['status']); ?>" required><br>
        <input type="text" name="jenis_mobil" value="<?php echo htmlspecialchars($pelanggan['jenis_mobil']); ?>" required><br>
        <input type="text" name="nomor_plat" value="<?php echo htmlspecialchars($pelanggan['nomor_plat']); ?>" required><br>
        <input type="text" name="warna_cat" value="<?php echo htmlspecialchars($pelanggan['warna_cat']); ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>

