<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laporan Penyewaan</title>

    <!-- Custom fonts and styles -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'assets/layout/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include 'assets/layout/topbar.php'; ?>
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Laporan Penyewaan</h1>
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <form>
                                        <label>Tanggal Awal</label>
                                        <input type="date" name="tglAwal" class="form-control mb-4" required>
                                        <label>Tanggal Akhir</label>
                                        <input type="date" name="tglAkhir" class="form-control mb-4" required>
                                        <button type="submit" class="btn btn-primary">Proses Laporan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'assets/layout/footer.php'; ?>
    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

<!-- Scripts -->
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
<script src="assets/vendor/datatables/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#datatable-buttons').DataTable({
            lengthChange: true,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });
        table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });
</script>
</body>
</html>
