<?php
include 'assets/php/db.php';
function tanggal($a){
    $bulan = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    );
    $tgl=date('d', strtotime($a))." ". $bulan[date('m', strtotime($a))]." ".date('Y', strtotime($a));
    return $tgl;
}

$kodifikasi = "TRS".date('d').date('m').date('y');
$q1 = mysql_query("SELECT * FROM tb_transaksi WHERE no_transaksi LIKE '$kodifikasi%'") or die(mysql_error());
$num1 = mysql_num_rows($q1)+1;
if ($num1>99) {
	$no_transaksi = $kodifikasi.$num1;
}elseif ($num1>9&&$num1<100) {
	$no_transaksi = $kodifikasi."0".$num1;
}else{
	$no_transaksi = $kodifikasi."00".$num1;
}
$nama_pemesan = $_POST['namaLengkap'];
$no_telp = $_POST['noTelp'];
$lama_sewa = $_POST['lamaSewa'];
$tgl_pesan = $_POST['tglPesan'];
$tgl_kembali = $_POST['tglKembali'];
$total_bayar = str_replace(".",'',$_POST['totalBayar']);
$q2 = mysql_query("INSERT INTO tb_transaksi (no_transaksi, nama_pemesan, no_telp, lama_sewa, tgl_pesan, tgl_kembali, total_bayar) VALUES ('$no_transaksi', '$nama_pemesan', '$no_telp', '$lama_sewa', '$tgl_pesan', '$tgl_kembali', '$total_bayar')");
if ($q2) {
	$loop = 0;
	foreach ($_POST['idBarang'] as $row_id_barang) {
		$qty = $_POST['qty'][$loop];
		$masuk=mysql_query("INSERT INTO tb_transaksi_detail (no_transaksi, id_barang, qty_sewa) VALUES ('$no_transaksi', '$row_id_barang', '$qty')");
		if ($masuk) {
			mysql_query("UPDATE tb_barang SET qty=qty-'$qty' WHERE id_barang='$row_id_barang'");
		}else{
			echo "Gagal Mengurangi";
		}
		
		$loop++;
	}
	mysql_query("DELETE FROM tb_transaksi_detail WHERE id_barang=''") or die(mysql_error());
	/*?>
	//MASUKIN DISINI
	<?php*/
	header("Location: cetak-sewa.php?no_transaksi=$no_transaksi", true, 301);
exit();
}else{
	?>
	<script type="text/javascript">
		alert('Pemesanan gagal, Silahkan coba lagi!');
		window.close();
	</script>
	<?php
}
?>