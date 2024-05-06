<!-- Printing -->
<link rel="stylesheet" href="css/printing.css">

<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if($_GET) {
	$Kode = $_GET['code'];
	$sqlsewa = "SELECT booking.*,kost.*,nama_kost.*,users.* FROM booking,kost,nama_kost,users WHERE booking.id_kamarkost=kost.id_kamarkost
			AND nama_kost.id_namakost=kost.id_namakost AND users.email=booking.email AND booking.kode_booking='$Kode'";
	$querysewa = mysqli_query($koneksidb,$sqlsewa);
	$result = mysqli_fetch_array($querysewa);
	$biayakost=$result['durasi']*$result['harga'];
	$total=$biayakost;
	$bukti=$result['bukti_bayar'];
}
else {
	echo "Nomor Transaksi Tidak Terbaca";
	exit;
}
?>
<html>
<head>
</head>

<body>
	<div id="section-to-print">
		<div id="only-on-print">
			<h2>Detail Sewa</h2>
		</div>
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title" id="myModalLabel">Detail Sewa</h4>
		</div>
		<div><br/></div>
		<table width="100%">
			<tr>
				<td width="20%"><b>Kode Sewa</b></td>
				<td width="2%"><b>:</b></td>
				<td width="78%"><?php echo $result['kode_booking'];?></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td width="20%"><b>kost</b></td>
				<td width="2%"><b>:</b></td>
				<td width="78%"><?php echo $result['nama_kost'];?>, <?php echo $result['nama_kamarkost'];?></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td width="20%"><b>Tanggal Mulai</b></td>
				<td width="2%"><b>:</b></td>
				<td width="78%"><?php echo IndonesiaTgl($result['tgl_mulai']);?></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td width="20%"><b>Tanggal Selesai</b></td>
				<td width="2%"><b>:</b></td>
				<td width="78%"><?php echo IndonesiaTgl($result['tgl_selesai']);?></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td width="20%"><b>Durasi</b></td>
				<td width="2%"><b>:</b></td>
				<td width="78%"><?php echo $result['durasi'];?></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td width="20%"><b>Penyewa</b></td>
				<td width="2%"><b>:</b></td>
				<td width="78%"><?php echo $result['nama_user'];?></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td width="20%"><b>Biaya kost</b></td>
				<td width="2%"><b>:</b></td>
				<td width="78%"><?php echo $biayakost;?></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td width="20%"><b>Total Biaya</b></td>
				<td width="2%"><b>:</b></td>
				<td width="78%"><?php echo $total;?></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td width="20%"><b>Status</b></td>
				<td width="2%"><b>:</b></td>
				<td width="78%"><?php echo $result['status'];?></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td width="20%"><b>Bukti Pembayaran</b></td>
				<td width="2%"><b>:</b></td>
				<?php
					if($bukti==""){
				?>
					<td width="78%">Belum ada bukti pembayaran.</td>
					<?php
					}else{
					?>
					<td width="78%"><img src="../image/bukti/<?php echo htmlentities($result['bukti_bayar']);?>" height="150"></td>
					<?php
					}
				?>
			</tr>
		</table>
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</body>
</html>