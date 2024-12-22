<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daftar Penyewaan</title>

    <!-- Custom Fonts and Styles -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
<div id="wrapper">
    <?php include 'assets/layout/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include 'assets/layout/topbar.php'; ?>

            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Daftar Penyewaan</h1>

                <!-- Tombol Tambah Penyewaan -->
                <div class="mb-3">
                    <button id="btn-tambah-penyewaan" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Penyewaan
                    </button>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="datatable-buttons" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Penyewaan</th>
                                    <th>Nama Pemesan</th>
                                    <th>Nama Barang</th>
                                    <th>Lama Sewa (hari)</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Harga Sewa</th>
                                    <th>Total Bayar</th>
                                    <th>Foto Jaminan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody id="table-content">
                                <!-- Data akan dimuat secara dinamis -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'assets/layout/footer.php'; ?>
    </div>
</div>

<!-- Modal Tambah Penyewaan -->
<div class="modal fade" id="modalTambahPenyewaan" tabindex="-1" aria-labelledby="modalTambahPenyewaanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPenyewaanLabel">Tambah Penyewaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-tambah-penyewaan">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaPemesan">Nama Pemesan</label>
                        <input type="text" class="form-control" id="namaPemesan" name="namaPemesan" required>
                    </div>
                    <div class="form-group">
                        <label for="namaBarang">Nama Barang</label>
                        <select class="form-control" id="namaBarang" name="namaBarang" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            <option value="1" data-harga="50000">Kamera A</option>
                            <option value="2" data-harga="75000">Kamera B</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lamaSewa">Lama Sewa (hari)</label>
                        <input type="number" class="form-control" id="lamaSewa" name="lamaSewa" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tglPesan">Tanggal Pesan</label>
                        <input type="date" class="form-control" id="tglPesan" name="tglPesan" required>
                    </div>
                    <div class="form-group">
                        <label for="tglKembali">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tglKembali" name="tglKembali" required>
                    </div>
                    <div class="form-group">
                        <label for="hargaSewa">Harga Sewa (per hari)</label>
                        <input type="text" class="form-control" id="hargaSewa" name="hargaSewa" readonly>
                    </div>
                    <div class="form-group">
                        <label for="totalBayar">Total Bayar</label>
                        <input type="text" class="form-control" id="totalBayar" name="totalBayar" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fotoJaminan">Foto Jaminan</label>
                        <input type="file" class="form-control" id="fotoJaminan" name="fotoJaminan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        // Hitung lama sewa dan total bayar
        $('#tglPesan, #tglKembali').on('change', function () {
            const tglPesan = new Date($('#tglPesan').val());
            const tglKembali = new Date($('#tglKembali').val());
            if (tglPesan && tglKembali && tglKembali > tglPesan) {
                const lamaSewa = Math.ceil((tglKembali - tglPesan) / (1000 * 60 * 60 * 24));
                $('#lamaSewa').val(lamaSewa);
                const hargaSewa = parseInt($('#hargaSewa').val()) || 0;
                $('#totalBayar').val(lamaSewa * hargaSewa);
            } else {
                $('#lamaSewa').val('');
                $('#totalBayar').val('');
            }
        });

        // Isi harga sewa saat nama barang dipilih
        $('#namaBarang').on('change', function () {
            const selectedOption = $(this).find('option:selected');
            const harga = selectedOption.data('harga');
            $('#hargaSewa').val(harga);
            const lamaSewa = parseInt($('#lamaSewa').val()) || 0;
            $('#totalBayar').val(lamaSewa * harga);
        });

        // Memuat data tabel
        function loadTableData() {
            $.ajax({
                url: 'http://localhost/rentalcam/admin/assets/php/pengembalian.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        let rows = '';
                        $.each(response.data, function (index, item) {
                            const statusBadge = item.status === 'Dipinjam'
                                ? '<span class="badge badge-warning">Dipinjam</span>'
                                : '<span class="badge badge-success">Dikembalikan</span>';
                            rows += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.no_transaksi}</td>
                                    <td>${item.nama_pemesan}</td>
                                    <td>${item.nama_barang}</td>
                                    <td>${item.lama_sewa}</td>
                                    <td>${item.tgl_pesan}</td>
                                    <td>${item.tgl_kembali}</td>
                                    <td>${item.harga_sewa}</td>
                                    <td>${item.total_bayar}</td>
                                    <td><img src="${item.foto_jaminan}" alt="Jaminan" width="50"></td>
                                    <td>${statusBadge}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning edit-btn" data-id="${item.no_transaksi}">Edit</button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="${item.no_transaksi}">Hapus</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#table-content').html(rows);
                    } else {
                        alert('Gagal memuat data.');
                    }
                },
                error: function () {
                    alert('Kesalahan server.');
                }
            });
        }

        // Tombol Tambah Penyewaan
        $('#btn-tambah-penyewaan').click(function () {
            $('#modalTambahPenyewaan').modal('show');
        });

        // Form submit handler
        $('#form-tambah-penyewaan').submit(function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: 'http://localhost/rentalcam/admin/assets/php/tambahTransaksi.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Data berhasil ditambahkan!');
                        $('#modalTambahPenyewaan').modal('hide');
                        loadTableData();
                    } else {
                        alert('Gagal menambahkan data.');
                    }
                },
                error: function () {
                    alert('Kesalahan server.');
                }
            });
        });

        // Memuat data saat halaman dimuat
        loadTableData();
    });
</script>
</body>
</html>
