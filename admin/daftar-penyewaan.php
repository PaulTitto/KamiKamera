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
    
    <style>
        .status-dipinjam {
            color: #fff;
            background-color: #dc3545;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .status-dikembalikan {
            color: #fff;
            background-color: #28a745;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>

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
                    <button id="btn-tambah-penyewaan" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalTambahPenyewaan">
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
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Lama Sewa (hari)</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Harga Sewa</th>
                                    <th>Total Bayar</th>
                                    <th>Kartu Jaminan</th>
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
                    <label for="id_transaksi">ID Penyewaan</label>
                    <input type="text" class="form-control" id="id_transaksi" name="id_transaksi" required>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaPemesan">Nama Pemesan</label>
                        <input type="text" class="form-control" id="namaPemesan" name="nama_pemesan" required>
                    </div>
                    <div class="form-group">
                        <label for="idBarang">ID Barang</label>
                        <input type="text" class="form-control" id="idBarang" name="id_barang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="namaBarang">Nama Barang</label>
                        <select class="form-control" id="namaBarang" name="id_barang" required>
                            <option value="" disabled selected>Pilih Barang</option>
                        </select>
                        <input type="hidden" id="hiddenNamaBarang" name="nama_barang">

                    </div>

                    <div class="form-group">
                        <label for="lamaSewa">Lama Sewa (hari)</label>
                        <input type="number" class="form-control" id="lamaSewa" name="lama_sewa" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tglPesan">Tanggal Pesan</label>
                        <input type="date" class="form-control" id="tglPesan" name="tgl_pesan" required>
                    </div>
                    <div class="form-group">
                        <label for="tglKembali">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tglKembali" name="tgl_kembali" required>
                    </div>
                    <div class="form-group">
                        <label for="hargaSewa">Harga Sewa (per hari)</label>
                        <input type="text" class="form-control" id="hargaSewa" name="harga_sewa" readonly>
                    </div>
                    <div class="form-group">
                        <label for="totalBayar">Total Bayar</label>
                        <input type="text" class="form-control" id="totalBayar" name="total_bayar" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kartuJaminan">Kartu Jaminan</label>
                        <select class="form-control" id="kartuJaminan" name="kartu_jaminan" required>
                            <option value="" disabled selected>Pilih Kartu Jaminan</option>
                            <option value="ktp">KTP</option>
                            <option value="sim">SIM</option>
                            <option value="ktm">KTM</option>
                            <option value="kta">KTA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="statusPenyewaan">Status</label>
                        <select class="form-control" id="statusPenyewaan" name="status">
                            <option value="Dipinjam" class="status-dipinjam">Dipinjam</option>
                            <option value="Dikembalikan" class="status-dikembalikan">Dikembalikan</option>
                        </select>
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

<!-- Modal Edit Penyewaan -->
<div class="modal fade" id="modalEditPenyewaan" tabindex="-1" aria-labelledby="modalEditPenyewaanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPenyewaanLabel">Edit Penyewaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-edit-penyewaan">
                <div class="modal-body">
                <input type="hidden" id="id_transaksi" name="id_transaksi">
                <input type="text" id="nama_pemesan" name="nama_pemesan">
                <input type="text" id="id_barang" name="id_barang">
                <input type="text" id="nama_barang" name="nama_barang">
                <input type="number" id="lama_sewa" name="lama_sewa">
                <input type="date" id="tanggal_pesan" name="tanggal_pesan">
                <input type="date" id="tanggal_kembali" name="tanggal_kembali">
                <input type="text" id="harga_sewa" name="harga_sewa">
                <input type="text" id="total_bayar" name="total_bayar">
                <input type="text" id="kartu_jaminan" name="kartu_jaminan">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
        // Fungsi untuk memuat data barang dari database
        function loadBarangOptions() {
            $.ajax({
                url: 'load-barang.php', // Endpoint PHP untuk mengambil data barang
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        let options = '<option value="" disabled selected>Pilih Barang</option>';
                        $.each(response.data, function (index, item) {
                            options += `<option value="${item.id_barang}" data-harga="${item.harga_sewa}">${item.nama_barang}</option>`;
                        });
                        $('#namaBarang').html(options);
                    } else {
                        alert('Gagal memuat data barang: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('Kesalahan server: ' + error);
                }
            });
        }


        // Sinkronisasi Nama Barang ke ID Barang
        $(document).on('change', '#namaBarang', function () {
        const selectedOption = $(this).find(':selected');
        const idBarang = selectedOption.val(); // Ambil id_barang
        const hargaSewa = selectedOption.data('harga'); // Ambil harga_sewa
        $('#idBarang').val(idBarang); // Isi input ID Barang
        $('#hargaSewa').val(hargaSewa); // Isi input Harga Sewa
    });



        $(document).ready(function () {
        // Fungsi untuk memuat data transaksi
        function loadTransaksiTable() {
            $.ajax({
                url: 'load-transaksi.php',
                method: 'GET',
                success: function (data) {
                    $('#table-content').html(data);
                },
                error: function () {
                    alert('Gagal memuat data transaksi.');
                }
            });
        }

        // Klik tombol Edit
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id'); // Ambil ID transaksi dari atribut data-id pada tombol Edit
            $.ajax({
                url: 'get-transaksi.php', // Endpoint untuk mengambil data transaksi berdasarkan ID
                method: 'GET',
                data: { id: id }, // Kirim ID transaksi sebagai parameter
                dataType: 'json', // Respons dalam format JSON
                success: function (res) {
                    if (res.status === 'success') {
                        // Isi form modal edit dengan data yang diterima dari server
                        $('#form-edit-penyewaan #id_transaksi').val(res.data.id_transaksi);
                        $('#form-edit-penyewaan #nama_pemesan').val(res.data.nama_pemesan);
                        $('#form-edit-penyewaan #nama_barang').val(res.data.id_barang);
                        $('#form-edit-penyewaan #lama_sewa').val(res.data.lama_sewa);
                        $('#form-edit-penyewaan #tanggal_pesan').val(res.data.tanggal_pesan);
                        $('#form-edit-penyewaan #tanggal_kembali').val(res.data.tanggal_kembali);
                        $('#form-edit-penyewaan #harga_sewa').val(res.data.harga_sewa);
                        $('#form-edit-penyewaan #total_bayar').val(res.data.total_bayar);
                        $('#form-edit-penyewaan #kartu_jaminan').val(res.data.kartu_jaminan);

                        // Tampilkan modal edit
                        $('#modalEditPenyewaan').modal('show');
                    } else {
                        alert('Gagal mengambil data: ' + res.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        });


        // Klik tombol Hapus
        $(document).on('click', '.btn-hapus', function () {
            const id = $(this).data('id');
            if (confirm('Yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: 'hapus-transaksi.php',
                    method: 'POST',
                    data: { id : id_transaksi },
                    success: function (res) {
                        const response = JSON.parse(res);
                        if (response.status === 'success') {
                            alert('Data berhasil dihapus!');
                            loadTransaksiTable();
                        } else {
                            alert('Gagal menghapus data.');
                        }
                    }
                });
            }
        });

        // Muat data saat halaman dimuat
        loadTransaksiTable();
    });

        // Fungsi untuk menghitung lama sewa
        function hitungLamaSewa() {
            const tglPesan = $('#tglPesan').val();
            const tglKembali = $('#tglKembali').val();

            if (tglPesan && tglKembali) {
                const date1 = new Date(tglPesan);
                const date2 = new Date(tglKembali);

                if (date2 >= date1) {
                    const diffTime = Math.abs(date2 - date1);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    $('#lamaSewa').val(diffDays);
                    hitungTotalBayar();
                } else {
                    alert('Tanggal kembali tidak boleh lebih awal dari tanggal pesan!');
                    $('#tglKembali').val('');
                    $('#lamaSewa').val('');
                    $('#totalBayar').val('');
                }
            }
        }

        // Fungsi untuk menghitung total bayar
        function hitungTotalBayar() {
            const lamaSewa = parseInt($('#lamaSewa').val()) || 0;
            const hargaSewa = parseFloat($('#hargaSewa').val()) || 0;
            const totalBayar = lamaSewa * hargaSewa;
            $('#totalBayar').val(totalBayar.toFixed(2));
        }

        // Fungsi untuk memuat data transaksi terbaru ke dalam tabel
        function loadTransaksiTable() {
            $.ajax({
                url: 'load-transaksi.php', // Endpoint untuk mengambil data dari tb_transaksi
                method: 'GET',
                dataType: 'html',
                success: function (response) {
                    $('#table-content').html(response); // Memuat data ke tbody tabel
                },
                error: function (xhr, status, error) {
                    alert('Gagal memuat data transaksi: ' + error);
                }
            });
        }

        // Event Listener untuk Dropdown Nama Barang
        $(document).on('change', '#namaBarang', function () {
            const selectedOption = $(this).find(':selected');
            const hargaSewa = selectedOption.data('harga');
            $('#hargaSewa').val(hargaSewa || '');
            hitungTotalBayar();
        });

        // Event Listener untuk input tanggal pesan dan tanggal kembali
        $(document).on('change', '#tglPesan, #tglKembali', function () {
            hitungLamaSewa();
        });

        // Submit Form Tambah Penyewaan
        $('#form-tambah-penyewaan').on('submit', function (e) {
    e.preventDefault(); // Mencegah halaman reload

    const formData = $(this).serialize(); // Mengambil data form

    // Debug: tampilkan data yang dikirim
    console.log(formData);

    $.ajax({
        url: 'simpan-transaksi.php', // Endpoint PHP untuk menyimpan data
        method: 'POST',
        data: formData, // Kirim data form
        success: function (response) {
            const res = JSON.parse(response); // Mengurai respons JSON
            if (res.status === 'success') {
                alert('Data berhasil disimpan!');
                $('#form-tambah-penyewaan')[0].reset(); // Reset form
                loadTransaksiTable(); // Memuat ulang tabel transaksi
            } else {
                alert('Gagal menyimpan data: ' + res.message);
            }
        },
        error: function (xhr, status, error) {
            alert('Kesalahan server: ' + error);
        }
    });
});


        // Muat data barang dan transaksi saat halaman dimuat
        loadBarangOptions();
        loadTransaksiTable();
    });
</script>

</body>
</html>
