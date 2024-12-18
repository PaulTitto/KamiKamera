<?php
global $conn;
include 'assets/php/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Penyewaan</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<div id="wrapper">
    <?php include 'assets/layout/sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include 'assets/layout/topbar.php'; ?>

            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Daftar Penyewaan</h1>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="datatable-buttons" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Harga Barang</th>
                                            <th>Harga Sewa (hari)</th>
                                            <th>Qty (unit)</th>
                                            <th>Status</th>
                                            <th width="98">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table-content">
                                        <!-- Data will be dynamically loaded here -->
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Data</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="row">
                                    <div class="col-lg-9 col-sm-12">
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <input type="text" name="namaBarang" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="number" name="qty" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Harga Barang</label>
                                            <input type="number" name="hargaBarang" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Harga Sewa (hari)</label>
                                            <input type="number" name="hargaSewa" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <center>
                                    <button class="btn btn-success btn-sm">Simpan</button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php include 'assets/layout/footer.php'; ?>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="assets/js/sb-admin-2.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/vendor/datatables/dataTables.buttons.min.js"></script>
<script src="assets/vendor/datatables/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/datatables/jszip.min.js"></script>
<script src="assets/vendor/datatables/pdfmake.min.js"></script>
<script src="assets/vendor/datatables/vfs_fonts.js"></script>
<script src="assets/vendor/datatables/buttons.html5.min.js"></script>
<script src="assets/vendor/datatables/buttons.print.min.js"></script>
<script src="assets/vendor/datatables/dataTables.responsive.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        // Function to load table data
        function loadTable() {
            $.ajax({
                url: 'http://localhost/rentalcam/admin/assets/php/penyewa.php', // REST API Endpoint
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    let tableRows = '';
                    if (response.status === 'success') {
                        $.each(response.data, function (index, item) {
                            // Format the status badge
                            let statusBadge = item.status === 'Dikembalikan'
                                ? '<span class="badge badge-success">Dikembalikan</span>'
                                : '<span class="badge badge-danger">Dipinjam</span>';

                            tableRows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.id_barang}</td>
                                <td>${item.nama_barang}</td>
                                <td>${formatRupiah(item.harga_barang)}</td>
                                <td>${formatRupiah(item.harga_sewa)}</td>
                                <td>${item.qty}</td>
                                <td>${statusBadge}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal">Edit</button>
                                </td>
                            </tr>
                        `;
                        });
                    } else {
                        tableRows = `<tr><td colspan="8" class="text-center">No data available</td></tr>`;
                    }

                    // Append the rows to the table body
                    $('#table-content').html(tableRows);

                    // Initialize DataTables
                    $('#datatable-buttons').DataTable();
                },
                error: function () {
                    alert('Failed to fetch data from the server.');
                }
            });
        }

        // Format number to currency (Rupiah)
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
        }

        // Load table on page load
        loadTable();
    });

</script>
</body>
</html>
