<?php
global $conn;
if (isset($_POST['pengadaanBarang'])) {
    // Database connection

    // Validate if POST keys exist
    if (
        isset($_POST['idBarang']) && is_array($_POST['idBarang']) &&
        isset($_POST['namaBarang']) && is_array($_POST['namaBarang']) &&
        isset($_POST['hargaBarang']) && is_array($_POST['hargaBarang']) &&
        isset($_POST['sisaBarang']) && is_array($_POST['sisaBarang'])
    ) {
        // Form data
        $tgl = date('Y-m-d');
        $idBarang = $_POST['idBarang'];
        $namaBarang = $_POST['namaBarang'];
        $hargaBarang = $_POST['hargaBarang'];
        $sisaBarang = $_POST['sisaBarang'];
        $jmlBarang = count($idBarang);

        // Fetch suppliers
        $suppliers = $conn->query("SELECT * FROM tb_supplier");
        ?>
        <form action="tambah-pengadaan" method="POST">
            <div class="row mb-2">
                <div class="col-lg-4 col-sm-12">
                    <h4 class="text-gray-800"><?= date('d M Y'); ?></h4>
                </div>
                <div class="col-lg-8 col-sm-12 form-inline">
                    <select name="supplier" class="form-control mr-2" required>
                        <option hidden>-Pilih Supplier-</option>
                        <?php while ($supplier = $suppliers->fetch_assoc()) { ?>
                            <option value="<?= htmlspecialchars($supplier['id_supplier']); ?>">
                                <?= htmlspecialchars($supplier['nama_supplier']); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button type="submit" name="buatPesanan" class="btn btn-sm btn-success">Buat Pesanan</button>
                </div>
            </div>

            <!-- Table -->
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Id Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Sisa Barang (Unit)</th>
                    <th>Jumlah Pemesanan (Unit)</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < $jmlBarang; $i++) { ?>
                    <tr>
                        <input type="hidden" name="barang[]" value="<?= htmlspecialchars($idBarang[$i]); ?>">
                        <td><?= $i + 1; ?></td>
                        <td><?= htmlspecialchars($idBarang[$i]); ?></td>
                        <td><?= htmlspecialchars($namaBarang[$i]); ?></td>
                        <td><?= number_format($hargaBarang[$i], 0, ',', '.'); ?></td>
                        <td><?= htmlspecialchars($sisaBarang[$i]); ?></td>
                        <td>
                            <input type="number" name="jmlPesan[]" class="form-control" min="1" required>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </form>
        <?php
    } else {
        // If POST data is missing
        echo '<div class="alert alert-danger">Data tidak lengkap. Harap pastikan semua data dikirim.</div>';
    }
}
?>
