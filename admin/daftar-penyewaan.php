<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pengembalian</title>

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

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="datatable-buttons" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Penyewaan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>No Telp</th>
                                    <th>Lama Sewa</th>
                                    <th>Tanggal Sewa</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody id="table-content">
                                <!-- Data will be dynamically populated here -->
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

<!-- Scripts -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        // Fetch Data from REST API
        function loadTableData() {
            $.ajax({
                url: 'http://localhost/rentalcam/admin/assets/php/pengembalian.php', // Your API endpoint
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        let rows = '';
                        $.each(response.data, function (index, item) {
                            const statusBadge = item.status === 'Aman'
                                ? '<span class="badge badge-success">Aman</span>'
                                : '<span class="badge badge-danger">Rusak</span>';

                            rows += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.no_transaksi}</td>
                                    <td>${item.nama_pemesan}</td>
                                    <td>${item.no_telp}</td>
                                    <td>${item.lama_sewa}</td>
                                    <td>${item.tgl_pesan}</td>
                                    <td>${item.tgl_kembali}</td>
                                    <td>${statusBadge}</td>
                                    <td>
                                        <a href="notaPengembalian?menu=pengembalian&id=${encodeURIComponent(item.no_transaksi)}">
                                            <button class="btn btn-sm btn-primary">Proses</button>
                                        </a>
                                    </td>
                                </tr>
                            `;
                        });

                        // Populate table body
                        $('#table-content').html(rows);

                        // Reinitialize DataTable
                        var table = $('#datatable-buttons').DataTable({
                            lengthChange: true,
                            buttons: ['copy', 'excel', 'pdf', 'print']
                        });
                        table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
                    } else {
                        console.error(response.message);
                        alert('Failed to fetch data.');
                    }
                },
                error: function () {
                    alert('Error fetching data from server.');
                }
            });
        }

        // Load table data on page load
        loadTableData();
    });
</script>
</body>
</html>
