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

    <title>Daftar Pengadaan</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/css/alertify.min.css" rel="stylesheet">
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
                <form action="tambahPengadaan?menu=Pengadaan" method="POST">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Barang Sewa</h1>
                        <h5 class="mb-0 text-gray-800"><i>Checklist</i> Barang Dibawah Lalu
                            <button class="btn btn-sm btn-primary" name="pengadaanBarang">Buat Pengadaan</button>
                        </h5>
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
                                                <th>Id Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Harga Barang</th>
                                                <th>Qty (unit)</th>
                                                <th>Status</th>
                                                <th>Pilih Barang</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sql = "SELECT * FROM tb_barang WHERE qty <= 5 ORDER BY qty ASC";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $i = 1;

                                            while ($res = $result->fetch_assoc()) {
                                                $status = ($res['qty'] > 0) ?
                                                    '<span class="badge badge-warning">Hampir Habis</span>' :
                                                    '<span class="badge badge-secondary">Tidak Tersedia</span>';
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo htmlspecialchars($res['id_barang']); ?></td>
                                                    <td>
                                                        <?php echo htmlspecialchars($res['nama_barang']); ?>
                                                        <input type="hidden" name="namaBarang[]" value="<?php echo htmlspecialchars($res['nama_barang']); ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo number_format($res['harga_barang'], 0, ',', '.'); ?>
                                                        <input type="hidden" name="hargaBarang[]" value="<?php echo $res['harga_barang']; ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo $res['qty']; ?>
                                                        <input type="hidden" name="sisaBarang[]" value="<?php echo $res['qty']; ?>">
                                                    </td>
                                                    <td><?php echo $status; ?></td>
                                                    <td>
                                                        <input type="checkbox" name="idBarang[]" value="<?php echo $res['id_barang']; ?>">
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

        <!-- Footer -->
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
<script src="assets/js/demo/datatables-demo.js"></script>
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
