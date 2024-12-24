<?php
include 'assets/php/db.php'; // Koneksi ke database

$query = "SELECT * FROM tb_transaksi"; // Query untuk mengambil semua data transaksi
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$no}</td>
            <td>{$row['id_transaksi']}</td>
            <td>{$row['nama_pemesan']}</td>
            <td>{$row['id_barang']}</td>
            <td>{$row['nama_barang']}</td>
            <td>{$row['lama_sewa']}</td>
            <td>{$row['tgl_pesan']}</td>
            <td>{$row['tgl_kembali']}</td>
            <td>Rp " . number_format($row['harga_sewa'], 0, ',', '.') . "</td>
            <td>Rp " . number_format($row['total_bayar'], 0, ',', '.') . "</td>
            <td>{$row['kartu_jaminan']}</td>
            <td class='status-{$row['status']}'>" . ucfirst($row['status']) . "</td>
            <td>
                <a href='edit-transaksi.php?id={$row['id_transaksi']}' class='btn btn-sm btn-warning'>
                    <i class='fas fa-edit'></i> Edit
                </a>
                <button class='btn btn-sm btn-danger btn-hapus' data-id='{$row['id_transaksi']}'>
                    <i class='fas fa-trash'></i> Hapus
                </button>
            </td>
        </tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='12' class='text-center'>Tidak ada data</td></tr>";
}
?>
