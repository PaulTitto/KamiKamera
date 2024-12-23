<?php
include 'assets/php/db.php'; // File koneksi ke database

// Query untuk mendapatkan data transaksi
$query = "SELECT t.*, b.nama_barang FROM tb_transaksi t 
          JOIN tb_barang b ON t.id_barang = b.id_barang ORDER BY t.id_transaksi DESC";
$result = mysqli_query($conn, $query);

// Counter untuk nomor urut
$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    // Tentukan warna berdasarkan status
    $statusColor = $row['status'] === 'Dikembalikan' ? 'text-success' : 'text-danger';
    $statusLabel = $row['status'];

    echo "<tr>
            <td>{$no}</td>
            <td>{$row['id_transaksi']}</td>
            <td>{$row['nama_pemesan']}</td>
            <td>{$row['nama_barang']}</td>
            <td>{$row['lama_sewa']}</td>
            <td>{$row['tgl_pesan']}</td>
            <td>{$row['tgl_kembali']}</td>
            <td>{$row['harga_sewa']}</td>
            <td>{$row['total_bayar']}</td>
            <td>{$row['kartu_jaminan']}</td>
            <td><span class='{$statusColor}'>{$statusLabel}</span></td>
            <td>
                <button class='btn btn-sm btn-danger btn-hapus' data-id='{$row['id_transaksi']}'>Hapus</button>
            </td>
          </tr>";
    $no++;
}
?>
