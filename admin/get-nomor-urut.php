<?php
include 'assets/php/db.php'; // Pastikan file koneksi database di-include

$tanggalPesan = $_GET['tanggal_pesan'] ?? null;

if ($tanggalPesan) {
    $query = "SELECT COUNT(*) AS nomor_urut FROM tb_transaksi WHERE DATE(tanggal_pesan) = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tanggalPesan);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    $nomorUrut = $result['nomor_urut'] + 1; // Nomor urut berikutnya

    echo json_encode(['status' => 'success', 'nomor_urut' => $nomorUrut]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Tanggal pesan tidak ditemukan']);
}
?>
