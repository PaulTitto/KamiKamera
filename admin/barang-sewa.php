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
                                    <th>Harga Barang</th>
                                    <th>Harga Sewa (hari)</th>
                                    <th>Qty</th>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="edit-form">
                <div class="modal-body">
                    <input type="hidden" id="edit-id_barang">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" id="edit-nama_barang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <input type="number" id="edit-harga_barang" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa</label>
                        <input type="number" id="edit-harga_sewa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="number" id="edit-qty" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="text" id="edit-img" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>ID Kategori</label>
                        <input type="text" id="edit-id_kategori" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
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
                        <label>Kategori</label>
                        <select class="form-control" name="id_kategori" id="kategori" required></select>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <input type="number" class="form-control" name="harga_barang" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa</label>
                        <input type="number" class="form-control" name="harga_sewa" required>
                    </div>
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="number" class="form-control" name="qty" required>
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
                            rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.id_barang}</td>
                                <td>${item.nama_barang}</td>
                                <td>${formatRupiah(item.harga_barang)}</td>
                                <td>${formatRupiah(item.harga_sewa)}</td>
                                <td>${item.qty}</td>
                                <td>${item.img}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="hapusBarang('${item.id_barang}')">Hapus</button>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick="openEditModal('${item.id_barang}', '${item.nama_barang}', '${item.harga_barang}', '${item.harga_sewa}', '${item.qty}', '${item.img}', '${item.id_kategori}')">Edit</button>
                                </td>
                            </tr>`;
                        });
                    }
                    $('#table-content').html(rows);
                    $('#datatable').DataTable();
                }
            });
        }

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
        }

        window.hapusBarang = function (id) {
            if (confirm(`Yakin ingin menghapus barang ID ${id}?`)) {
                $.ajax({
                    url: 'http://localhost/rentalcam/admin/assets/php/barang.php',
                    method: 'DELETE',
                    contentType: 'application/json',
                    data: JSON.stringify({ id_barang: id }),
                    success: function () {
                        alert('Barang berhasil dihapus!');
                        loadTable();
                    }
                });
            }
        };

        window.openEditModal = function (id, nama, harga, sewa, qty, img, kategori) {
            $('#edit-id_barang').val(id);
            $('#edit-nama_barang').val(nama);
            $('#edit-harga_barang').val(harga);
            $('#edit-harga_sewa').val(sewa);
            $('#edit-qty').val(qty);
            $('#edit-img').val(img);
            $('#edit-id_kategori').val(kategori);
        };

        $('#edit-form').submit(function (e) {
            e.preventDefault();
            const data = {
                id_barang: $('#edit-id_barang').val(),
                nama_barang: $('#edit-nama_barang').val(),
                harga_barang: $('#edit-harga_barang').val(),
                harga_sewa: $('#edit-harga_sewa').val(),
                qty: $('#edit-qty').val(),
                img: $('#edit-img').val(),
                id_kategori: $('#edit-id_kategori').val(),
            };
            $.ajax({
                url: 'http://localhost/rentalcam/admin/assets/php/barang.php',
                method: 'PUT',
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function () {
                    alert('Data berhasil diperbarui!');
                    $('#editModal').modal('hide');
                    loadTable();
                }
            });
        });

        function loadKategori() {
            $.ajax({
                url: 'http://localhost/rentalcam/admin/assets/php/kategori.php',
                method: 'GET',
                success: function (response) {
                    if (response.status === "success") {
                        let options = '<option value="">Pilih Kategori</option>';
                        $.each(response.data, function (index, kategori) {
                            options += `<option value="${kategori.id_kategori}">${kategori.nama_kategori}</option>`;
                        });
                        $('#kategori').html(options);
                    } else {
                        alert('Gagal memuat kategori.');
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan saat memuat kategori.');
                }
            });
        }

        // Load categories when the modal opens
        $('#tambahModal').on('show.bs.modal', function () {
            loadKategori();
        });

        // Submit form for adding a new item
        $('#tambahBarangForm').submit(function (e) {
            e.preventDefault();

            let formData = new FormData(this); // Handle file upload properly

            $.ajax({
                url: 'http://localhost/rentalcam/admin/assets/php/barang.php',
                method: 'POST',
                data: formData, // Send the form data
                contentType: false, // Needed for file upload
                processData: false, // Prevent jQuery from processing the data
                success: function (response) {
                    if (response.status === 'success') {
                        $('#tambahModal').modal('hide');
                        alert('Barang berhasil ditambahkan.');
                        location.reload(); // Refresh the page or reload the data
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
