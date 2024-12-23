<?php
header('Content-Type: application/json');

// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rentalcamera';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Koneksi database gagal.']);
    exit;
}

// Query untuk mengambil data barang dari tb_barang
$query = "SELECT id_barang, nama_barang, harga_sewa FROM tb_barang";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(['status' => 'success', 'data' => $data]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Tidak ada data di tabel barang.']);
}

$conn->close();
?>
