<?php
include 'assets/php/db.php'; // Pastikan file koneksi sudah ada

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tb_transaksi WHERE no_transaksi = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if (!$data) {
        die('Data tidak ditemukan!');
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['no_transaksi'];
    $nama_pemesan = $_POST['nama_pemesan'];
    $nama_barang = $_POST['nama_barang'];
    $lama_sewa = $_POST['lama_sewa'];
    $tgl_pesan = $_POST['tgl_pesan'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $harga_sewa = $_POST['harga_sewa'];
    $total_bayar = $_POST['total_bayar'];
    $kartu_jaminan = $_POST['kartu_jaminan'];
    $status = $_POST['status'];

    $query = "UPDATE tb_transaksi SET nama_pemesan = ?, nama_barang = ?, lama_sewa = ?, tgl_pesan = ?, tgl_kembali = ?, harga_sewa = ?, total_bayar = ?, kartu_jaminan = ?, status = ? WHERE no_transaksi = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssisssisss', $nama_pemesan, $nama_barang, $lama_sewa, $tgl_pesan, $tgl_kembali, $harga_sewa, $total_bayar, $kartu_jaminan, $status, $id);

    if ($stmt->execute()) {
        header('Location: index.php?message=Data berhasil diperbarui');
    } else {
        echo 'Gagal memperbarui data.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Penyewaan</title>
    <link rel="stylesheet" href="assets/css/sb-admin-2.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-4">Edit Penyewaan</h2>
    <form method="POST">
        <input type="hidden" name="no_transaksi" value="<?= $data['no_transaksi'] ?>">
        <div class="form-group">
            <label>Nama Pemesan</label>
            <input type="text" name="nama_pemesan" class="form-control" value="<?= $data['nama_pemesan'] ?>" required>
        </div>
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="<?= $data['nama_barang'] ?>" required>
        </div>
        <div class="form-group">
            <label>Lama Sewa</label>
            <input type="number" name="lama_sewa" class="form-control" value="<?= $data['lama_sewa'] ?>" required>
        </div>
        <div class="form-group">
            <label>Tanggal Pesan</label>
            <input type="date" name="tgl_pesan" class="form-control" value="<?= $data['tgl_pesan'] ?>" required>
        </div>
        <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" name="tgl_kembali" class="form-control" value="<?= $data['tgl_kembali'] ?>" required>
        </div>
        <div class="form-group">
            <label>Harga Sewa</label>
            <input type="text" name="harga_sewa" class="form-control" value="<?= $data['harga_sewa'] ?>" required>
        </div>
        <div class="form-group">
            <label>Total Bayar</label>
            <input type="text" name="total_bayar" class="form-control" value="<?= $data['total_bayar'] ?>" required>
        </div>
        <div class="form-group">
            <label>Kartu Jaminan</label>
            <input type="text" name="kartu_jaminan" class="form-control" value="<?= $data['kartu_jaminan'] ?>" required>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Dipinjam" <?= $data['status'] === 'Dipinjam' ? 'selected' : '' ?>>Dipinjam</option>
                <option value="Dikembalikan" <?= $data['status'] === 'Dikembalikan' ? 'selected' : '' ?>>Dikembalikan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
