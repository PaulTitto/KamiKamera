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
if (isset($_POST['login'])) {
	$email=$_POST['email'];
	$pass=$_POST['pass'];

	$login=mysql_query("SELECT id_user, email, password FROM tb_user WHERE email='$email' AND password='$pass';");
	$hasil = mysql_fetch_array($login);

	if(mysql_num_rows($login) == 0) { ?>
		<script language="JavaScript">
		    alertify.alert("Username Belum Terdaftar", function(){ window.location.assign('login-user'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		</script>
	<?php } else{
		if($pass <> $hasil['password']) { ?>
			<script language="JavaScript">
			    alertify.alert("Password Salah", function(){ window.location.assign('login-user'); }).setHeader(' ').set({closable:false,transition:'pulse'});
			</script>
		<?php } else{
			$_SESSION['idUser'] = $hasil['id_user'];
		?>
			 <script type="text/javascript">
				window.location.assign('home');
			</script>
		<?php
		}
	}
}
?>
</body>

</html>