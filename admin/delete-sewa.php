<?php
include 'assets/php/db.php'; // Pastikan file koneksi sudah ada

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM tb_transaksi WHERE no_transaksi = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id);

    if ($stmt->execute()) {
        header('Location: index.php?message=Data berhasil dihapus');
    } else {
        echo 'Gagal menghapus data.';
    }
}
?>
