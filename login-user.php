<?php include 'assets/php/db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>FIFADVENTURE | Online</title>

  <!-- Font Awesome Icons -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
  <!-- Alertify -->
  <link href="assets/css/alertify.min.css" rel="stylesheet" type='text/css' />
  <!-- Theme CSS - Includes Bootstrap -->
  <link href="assets/css/creative.css" rel="stylesheet">
  <style type="text/css">
    .ket-pass{
      font-size: 10pt;
    }
  </style>
</head>

<body id="page-top">

  <!-- About Section -->
  <section class="bg-primary p-5" id="about">
    <div class="container">
    <form action="proses-login" method="POST">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center mt-5">
        <h4 class="h1">FIFA<span class="text-light">DVENTURE</span></h4>
        <hr class="divider-light">
          <h2 class="text-white h5">Login</h2>
          <div class="card p-2 bg-light">
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="pass" id="pass" class="form-control" onkeyup="cekPass(this.value)" required>
            </div>
          </div>
          <hr class="divider-light my-3">
          <button class="btn btn-dark btn-l js-scroll-trigger" name="login">Login</button>
        </div>
      </div>
    </form>
    </div>
  </section>

  
  <!-- Footer -->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">Copyright &copy; 2019 - Admin</div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="assets/js/creative.min.js"></script>
  <script src="assets/js/alertify.min.js"></script>
</body>

</html>
