<?php
include 'assets/php/db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi = $_POST['id_transaksi'];

    $query = "DELETE FROM tb_transaksi WHERE id_transaksi = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id_transaksi);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
    }

    $stmt->close();
    $conn->close();
}
?>
