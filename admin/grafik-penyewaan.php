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
                                <tbody id="table-content"></tbody>
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
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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

<!-- Edit Barang Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="editBarangForm">
                <div class="modal-body">
                    <input type="hidden" name="id_barang" id="edit_id_barang">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="edit_nama_barang" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Sewa</label>
                        <input type="date" class="form-control" name="tgl_sewa" id="edit_tgl_sewa" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kembali</label>
                        <input type="date" class="form-control" name="tgl_kembali" id="edit_tgl_kembali" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa (hari)</label>
                        <input type="number" class="form-control" name="harga_sewa" id="edit_harga_sewa" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.js"></script>
<script>
    $(document).ready(function () {
        function loadTable() {
            $.ajax({
                url: 'assets/php/barang.php',
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
                                <td>${item.harga_sewa}</td>
                                <td><img src="${item.img}" alt="Image" style="width:50px;height:auto;"></td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="hapusBarang('${item.id_barang}')">Hapus</button>
                                    <button class="btn btn-warning btn-sm" onclick="editBarang('${item.id_barang}')">Edit</button>
                                </td>
                            </tr>`;
                        });
                    }
                    $('#table-content').html(rows);
                    $('#datatable').DataTable();
                }
            });
        }

        function hapusBarang(id_barang) {
            if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
                $.ajax({
                    url: 'assets/php/barang.php',
                    method: 'DELETE',
                    data: { id_barang: id_barang },
                    success: function (response) {
                        if (response.status === 'success') {
                            alert('Barang berhasil dihapus.');
                            loadTable();
                        } else {
                            alert('Gagal menghapus barang.');
                        }
                    }
                });
            }
        }

        function editBarang(id_barang) {
            $.ajax({
                url: 'assets/php/barang.php',
                method: 'GET',
                data: { id_barang: id_barang },
                success: function (response) {
                    if (response.status === 'success') {
                        const data = response.data;
                        $('#edit_id_barang').val(data.id_barang);
                        $('#edit_nama_barang').val(data.nama_barang);
                        $('#edit_tgl_sewa').val(data.tgl_sewa);
                        $('#edit_tgl_kembali').val(data.tgl_kembali);
                        $('#edit_harga_sewa').val(data.harga_sewa);
                        $('#editModal').modal('show');
                    } else {
                        alert('Gagal memuat data.');
                    }
                }
            });
        }

        $('#editBarangForm').submit(function (e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'assets/php/barang.php',
                method: 'PUT',
                data: formData,
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Barang berhasil diupdate.');
                        $('#editModal').modal('hide');
                        loadTable();
                    } else {
                        alert('Gagal mengupdate barang.');
                    }
                }
            });
        });

        $('#tambahBarangForm').submit(function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: 'assets/php/barang.php',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Barang berhasil ditambahkan.');
                        $('#tambahModal').modal('hide');
                        loadTable();
                    } else {
                        alert('Gagal menambahkan barang.');
                    }
                }
            });
        });

        loadTable();
    });
</script>
</body>
</html>
