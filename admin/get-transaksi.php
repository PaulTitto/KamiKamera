<?php
require 'assets/php/db.php'; // File koneksi ke database

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $koneksi->prepare("SELECT * FROM penyewaan WHERE id_transaksi = ?");
    $query->bind_param("s", $id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak disediakan']);
}
?>
