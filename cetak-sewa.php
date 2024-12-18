<?php
include 'assets/php/db.php';
$no_transaksi = $_GET['no_transaksi'];
$qq = mysql_query("SELECT * FROM tb_transaksi WHERE no_transaksi='$no_transaksi'") or die(mysql_error());
while ($rr = mysql_fetch_array($qq)) {
	$nama_pemesan = $rr['nama_pemesan'];
	$no_telp = $rr['no_telp'];
	$lama_sewa = $rr['lama_sewa'];
	$tgl_pesan = $rr['tgl_pesan'];
	$tgl_kembali = $rr['tgl_kembali'];
}
?>
<!DOCTYPE html>
	<html>
	<head>
		<title>BOOKING PESANAN</title>
		<style type="text/css">
			table {
			  border-collapse: collapse;
			}
		</style>
	</head>
	<body>
		<table align="center" border="0" cellpadding="1" style="width: 700px;">
			<tbody>
				<tr><td colspan="3"><div align="center">
				<span style="font-family: Verdana; font-size: x-small;"><b><h1>FIFADVENTURE</h1><h2>BUKTI BOOKING PEMESANAN ONLINE</h2></b></span>
				<hr /></div></td>
				</tr>
			</tbody>
		</table><br>
		<table>
			<tr>
				<td>NOMOR TRANSAKSI</td><td width="40px" align="center">:</td><td><?=$no_transaksi?></td>
			</tr>
			<tr>
				<td>NAMA PEMESAN</td><td width="40px" align="center">:</td><td><?=strtoupper($nama_pemesan)?></td>
			</tr>
			<tr>
				<td>NOMOR TELP</td><td width="40px" align="center">:</td><td><?=$no_telp?></td>
			</tr>
			<tr>
				<td>TANGGAL PEMESANAN</td><td width="40px" align="center">:</td><td><?=$tgl_pesan?></td>
			</tr>
			<tr>
				<td>TANGGAL KEMBALI</td><td width="40px" align="center">:</td><td><?=$tgl_kembali?></td>
			</tr>
			<tr>
				<td>LAMA SEWA</td><td width="40px" align="center">:</td><td><?=$lama_sewa." Hari"?></td>
			</tr>
		</table>
		<?php
		$q3 = mysql_query("SELECT * FROM tb_transaksi_detail JOIN tb_barang ON tb_transaksi_detail.id_barang=tb_barang.id_barang JOIN tb_transaksi ON tb_transaksi_detail.no_transaksi=tb_transaksi.no_transaksi WHERE tb_transaksi_detail.no_transaksi='$no_transaksi'") or die(mysql_error());
		$num2 = mysql_num_rows($q3);
		$no = 0;
		$rowspan = true;
		$q4 = mysql_query("SELECT * FROM tb_transaksi_detail JOIN tb_transaksi ON tb_transaksi_detail.no_transaksi=tb_transaksi.no_transaksi WHERE tb_transaksi_detail.no_transaksi='$no_transaksi'") or die(mysql_error());
		while ($resultt = mysql_fetch_array($q4)) {
			$tb = $resultt['total_bayar'];
		}
		?><br><br>
		<table border="1" width="100%" align="center">
			<tr>
				<th>NO</th>
				<th>NAMA BARANG</th>
				<th>HARGA SEWA</th>
				<th>Qty</th>
				<th>LAMA SEWA</th>
				<th>TOTAL</th>
			</tr>
			<?php
			while ($result = mysql_fetch_array($q3)) {
				$no++;
			 	echo "<tr>";
			 	echo "<td align='center'>".$no."</td>";
			 	echo "<td>".$result['nama_barang']."</td>";
			 	echo "<th>"."Rp. ".number_format($result['harga_sewa'])." / Hari"."</th>";
			 	echo "<td align='center'>".$result['qty_sewa']."</td>";
			 	if ($rowspan) {
			 		echo "<td align='center' rowspan='$num2'>".$lama_sewa." Hari"."</td>";
			 		$rowspan = false;
			 	}
			 	echo "<th>"."Rp. ".number_format(($result['harga_sewa']*$result['qty_sewa'])*$lama_sewa)."</th>";
			 	echo "</tr>";
			 }
			 echo "<tr>";
			 echo "<td align='center' colspan='5'>"."TOTAL BAYAR"."</td>";
			 echo "<th>"."Rp. ".number_format($tb)."</th>";
			 echo "</tr>";
			?>
		</table>
	</body>
	<script>
		 window.load = print_d();
		 function print_d(){
		 window.print();
		 }
	 </script>
	</html>