<?php include 'assets/php/db.php';?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Nota Pengadaan</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- DataTables -->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="assets/vendor/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Alertify -->
  <link href="assets/css/alertify.min.css" rel="stylesheet" type='text/css' />
  <!-- Responsive datatable examples -->
  <link href="assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include 'assets/layout/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include 'assets/layout/topbar.php'; ?>
        <?php
          if ($_GET['id']) {
            $noPengadaan=$_GET['id'];
            $qPengadaan=mysql_query("SELECT * FROM tb_pengadaan JOIN tb_supplier ON tb_pengadaan.id_supplier=tb_supplier.id_supplier WHERE no_pengadaan='$noPengadaan'") or die(mysql_error());
            $result=mysql_fetch_array($qPengadaan);
          }
        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <form action="tambahPengadaan?menu=Pengadaan" method="POST">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Nomor Pengadaan : <?=$noPengadaan;?></h1>
            <button type="button" class="btn btn-sm btn-primary" onclick="window.location.assign('daftar-notaPengadaan?menu=notaPengadaan')">Kembali</button>
          </div>
          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                <div class="text-left mb-3">
                  <table>
                    <tr>
                      <td>Nama Supplier</td>
                      <td width="15" style="text-align: center;">:</td>
                      <td><?=$result['nama_supplier'];?></td>
                    </tr>
                    <tr>
                      <td>Nomor Telepon Supplier</td>
                      <td style="text-align: center;">:</td>
                      <td><?=$result['no_hp'];?></td
                    </tr>
                    <tr>
                      <td>Tanggal Pemesanan</td>
                      <td style="text-align: center;">:</td>
                      <td><?=tanggal($result['tanggal']);?></td>
                    </tr>
                  </table>
                </div>
                <h6 class="text-center">List Barang Yang Dipesan</h6>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tr>
                        <th>No</th>
                        <th>Id Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Dipesan (Unit)</th>
                        <th>Status Barang</th>
                      </tr>
                      <?php 
                      $no=1;
                      $qBarang=mysql_query("SELECT tb_detail_pengadaan.id_barang, nama_barang, tb_detail_pengadaan.qty FROM tb_pengadaan JOIN tb_detail_pengadaan ON tb_pengadaan.no_pengadaan=tb_detail_pengadaan.no_pengadaan JOIN tb_barang ON tb_detail_pengadaan.id_barang=tb_barang.id_barang WHERE tb_pengadaan.no_pengadaan='$noPengadaan'") or die(mysql_error());
                      while ($hasil=mysql_fetch_array($qBarang)) { ?>
                      <tr>
                        <td><?=$no;?></td>
                        <td><?=$hasil['id_barang'];?></td>
                        <td><?=$hasil['nama_barang'];?></td>
                        <td><?=$hasil['qty'];?></td>
                        <td>
                          <select name="status" class="form-control">
                            <option value="1">Sesuai</option>
                            <option value="0">Tidak Sesuai</option>
                          </select>
                        </td>
                      </tr>
                      <?php
                      } $no++;
                      ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          </form>

        </div>

      </div>  
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include'assets/layout/footer.php';?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <!-- Page level vendor -->
  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Buttons examples -->
  <script src="assets/vendor/datatables/dataTables.buttons.min.js"></script>
  <script src="assets/vendor/datatables/buttons.bootstrap4.min.js"></script>
  <script src="assets/vendor/datatables/jszip.min.js"></script>
  <script src="assets/vendor/datatables/pdfmake.min.js"></script>
  <script src="assets/vendor/datatables/vfs_fonts.js"></script>
  <script src="assets/vendor/datatables/buttons.html5.min.js"></script>
  <script src="assets/vendor/datatables/buttons.print.min.js"></script>
  <script src="assets/vendor/datatables/buttons.colVis.min.js"></script>
  <!-- Responsive examples -->
  <script src="assets/vendor/datatables/dataTables.responsive.min.js"></script>
  <script src="assets/vendor/datatables/responsive.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/js/demo/datatables-demo.js"></script>
  <script src="assets/js/demo/chart-area-demo.js"></script>
  <script src="assets/js/demo/chart-pie-demo.js"></script>
  <script src="assets/js/alertify.min.js"></script>
  <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();
                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: true,
                    buttons: ['copy', 'excel', 'pdf']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );
  </script>
</body>

</html>
