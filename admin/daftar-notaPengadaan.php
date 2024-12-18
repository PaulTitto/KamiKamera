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

    <title>Nota Pengadaan</title>

    <!-- Custom fonts -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/css/alertify.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

<div id="wrapper">
    <?php include 'assets/layout/sidebar.php'; ?>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include 'assets/layout/topbar.php'; ?>

            <div class="container-fluid">
                <form action="tambahPengadaan?menu=Pengadaan" method="POST">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Nota Pengadaan</h1>
                    </div>

                    <!-- Table Content -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="datatable-buttons" width="100%" cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Nota</th>
                                                <th>Tanggal Pemesanan</th>
                                                <th>Supplier</th>
                                                <th>No Hp Supplier</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query = "SELECT * FROM tb_pengadaan 
                                                              JOIN tb_supplier 
                                                              ON tb_pengadaan.id_supplier = tb_supplier.id_supplier 
                                                              ORDER BY no_pengadaan DESC, status";
                                            $stmt = $conn->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $i = 1;

                                            while ($res = $result->fetch_assoc()) {
                                                switch ($res['status']) {
                                                    case '2':
                                                        $status = '<span class="badge badge-danger">Batal</span>';
                                                        break;
                                                    case '1':
                                                        $status = '<span class="badge badge-success">Selesai</span>';
                                                        break;
                                                    default:
                                                        $status = '<span class="badge badge-secondary">Dipesan</span>';
                                                        break;
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo htmlspecialchars($res['no_pengadaan']); ?></td>
                                                    <td><?php echo htmlspecialchars(tanggal($res['tanggal'])); ?></td>
                                                    <td><?php echo htmlspecialchars($res['nama_supplier']); ?></td>
                                                    <td><?php echo htmlspecialchars($res['no_hp']); ?></td>
                                                    <td><?php echo $status; ?></td>
                                                    <td>
                                                        <a href="notaPengadaan?menu=notaPengadaan&id=<?php echo htmlspecialchars($res['no_pengadaan']); ?>">
                                                            <button type="button" class="btn btn-sm btn-primary">Lihat Nota</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            $stmt->close();
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php include 'assets/layout/footer.php'; ?>
    </div>
</div>

<!-- Scripts -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/vendor/datatables/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/datatables/jszip.min.js"></script>
<script src="assets/vendor/datatables/pdfmake.min.js"></script>
<script src="assets/vendor/datatables/vfs_fonts.js"></script>
<script src="assets/vendor/datatables/buttons.html5.min.js"></script>
<script src="assets/vendor/datatables/buttons.print.min.js"></script>
<script src="assets/vendor/datatables/buttons.colVis.min.js"></script>
<script src="assets/vendor/datatables/dataTables.responsive.min.js"></script>
<script src="assets/vendor/datatables/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable-buttons').DataTable({
            lengthChange: true,
            buttons: ['copy', 'excel', 'pdf']
        }).buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });
</script>
</body>

</html>
<?php
$conn->close();
?>
