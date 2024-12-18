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
		
		$idBarang=$_POST['idBarang'];
		$namaBarang=ucwords($_POST['namaBarang']);
		$qty=$_POST['qty'];
		$kategori=$_POST['kategori'];
		$hargaBarang=$_POST['hargaBarang'];
		$hargaSewa=$_POST['hargaSewa'];
	    $gambar=mysql_query("SELECT img FROM tb_barang WHERE id_barang='$idBarang'");
	    $ambilGambar=mysql_fetch_array($gambar);
	    $imageName = $ambilGambar['img'];
	    $name=$_FILES['gambarBarang']['name'];

		if ($name==null) {
			echo "Kosong";
			$imageName=$ambilGambar['img'];
			$update=mysql_query("UPDATE tb_barang SET `nama_barang`='$namaBarang', `harga_barang`='$hargaBarang', `harga_sewa`='$hargaSewa', `qty`='$qty', `img`='$imageName', `id_kategori`='$kategori' WHERE id_barang='$idBarang'") or die(mysql_error());
			if ($update) { ?>
		        <script language="JavaScript">
					alertify.confirm('Data barang berhasil Diubah!', function(){window.location.href="barang-sewa"}).setHeader(' ').set({closable:false,transition:'fade'}).autoOk(3); 
				</script>
		    <?php } else { ?>
		    	<script language="JavaScript">
					alertify.confirm('Data barang gagal Diubah!', function(){window.location.href="barang-sewa"}).setHeader(' ').set({closable:false,transition:'fade'}).autoOk(3); 
				</script>
		    <?php }
		}else{
			echo "Ada";
			$file_tmp = $_FILES['gambarBarang']['tmp_name'];
			$imageSize = $_FILES['gambarBarang']['size'];
			$image=explode('.',$name);
			$imageTipe = strtolower(end($image)); 
			$path="assets/img/barang/";
			$ukuranIklan=getimagesize($file_tmp);
			$imageWidth = $ukuranIklan[0];
			$imageHeight = $ukuranIklan[1];
			$rasio=$imageWidth/$imageHeight;
			$imageNameBaru=$idBarang.".".$imageTipe;
			$maxSize=1044070;
			$ekstensi_diperbolehkan = array('png','jpg', 'jpeg'); 
		    
		    if ($rasio==1) {
		    	if ($imageSize<=$maxSize) {
		    		if (in_array($imageTipe, $ekstensi_diperbolehkan) === true) {
		                $update=mysql_query("UPDATE tb_barang SET `nama_barang`='$namaBarang', `harga_barang`='$hargaBarang', `harga_sewa`='$hargaSewa', `qty`='$qty', `img`='$imageName', `id_kategori`='$kategori' WHERE id_barang='$idBarang'") or die(mysql_error());
		                if ($update) {
		                	unlink($path.$imageName);
		                    move_uploaded_file($file_tmp, $path.$imageNameBaru);
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

	    
	}
?>
</body>
</html>