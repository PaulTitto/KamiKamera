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
                    <a href="tambahPenyewaan.php" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tambah Penyewaan
                    </a>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="datatable-buttons" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Penyewaan</th>
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
                            // Status modification
                            const statusBadge = item.status === 'Dipinjam'
                                ? '<span class="badge badge-warning">Dipinjam</span>'
                                : '<span class="badge badge-success">Dikembalikan</span>';

                            // Table row generation
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
                                        <button class="btn btn-sm btn-warning edit-btn" data-id="${item.no_transaksi}">Edit</button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="${item.no_transaksi}">Hapus</button>
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

                        // Add event listeners for Edit and Delete buttons
                        addEventListeners();
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

        // Add event listeners for Edit and Delete buttons
        function addEventListeners() {
            // Edit button
            $('.edit-btn').click(function () {
                const id = $(this).data('id');
                window.location.href = `editTransaksi.php?id=${encodeURIComponent(id)}`;
            });

            // Delete button
            $('.delete-btn').click(function () {
                const id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: `http://localhost/rentalcam/admin/assets/php/deleteTransaksi.php`, // Endpoint untuk hapus data
                        method: 'POST',
                        data: { id: id },
                        success: function (response) {
                            if (response.status === 'success') {
                                alert('Data berhasil dihapus.');
                                loadTableData(); // Reload data setelah hapus
                            } else {
                                alert('Gagal menghapus data.');
                            }
                        },
                        error: function () {
                            alert('Terjadi kesalahan pada server.');
                        }
                    });
                }
            });
        }

        // Load table data on page load
        loadTableData();
    });
</script>
</body>
</html>
