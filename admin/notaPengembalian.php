<?php include 'assets/php/db.php';?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Nota Pengembalian</title>

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
            $no_transaksi=$_GET['id'];
            $qPengadaan=mysql_query("SELECT * FROM tb_transaksi WHERE no_transaksi='$no_transaksi'") or die(mysql_error());
            $result=mysql_fetch_array($qPengadaan);
            $exTanggal=explode(' , ',$result['tgl_kembali']);

            //hitung hari
            $tgl=tgl($exTanggal[0]);
            $tanggal_pinjam_buku       = new DateTime($tgl);
            $tanggal_buku_dikembalikan = new DateTime();
            $lama_buku_dipinjam        = $tanggal_buku_dikembalikan->diff($tanggal_pinjam_buku)->format("%a");

            //hitung jam
            $waktu = time();
            $wkt=$exTanggal[1];
            $ekt1=str_replace(' WIB','',$wkt);
            $pisah=explode(':',$ekt1);
            if ($pisah[0]<10) {
              $waktu_pinjam='0'.$pisah[0].':'.$pisah[1];
            }else{
              $waktu_pinjam=$pisah[0].':'.$pisah[1];
            }
            $waktu_sekarang=date('H:i',$waktu);

            $awal  = strtotime($waktu_pinjam); //waktu awal
            $akhir = strtotime($waktu_sekarang); //waktu akhir
            $diff  = $akhir - $awal;
            $jam   = floor($diff / (60 * 60));$diff - $jam * (60 * 60);

            $biayaDenda=3000;
            if ($lama_buku_dipinjam==0) {
              if ($jam>3) {
                $denda=$biayaDenda;
                $ket='Melebihi Waktu Toleransi';
              }else{
                $denda=0;
                $ket='Tepat Waktu';
              }
            }else{
              $denda=$lama_buku_dipinjam*$biayaDenda;
              $ket='Terlambat Selama '.$lama_buku_dipinjam.' Hari';
            }
          }
        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <form action="tambahPengadaan?menu=Pengadaan" method="POST">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Nomor Penyewaan : <?=$no_transaksi;?></h1>
            <button type="button" class="btn btn-sm btn-primary" onclick="window.location.assign('daftar-pengembalian?menu=pengembalian')">Kembali</button>
          </div>
          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                <div class="text-left mb-3">
                  <div class="row">
                    <div class="col-lg-6 col-sm-12">
                      <table>
                        <tr>
                          <td>Nama Pelanggan</td>
                          <td width="15" style="text-align: center;">:</td>
                          <td><?=$result['nama_pemesan'];?></td>
                        </tr>
                        <tr>
                          <td>No Telp</td>
                          <td style="text-align: center;">:</td>
                          <td><?=$result['no_telp'];?></td
                        </tr>
                        <tr>
                          <td>Lama Sewa</td>
                          <td style="text-align: center;">:</td>
                          <td><?=$result['lama_sewa'];?> Hari</td>
                        </tr>
                      </table>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                      <table>
                        <tr>
                          <td>Tanggal Sewa</td>
                          <td width="15" style="text-align: center;">:</td>
                          <td><?=$result['tgl_pesan'];?></td>
                        </tr>
                        <tr>
                          <td>Tanggal Kembali</td>
                          <td style="text-align: center;">:</td>
                          <td><?=$result['tgl_kembali'];?></td>
                        </tr>
                        <tr>
                          <td>Lama Sewa</td>
                          <td style="text-align: center;">:</td>
                          <td><?=$result['lama_sewa'];?> Hari</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <h6 class="text-center">List Barang Yang Dipesan</h6>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tr>
                        <th>No</th>
                        <th>Id Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Disewa (Unit)</th>
                      </tr>
                      <?php 
                      $no=1;
                      $qBarang=mysql_query("SELECT tb_transaksi_detail.id_barang, nama_barang, qty_sewa FROM tb_transaksi_detail JOIN tb_barang ON tb_transaksi_detail.id_barang=tb_barang.id_barang WHERE no_transaksi='$no_transaksi'") or die(mysql_error());
                      while ($hasil=mysql_fetch_array($qBarang)) { ?>
                      <tr>
                        <td><?=$no;?></td>
                        <td><?=$hasil['id_barang'];?></td>
                        <td><?=$hasil['nama_barang'];?></td>
                        <td><?=$hasil['qty_sewa'];?></td>
                      </tr>
                      <?php
                      } $no++;
                      ?>
                    </table>
                  </div>

                  <!-- perhitungan -->
                  <div class="row">
                    <div class="col-lg-4 col-sm-12">
                      <label>Total</label><br>
                      <label><?=rupiah($result['total_bayar']);?></label>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                      <label>Denda</label><br>
                      <label><?=rupiah($denda);?></label>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                      <label>Keterangan</label><br>
                      <label><?=$ket;?></label>
                    </div>
                  </div>
                  <label class="h4">Total</label><br>
                  <label class="h4"><b><?=rupiah($result['total_bayar']+$denda);?></b></label>
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
