<?php
include 'auth.php';
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pelanggan = $_POST['id_pelanggan'];
    $total_pendapatan = $_POST['total_pendapatan'];
    $only_jasa = isset($_POST['only_jasa']) ? true : false;

    if ($only_jasa) {
        // Jika hanya biaya jasa, seluruh pendapatan dibagi kepada pekerja
        $biaya_bahan = 0;
        $biaya_jasa = $total_pendapatan;
        $bagian_jasa_per_user = $biaya_jasa / count($_POST['selected_users']);
    } else {
        // Perhitungan biaya bahan dan jasa normal
        $biaya_bahan = $total_pendapatan * 0.60;
        $biaya_jasa = $total_pendapatan * 0.40;
        $bagian_jasa_per_user = ($biaya_jasa * 0.40) / count($_POST['selected_users']);
    }

    // Insert transaksi ke tabel transaksi
    $stmt = $pdo->prepare("INSERT INTO transaksi (id_pelanggan, total_pendapatan, biaya_bahan, biaya_jasa) VALUES (?, ?, ?, ?)");
    $stmt->execute([$id_pelanggan, $total_pendapatan, $biaya_bahan, $biaya_jasa]);

    $id_transaksi = $pdo->lastInsertId();

    // Bagikan bagian jasa kepada pekerja yang dipilih
    $selected_users = $_POST['selected_users'];
    foreach ($selected_users as $id_user) {
        $stmt = $pdo->prepare("INSERT INTO transaksi_pekerja (id_transaksi, id_user, bagian_jasa) VALUES (?, ?, ?)");
        $stmt->execute([$id_transaksi, $id_user, $bagian_jasa_per_user]);
    }

    // Redirect ke halaman daftar transaksi setelah selesai
    header("Location: transaksi_list.php");
    exit();
}

// Fetch pelanggan and users data untuk form
$pelanggan = $pdo->query("SELECT * FROM pelanggan")->fetchAll(PDO::FETCH_ASSOC);
$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
</head>
<body>
    <h2>Tambah Transaksi</h2>
    <form method="POST" action="transaksi_add.php">
        <label for="id_pelanggan">Pelanggan:</label><br>
        <select name="id_pelanggan" required>
            <?php foreach ($pelanggan as $item): ?>
                <option value="<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['nama']); ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="total_pendapatan">Total Pendapatan:</label><br>
        <input type="number" step="0.01" name="total_pendapatan" required><br><br>

        <label for="only_jasa">Hanya Biaya Jasa (tanpa bahan):</label>
        <input type="checkbox" name="only_jasa" value="1"><br><br>

        <label for="selected_users">Pilih Pekerja:</label><br>
        <?php foreach ($users as $user): ?>
            <input type="checkbox" name="selected_users[]" value="<?php echo $user['id']; ?>"> <?php echo htmlspecialchars($user['username']); ?><br>
        <?php endforeach; ?><br>

        <button type="submit">Tambah</button>
    </form>
    <br<br><br>
    <p>
      Penjelasan Logika:
only_jasa Bernilai True: Ketika opsi "Hanya Biaya Jasa" dipilih, maka seluruh pendapatan (total_pendapatan) dianggap sebagai biaya_jasa.<br>
Pembagian Jasa: Jika tidak ada bahan yang digunakan, bagian_jasa_per_user dihitung dengan membagi langsung seluruh biaya_jasa ke jumlah pekerja yang dipilih.<br>
only_jasa Bernilai False: Jika bahan digunakan, maka perhitungan dilakukan dengan formula standar (60% bahan, 40% jasa, dan 40% dari jasa tersebut dibagi ke pekerja).
    </p>
</body>
</html>

