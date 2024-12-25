<?php include 'assets/php/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>KamiKamera | Admin</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
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
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Grafik Penyewaan</h5>
              <hr>
              <div id="grafik"></div>
                <?php
                  // Query untuk menghitung jumlah penyewa per hari berdasarkan tgl_pesan
                  $query = "
                    SELECT tgl_pesan, COUNT(nama_pemesan) as jumlah_penyewa
                    FROM tb_transaksi
                    GROUP BY tgl_pesan
                    ORDER BY tgl_pesan
                  ";
                  $transaksi = mysqli_query($conn, $query);
                  $data = [];

                  if ($transaksi) {
                    while ($row = mysqli_fetch_array($transaksi)) {
                      $data[] = array(
                        $row['tgl_pesan'], // Tanggal pemesanan
                        floatval($row['jumlah_penyewa']) // Jumlah penyewa pada hari itu
                      );
                    }
                    $json = json_encode($data);
                  } else {
                    echo 'Query gagal: ' . mysqli_error($conn);
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../home.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Scripts -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/series-label.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script type="text/javascript">
    Highcharts.chart('grafik', {
      title: {
        text: 'Transaksi Penyewaan'
      },
      yAxis: {
        title: {
          text: 'Jumlah Penyewa'
        }
      },
      xAxis: {
        type: 'category',
        accessibility: {
          rangeDescription: 'Waktu'
        }
      },
      tooltip: {
        pointFormat: '{point.y} Orang'
      },
      legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
      },
      plotOptions: {
        series: {
          label: {
            connectorAllowed: false
          }
        }
      },
      series: [{
        name: 'Jumlah Penyewa',
        lineWidth: 2,
        data: <?= $json ?>
      }],
      responsive: {
        rules: [{
          condition: {
            maxWidth: 500
          },
          chartOption: {
            legend: {
              layout: 'horizontal',
              align: 'center',
              verticalAlign: 'bottom'
            }
          }
        }]
      }
    });
  </script>
</body>
</html>
