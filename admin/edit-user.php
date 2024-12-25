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
    if (isset($_POST['simpanUser'])) { // Ubah menjadi 'simpanUser' jika itu form untuk pengguna
        
        $idUser = $_POST['idUser'];  // Ganti idBarang menjadi idUser
        $namaUser = ucwords($_POST['namaUser']); // Ganti namaBarang menjadi namaUser
        $email = $_POST['email']; // Tambahkan field email
        $noTelp = $_POST['noTelp']; // Field noTelp untuk pengguna
        $alamat = $_POST['alamat']; // Alamat pengguna
        
        // Update data tanpa gambar
        $update = mysqli_query($conn, "UPDATE tb_user SET `nama_lengkap`='$namaUser', `email`='$email', `no_telp`='$noTelp', `alamat`='$alamat' WHERE id_user='$idUser'") or die(mysqli_error($conn));

        if ($update) { ?>
            <script language="JavaScript">
                alertify.confirm('Data pengguna berhasil Diubah!', function(){window.location.href="user-sewa"}).setHeader(' ').set({closable:false,transition:'fade'}).autoOk(3); 
            </script>
        <?php } else { ?>
            <script language="JavaScript">
                alertify.confirm('Data pengguna gagal Diubah!', function(){window.location.href="user-sewa"}).setHeader(' ').set({closable:false,transition:'fade'}).autoOk(3); 
            </script>
        <?php }
    }
?>
</body>
</html>
