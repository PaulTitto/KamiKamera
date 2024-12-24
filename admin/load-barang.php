<?php
include 'assets/php/db.php'; // Koneksi ke database

$query = "SELECT id_barang, nama_barang, harga_sewa FROM tb_barang";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode(['status' => 'success', 'data' => $data]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Tidak ada data barang']);
}
?>
