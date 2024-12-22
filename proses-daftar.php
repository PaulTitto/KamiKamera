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
    // Koneksi ke database
    $conn = new mysqli("localhost", "root", "", "rentalcamera");

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Kodifikasi ID user
    $kodifikasi = "US" . date('d') . date('m') . date('y');
    $q1 = $conn->query("SELECT * FROM tb_user WHERE id_user LIKE '$kodifikasi%'");

    if (!$q1) {
        die("Query gagal: " . $conn->error);
    }

    $num1 = $q1->num_rows + 1;

    if ($num1 > 99) {
        $id_user = $kodifikasi . $num1;
    } elseif ($num1 > 9 && $num1 < 100) {
        $id_user = $kodifikasi . "0" . $num1;
    } else {
        $id_user = $kodifikasi . "00" . $num1;
    }

    // Ambil data dari form
    $namaLengkap = $conn->real_escape_string($_POST['namaLengkap']);
    $noHp = $conn->real_escape_string($_POST['noHp']);
    $jk = $conn->real_escape_string($_POST['jk']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $conn->real_escape_string($_POST['pass']);

    // Query insert data
    $daftar = $conn->query("INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `jk`, `no_telp`, `alamat`, `email`, `password`) 
                            VALUES ('$id_user', '$namaLengkap', '$jk', '$noHp', '$alamat', '$email', '$pass')");

    if ($daftar) {
        ?>
        <script language="JavaScript">
            alertify.confirm('Silahkan Login!', function(){window.location.href="login-user"}).setHeader(' ').set({closable:false,transition:'fade'}).autoOk(3); 
        </script>
        <?php
    } else {
        ?>
        <script language="JavaScript">
            alertify.confirm('Gagal, Silahkan Daftar Kembali!', function(){window.location.href="daftar-user"}).setHeader(' ').set({closable:false,transition:'fade'}).autoOk(3); 
        </script>
        <?php
    }

    // Tutup koneksi
    $conn->close();
}
?>





</body>

</html>