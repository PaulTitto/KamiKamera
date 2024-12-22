<?php include 'assets/php/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Penyewaan</title>

    <!-- Custom fonts & styles -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Alertify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/themes/default.min.css" />
</head>

<body id="page-top">
<div id="wrapper">
    <?php include 'assets/layout/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include 'assets/layout/topbar.php'; ?>
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Barang Sewa</h1>
                <!-- Button to Open the Modal -->
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#tambahModal">Tambah Barang</button>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Lama Sewa (hari)</th>
                                    <th>Harga Sewa (hari)</th>
                                    <th>Image</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody id="table-content">
                                <!-- Data populated dynamically -->
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

<!-- Tambah Barang Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tambahBarangForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Sewa</label>
                        <input type="date" class="form-control" name="tgl_sewa" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kembali</label>
                        <input type="date" class="form-control" name="tgl_kembali" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa (hari)</label>
                        <input type="number" class="form-control" name="harga_sewa" required>
                    </div>
                    <div class="form-group">
                        <label>Gambar Barang</label>
                        <input type="file" class="form-control" name="img" accept=".jpg, .jpeg, .png" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Barang</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.js"></script>

<script>
    $(document).ready(function () {
        function loadTable() {
            $.ajax({
                url: 'http://localhost/rentalcam/admin/assets/php/barang.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    let rows = '';
                    if (response.status === 'success') {
                        response.data.forEach((item, index) => {
                            const lamaSewa = calculateDays(item.tgl_sewa, item.tgl_kembali);
                            rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.id_barang}</td>
                                <td>${item.nama_barang}</td>
                                <td>${item.tgl_sewa}</td>
                                <td>${item.tgl_kembali}</td>
                                <td>${lamaSewa}</td>
                                <td>${formatRupiah(item.harga_sewa)}</td>
                                <td><img src="${item.img}" alt="Image" style="width:50px;height:auto;"></td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="hapusBarang('${item.id_barang}')">Hapus</button>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">Edit</button>
                                </td>
                            </tr>`;
                        });
                    }
                    $('#table-content').html(rows);
                    $('#datatable').DataTable();
                }
            });
        }

        function calculateDays(startDate, endDate) {
            const start = new Date(startDate);
            const end = new Date(endDate);
            const diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24)); // Convert milliseconds to days
            return diff > 0 ? diff : 0;
        }

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
        }

        $('#tambahBarangForm').submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: 'http://localhost/rentalcam/admin/assets/php/barang.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Barang berhasil ditambahkan.');
                        $('#tambahModal').modal('hide');
                        loadTable();
                    } else {
                        alert('Gagal menambahkan barang: ' + response.message);
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan saat menambahkan barang.');
                }
            });
        });

        loadTable();
    });
</script>
</body>
</html>
