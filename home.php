<?php 

session_start();
    ob_start();
    if (isset($_SESSION['idUser'])) {
  echo '';
}else{
  echo '';
}
include 'assets/php/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>KamiKamera | Online</title>

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

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

  <!-- Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <style type="text/css">
    header.masthead{
      padding-top:10rem;
      padding-bottom:calc(10rem - 72px);
      background:url(assets/img/mainbg.png);
      background:linear-gradient(to bottom,rgba(00,00,00,.2) 0,rgba(00,00,00,.2) 100%),url("assets/img/mainbg.png");
      background-position:center;
      background-repeat:no-repeat;
      background-attachment:scroll;
      background-size:cover;
    }
  </style>
</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">KamiKamera <span class="text-primary">RENCAMS</span></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Services</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#online">Pesan Online</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Login
            </a>
            <div class="dropdown-menu" aria-labelledby="loginDropdown">
                <a class="dropdown-item" href="login-user.php">User</a>
                <a class="dropdown-item" href="login-admin.php">Admin</a>
            </div>
           </li>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Masthead -->
  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-end justify-content-end text-lg-right">
        <div class="col-lg-10 align-self-end">
<!--          <img src="assets/img/logo.png" class="logo">-->
<!--          <hr class="divider-primary my-4">-->
        </div>
        <div class="col-lg-8 align-self-baseline">
          <h3 class="text-white font-weight-light mb-3 text-shadow">Safer, Faster, and <br>Comfortable</h3>
            <h5 class="text-white font-weight-light mb-5 text-shadow">Get in touch with our <br>luxury cars</h5>
          <!-- <a class="btn btn-light btn-xl js-scroll-trigger"  href="#about">Rent Now</a> -->
        </div>
      </div>
    </div>
  </header>

  <!-- About Section -->
  <section class="page-section bg-primary" id="about">
    <div class="container">
      <div class="justify-content-center ">
          <section class="page-section bg-secondary" id="about">
                  <div class="row justify-content-center ">
                      <div class="col-lg-11 text-left">
                          <h2 class="text-white ">Book your dream camera now!</h2>
<!--                          <hr class="divider-light my-2 align-items-md-start">-->
                          <h5 class="text-white mb-4">Rent a camera online now from one of our worldwide locations. With over 20 years of experience in camera rentals and customer service, all we need is your ID, and you can book any camera you desire.</h5>
                          <!-- <a class="btn btn-light btn-l js-scroll-trigger mx-2" href="#online">Rent Now</a> -->
                          <!-- <span class="text-white">Atau </span> -->
                          <button class="btn btn-dark btn-l js-scroll-trigger mx-2" onclick="window.location.assign('barang-sewa?p=1&k=all')">Lihat Barang</button>
                      </div>
              </div>
          </section>
      </div>
    </div>
  </section>


  <!-- Services Section -->
  <section class="page-section " id="services">
    <div class="container ">
      <h2 class="text-center mt-0">Our Services</h2>
      <hr class="divider-primary my-4">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-shopping-basket text-primary mb-4"></i>
            <h3 class="h4 mb-2">Camera Hire</h3>
            <p class="text-muted mb-0">We pride ourselves in always going or our customers, ensuring you get the best equipment and service every time.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-campground text-primary mb-4"></i>
            <h3 class="h4 mb-2">Camera Rentals</h3>
            <p class="text-muted mb-0">We offer the best cameras for rent across the world at competitive prices, ensuring top-quality equipment for your needs.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-tags text-primary mb-4"></i>
            <h3 class="h4 mb-2">Hire a Photographer</h3>
            <p class="text-muted mb-0">If you want to capture special moments and feel comfortable, our photographers are available to help. </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Portfolio Section -->
  <section class="page-section bg-dark text-white"  id="online">
    <div class="container">
      <h2 class="mb-1 text-center">Pesan Online</h2>
      <h5 class="mb-4 text-center">Pesan Dulu, Nanti Ambil Ditoko</h5>

      <hr class="divider-light my-4">
      <form name="pesanOnline" method="POST" action="simpan-sewa.php" target="_blank">
        <div class="row">
          <div class="col-lg-6 col-sm-12">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" name="namaLengkap" class="form-control" style="box-shadow: inset 0 -1px 0 #ddd;" required>
            </div>
          </div>
          <div class="col-lg-6 col-sm-12">
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input type="number" name="noTelp" class="form-control" style="box-shadow: inset 0 -1px 0 #ddd;" required>
            </div>
          </div>
        </div>  
        <hr style="background-color: #fff;">
        <h5 class="mb-4 text-center">List Barang</h5> 
        <div class="input_fields_wrap">
            <div class="row">
              <!--baris satu-->
              <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Nama Barang</label>
                  <input type="hidden" name="idBarang[]" id="idBarang1">
                  <input type="hidden" id="tersedia1">
                  <select name="kode" name="barang[]" class="form-control" style="box-shadow: inset 0 -1px 0 #ddd;" onchange="prosesBarang(this.value , 1)" >
                    <option value="" hidden>--Pilih Barang--</option>
                           <?php
                              $sql = mysql_query("SELECT * FROM tb_barang");
                              $dataBrg = "var dtbrg = new Array();\n";
                              while ($res=mysql_fetch_array($sql)) {
                              $nama=$res ['nama_barang']." (".$res['qty']." unit)";
                              $dataBrg .= " dtbrg ['" . $res['id_barang']. "'] = {namaBarang:'" .$nama. "',hargaSewa:'" . $res['harga_sewa']. "', qty:'" .$res ['qty']."'};\n";?>
                              <option value="<?php echo $res['id_barang']?>"><?=$nama;?></option>
                              <?php
                              }
                           ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-sm-12">
                <div class="form-group">
                  <label>Harga (per Hari)</label>
                  <input type="text" name="harga[]" id="harga1" class="form-control" readonly>
                </div>
              </div>
              <div class="col-lg-3 col-sm-12">
                <div class="form-group">
                  <label>Qty</label>
                  <input type="number" name="qty[]" id="qty1" value="0" onkeyup="cekStok(this.value, 1)" style="box-shadow: inset 0 -1px 0 #ddd;" class="form-control">
                </div>
              </div>         
            </div>  
        </div>

        <hr style="background-color: #fff;">
        <h5 class="mb-4 text-center">Total Sewa</h5> 

        <div class="row">
          <div class="col-lg-3 col-sm-12">
            <div class="form-group">
              <label>Lama Sewa (Hari)</label>
              <input type="number" name="lamaSewa" id="lamaSewa" class="form-control" onkeyup="hitungLamaSewa(this.value)" style="box-shadow: inset 0 -1px 0 #ddd;" required>
            </div>
          </div>
          <div class="col-lg-3 col-sm-12">
            <div class="form-group">
              <label>Tanggal Pesan</label>
              <input type="text" name="tglPesan" id="tglPesan" class="form-control" readonly>
            </div>
          </div>
          <div class="col-lg-3 col-sm-12">
            <div class="form-group">
              <label>Tanggal Kembali</label>
              <input type="text" name="tglKembali" id="tglKembali" class="form-control" readonly>
            </div>
          </div>
          <div class="col-lg-3 col-sm-12 mb-4">
            <div class="form-group">
              <label>Total Bayar</label>
              <input type="text" name="totalBayar" id="totalBayar" class="form-control" readonly>
            </div>
          </div>
        </div>
          <center>
            <button type="button" class="add_field_button btn btn-light btn-xl js-scroll-trigger mb-3">Tambah Barang</button>
            <br>
            <button class="btn btn-light btn-xl js-scroll-trigger">Simpan dan Cetak Bukti Sewa</button>
          </center>
      </form>
      
    </div>
  </section>

  <!-- Contact Section -->
  <section class="page-section" id="contact">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">Hubungi Kami Melalui</h2>
          <hr class="divider-primary my-4">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center">
          <i class="fab fa-whatsapp fa-4x mb-3 text-muted"></i>
          <a class="d-block text-muted decoration-none" href="https://api.whatsapp.com/send?phone=6289612325104" target="blank">+6289612325104</a>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-store-alt fa-4x mb-3 text-muted"></i>
          <!-- Make sure to change the email address in anchor text AND the link below! -->
          <a class="d-block text-muted decoration-none" href="https://www.google.com/maps/@-6.9499304,107.6245194,21z" target="blank">Jl Soekarno Hatta (Depan Kampus LPKIA) Bandung - Jawa Barat</a>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fab fa-instagram fa-4x mb-3 text-muted"></i>
          <!-- Make sure to change the email address in anchor text AND the link below! -->
          <a class="d-block text-muted decoration-none" href="https://www.instagram.com/rental_alatcampingbandung/" target="blank">@rental_alatcampingbandung</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">Copyright &copy; 2019 - Rafi&Femi | Repost by <a href='https://stokcoding.com/' title='StokCoding.com' target='_blank'>StokCoding.com</a>
      </div>
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

  <script type="text/javascript">

    var bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    var time= new Date();
    var waktu=time.getHours() + ":" + checkTime(time.getMinutes());

    $('document').ready(function(){
      var d = new Date();
      var tglPesan=d.getDate()+" "+bulan[d.getMonth()]+" "+d.getFullYear()+" , "+waktu+" WIB";      
      document.getElementById('tglPesan').value=tglPesan;
      document.getElementById('harga1').value=0;
      document.getElementById('harga2').value=0;
      document.getElementById('harga3').value=0;
      document.getElementById('harga4').value=0;
      document.getElementById('harga5').value=0;
    });

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i;
      }
      return i;
    }

    function hitungLamaSewa(lamaSewa){
      if (lamaSewa=="") {
        document.getElementById('tglKembali').value='';  
        document.getElementById('totalBayar').value='';      
      }else{
        if (lamaSewa<1 || lamaSewa>30) {
          alertify.dialog('alert').set({transition:'fade',message: 'Batas Penyewaan Alat Camping Minimal 1 Hari dan Maksimal 30 Hari', frameless: true}).show(); 
          document.getElementById('tglKembali').value='';  
          document.getElementById('totalBayar').value='';
          document.getElementById('lamaSewa').value='';
        }else{
          var hariKedepan = new Date(new Date().getTime()+(lamaSewa*24*60*60*1000));
          var tglKembali=hariKedepan.getDate()+" "+bulan[hariKedepan.getMonth()]+" "+hariKedepan.getFullYear()+" , "+waktu+" WIB"; 
          document.getElementById('tglKembali').value=tglKembali;

          var byk = $("input[name='qty[]']").map(function(){return $(this).val();}).get(); 
          var harga = $("input[name='harga[]']").map(function(){return $(this).val();}).get(); 
          var total=0;
          for (var i = 0; i<harga.length; i++) {
            var hg = harga[i].replace('.','');
            var subTotal= hg*parseInt(byk[i]); 
            var total = total+subTotal;
          }
          var bayar=total*lamaSewa;
          document.getElementById('totalBayar').value=rupiah(bayar);  
           
        }        
      }
    }

    function rupiah(bilangan){
      var number_string = bilangan.toString(),
      sisa  = number_string.length % 3,
      rupiah  = number_string.substr(0, sisa),
      ribuan  = number_string.substr(sisa).match(/\d{3}/g);
        
      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      return rupiah;
    }

    <?php echo $dataBrg;?>
    function prosesBarang(id, index){
      if (id == 0){
        document.tambah.nama.value = ""; 
        document.tambah.harga.value = "";
      } else {
        switch(index){
          case 1 : {
            document.getElementById('idBarang1').value = id; 
            document.getElementById('harga1').value = rupiah(dtbrg[id].hargaSewa);
            document.getElementById('tersedia1').value = dtbrg[id].qty;
            break;
          }
          case 2 : {
            document.getElementById('idBarang2').value = id; 
            document.getElementById('harga2').value = rupiah(dtbrg[id].hargaSewa);
            document.getElementById('tersedia2').value = dtbrg[id].qty;
            break;
          }
          case 3 : {
            document.getElementById('idBarang3').value = id; 
            document.getElementById('harga3').value = rupiah(dtbrg[id].hargaSewa);
            document.getElementById('tersedia3').value = dtbrg[id].qty;
            break;
          }
          case 4 : {
            document.getElementById('idBarang4').value = id; 
            document.getElementById('harga4').value = rupiah(dtbrg[id].hargaSewa);
            document.getElementById('tersedia4').value = dtbrg[id].qty;
            break;
          }
          case 5 : {
            document.getElementById('idBarang5').value = id; 
            document.getElementById('harga5').value = rupiah(dtbrg[id].hargaSewa);
            document.getElementById('tersedia5').value = dtbrg[id].qty;
            break;
          }
        }        
      }
    }
    

    function cekStok(qty, inx){
      switch(inx){
        case 1 :{
            var tersedia1=document.getElementById('tersedia1').value;
            if (qty>parseInt(tersedia1)) {      
              alertify.alert('Stok Hanya Tersedia '+tersedia1+' unit', function(){ document.getElementById('qty1').value=''; }).setHeader(' ').set({closable:false,transition:'fade'});
            }
            break;
        }
        case 2 :{
            var tersedia2=document.getElementById('tersedia2').value;
            if (qty>parseInt(tersedia2)) {
              alertify.alert('Stok Hanya Tersedia '+tersedia2+' unit', function(){ document.getElementById('qty2').value=''; }).setHeader(' ').set({closable:false,transition:'fade'});
            }
            break;
        }
        case 3 :{
            var tersedia3=document.getElementById('tersedia3').value;
            if (qty>parseInt(tersedia3)) {
              alertify.alert('Stok Hanya Tersedia '+tersedia3+' unit', function(){ document.getElementById('qty3').value=''; }).setHeader(' ').set({closable:false,transition:'fade'});
            }
            break;
        }
        case 4 :{
            var tersedia4=document.getElementById('tersedia4').value;
            if (qty>parseInt(tersedia4)) {
              alert('Stok Hanya Tersedia '+tersedia4+' unit');
              document.getElementById('qty4').value='';
            }
            break;
        }
        case 5 :{
            var tersedia5=document.getElementById('tersedia5').value;
            if (qty>parseInt(tersedia5)) {
              alert('Stok Hanya Tersedia '+tersedia5+' unit');
              document.getElementById('qty5').value='';
            }
            break;
        }
      }
    }
  </script>

  <script>
    $(document).ready(function() {
      var max_fields      = 5; //maximum input boxes allowed
      var wrapper       = $(".input_fields_wrap"); //Fields wrapper
      var add_button      = $(".add_field_button"); //Add button ID
      
      var x = 1; //initlal text box count
      $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(wrapper).append('<div class="tambah'+x+'"><div class="row"><div class="col-lg-6 col-sm-12"><div class="form-group"><label>Nama Barang</label><input type="hidden" name="idBarang[]" id="idBarang'+x+'"><input type="hidden" id="tersedia'+x+'"><select name="kode" name="barang[]" class="form-control" style="box-shadow: inset 0 -1px 0 #ddd;" onchange="prosesBarang(this.value , '+x+')" ><option value="" hidden>--Pilih Barang--</option><?php
                              $sql = mysql_query("SELECT * FROM tb_barang");
                              $dataBrg = "var dtbrg = new Array();\n";
                              while ($res=mysql_fetch_array($sql)) {
                              $nama=$res ['nama_barang']." (".$res['qty']." unit)";
                              $dataBrg .= " dtbrg ['" . $res['id_barang']. "'] = {namaBarang:'" .$nama. "',hargaSewa:'" . $res ['harga_sewa']. "', qty:'" .$res ['qty']."'};\n";?><option value="<?php echo $res['id_barang']?>"><?=$nama;?></option><?php
                              }
                           ?></select></div></div><div class="col-lg-3 col-sm-12"><div class="form-group"><label>Harga (per Hari)</label><input type="text" name="harga[]" id="harga'+x+'" value="0" class="form-control" readonly></div></div><div class="col-lg-2 col-sm-12"><div class="form-group"><label>Qty</label><input type="number" name="qty[]" id="qty'+x+'" value="0" onkeyup="cekStok(this.value, '+x+')" style="box-shadow: inset 0 -1px 0 #ddd;" class="form-control"></div></div><div class="col-lg-1"><label>&nbsp;</label><button type="button" class="btn btn-sm btn-danger form-control remove_field"><i class="far fa-window-close fa-2x"></i></button></div></div></div>');
          //$(wrapper).append('<div><input type="text" value="'+x+'" name="mytext[]"/><a href="#" class="remove_field" >Remove</a></div>'); //add input box
        }else{
          alertify.alert('Maksimal Menyewa '+max_fields+' Barang', function(){ document.getElementById('qty1').value=''; }).setHeader(' ').set({closable:false,transition:'fade'});
        }
      });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $('.tambah'+x+'').remove(); x--;
      })
    });
  </script>
</body>

</html>
