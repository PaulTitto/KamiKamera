<!-- Navigation -->

  <nav class="navbar navbar-expand-lg navbar-light fixed-top  py-3" id="mainNav" style="background-color: #fff; box-shadow: 1px -60px 122px 1px #757575; z-index: 9999;">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index" style="text-shadow: 1px 1px 5px #fff; color: #000;">FIFA<span class="text-primary">DVENTURE</span></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link text-dark" href="home#about" style="text-shadow: 0px 0px 0px #757575;">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="home#services" style="text-shadow: 0px 0px 0px #757575;">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="home#online" style="text-shadow: 0px 0px 0px #757575;">Pesan Online</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="home#contact" style="text-shadow: 0px 0px 0px #757575;">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php 
  include 'assets/php/db.php';
  function rupiah($angka){    
          $hasil_rupiah = "Rp " . number_format($angka);
          $rupiah=str_replace(',', '.', $hasil_rupiah);
          return $rupiah;     
        }
  ?>