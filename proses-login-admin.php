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
// Koneksi ke database menggunakan MySQLi
$koneksi = mysqli_connect("localhost", "root", "", "rentalcamera");
if (mysqli_connect_errno()) {
    echo "Koneksi gagal: " . mysqli_connect_error();
}

if (isset($_POST['login'])) {
    $name = $_POST['name'];
    $pass = $_POST['pass'];

    // Query login menggunakan MySQLi
    $login = mysqli_query($koneksi, "SELECT id_admin, name, password FROM tb_admin WHERE name='$name' AND password='$pass'");
    $hasil = mysqli_fetch_array($login);

    if (mysqli_num_rows($login) == 0) { ?>
        <script language="JavaScript">
            alertify.alert("Admin Belum Terdaftar", function(){ window.location.assign('login-admin'); }).setHeader(' ').set({closable:false,transition:'pulse'});
        </script>
    <?php } else {
        if ($pass != $hasil['password']) { ?>
            <script language="JavaScript">
                alertify.alert("Password Salah", function(){ window.location.assign('login-admin'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
        <?php } else {
            $_SESSION['idAdmin'] = $hasil['id_admin'];
        ?>
            <script type="text/javascript">
                window.location.assign('admin/index');
            </script>
        <?php
        }
    }
}
?>

</body>

</html>