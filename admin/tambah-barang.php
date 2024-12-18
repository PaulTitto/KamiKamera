<?php include 'assets/php/db.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>proses</title>
	<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="assets/css/alertify.min.css" rel="stylesheet" type='text/css' />
    <script src="assets/js/alertify.min.js"></script>
    <style type="text/css">
    	.ajs-cancel {
		  display: none;
		}
    </style>
</head>
<body>
<?php
	if (isset($_POST['simpanBarang'])) {
	    $ekstensi_diperbolehkan = array('png','jpg', 'jpeg');    
	    $file_tmp = $_FILES['gambarBarang']['tmp_name'];
	    $ukuranIklan=getimagesize($file_tmp);
	    $name=$_FILES['gambarBarang']['name'];
	    $image=explode('.',$name);

	    $imageWidth = $ukuranIklan[0];
	    $imageHeight = $ukuranIklan[1];
	    $imageSize = $_FILES['gambarBarang']['size'];
	    $imageTipe = strtolower(end($image));    
	    $path="assets/img/barang/";
	    $maxSize=1044070;

	    //data barang

	    //id Barang
	    $kategori=$_POST['kategori'];
	    $tglNow=date('dmy');
	    $hitung=mysql_query("SELECT * FROM tb_barang WHERE id_kategori='$kategori' AND SUBSTR(id_barang, 4,6)='$tglNow'");
	    $cek=mysql_num_rows($hitung);
	    if ($cek==0) {
	        $urut=1;
	    }else{
	        $urut=$cek+1;
	    }
	    $ambilId=mysql_fetch_array($hitung);
	    if ($urut<10) {
	        $urutan='0'.$urut;
	    }else{
	        $urutan=$urut;
	    }

	    $idBarang=strtoupper($kategori).date('dmy').$urutan;
	    $namaBarang=ucwords($_POST['namaBarang']);
	    $qty=$_POST['qty'];
	    $hargaBarang=$_POST['hargaBarang'];
	    $hargaSewa=$_POST['hargaSewa'];
	    $imageName = $idBarang.'.'.$imageTipe;

	    $rasio=$imageWidth/$imageHeight;
	    if ($rasio==1) {
	    	if ($imageSize<=$maxSize) {
	    		if (in_array($imageTipe, $ekstensi_diperbolehkan) === true) {
	                $insert=mysql_query("INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `harga_barang`, `harga_sewa`, `qty`, `img`, `id_kategori`) VALUES ('$idBarang', '$namaBarang', '$hargaBarang', '$hargaSewa', '$qty', '$imageName', '$kategori')");
	                if ($insert) {
	                    move_uploaded_file($file_tmp, $path.$imageName);
	                    ?>
	                    <script language="JavaScript">
							alertify.confirm('Data barang berhasil Ditambah!', function(){window.location.href="barang-sewa"}).setHeader(' ').set({closable:false,transition:'fade'}).autoOk(3); 
						</script>
	                    <?php
	                }else{
	                    ?>
	                    <script language="JavaScript">
							alertify.confirm('Data barang gagal Ditambah!', function(){window.location.href="barang-sewa"}).setHeader(' ').set({closable:false,transition:'fade'}).autoOk(3); 
						</script>
	                    <?php
	                }
	    		}else{
	    			echo "Tipe Tidak Sesuai | Tipe Harus jpg / jpeg / png";
	    		}
	    	}else{
	    		echo "Ukuran Tidak Sesuai | Ukuran Maksimal 1MB <br>";
	    	}
	    }else{
	    	echo "Resolusi Tidak Sesuai | Resolusi Harus Memiliki Aspek Rasio 1:1 <br>";
	    }
	}
?>
</body>
</html>