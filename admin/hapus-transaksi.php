<?php
include 'assets/php/db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_transaksi']) && !empty($_POST['id_transaksi'])) {
        $id_transaksi = $_POST['id_transaksi'];

        $query = "DELETE FROM tb_transaksi WHERE id_transaksi = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param('s', $id_transaksi);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data: ' . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyiapkan statement: ' . $conn->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID Transaksi tidak ditemukan atau kosong']);
    }

    $conn->close();
}
?>
