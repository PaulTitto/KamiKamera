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
if (isset($_POST)) {	
	$kodifikasi = "US".date('d').date('m').date('y');
	$q1 = mysql_query("SELECT * FROM tb_user WHERE id_user LIKE '$kodifikasi%'") or die(mysql_error());
	$num1 = mysql_num_rows($q1)+1;
	if ($num1>99) {
		$id_user = $kodifikasi.$num1;
	}elseif ($num1>9&&$num1<100) {
		$id_user = $kodifikasi."0".$num1;
	}else{
		$id_user = $kodifikasi."00".$num1;
	}

	$namaLengkap=$_POST['namaLengkap'];
	$noHp=$_POST['noHp'];
	$jk=$_POST['jk'];
	$alamat=$_POST['alamat'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];

	$daftar=mysql_query("INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `jk`, `no_telp`, `alamat`, `email`, `password`) VALUES ('$id_user', '$namaLengkap', '$jk', '$noHp', '$alamat', '$email', '$pass');");
	if ($daftar) {
		?>
		<script language="JavaScript">
			alertify.confirm('Silahkan Login!', function(){window.location.href="login-user"}).setHeader(' ').set({closable:false,transition:'fade'}).autoOk(3); 
		</script>
		<?php
	}else{
		?>
		<script language="JavaScript">
			alertify.confirm('Gagal, Silahkan Daftar Kembali!', function(){window.location.href="daftar-user"}).setHeader(' ').set({closable:false,transition:'fade'}).autoOk(3); 
		</script>
		<?php
	}
}
?>
</body>

</html>