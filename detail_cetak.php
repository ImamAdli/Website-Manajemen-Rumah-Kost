<?php
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
$kode=$_GET['kode'];
$sql1 	= "SELECT booking.*,kost.*, nama_kost.*, users.* FROM booking,kost,nama_kost,users WHERE booking.id_kamarkost=kost.id_kamarkost 
			AND nama_kost.id_namakost=kost.id_namakost and booking.email=users.email and booking.kode_booking='$kode'";
$query1 = mysqli_query($koneksidb,$sql1);
$result = mysqli_fetch_array($query1);
$harga	= $result['harga'];
$durasi = $result['durasi'];
$rekening = $result['rekening'];
$alamat = $result['alamat'];
$namapemilik = $result['nama_pemilik'];
$totalkost = $durasi*$harga;
$totalsewa = $totalkost;
$tglmulai = strtotime($result['tgl_mulai']);
$jmlhari  = 86400*1;
$tgl	  = $tglmulai-$jmlhari;
$tglhasil = date("Y-m-d",$tgl);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Sewa Kost">
<meta name="author" content="universitas pamulang">
<title>Cetak Detail Transaksi Sewa Kost</title>
<link href="assets/images/cat-profile.png" rel="icon" type="images/x-icon">
<!-- Bootstrap Core CSS -->
<link href="assets/new/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!-- Custom CSS -->
<link href="assets/new/offline-font.css" rel="stylesheet">
<!-- Custom Fonts -->
<link href="assets/new/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- jQuery -->
<script src="assets/new/jquery.min.js"></script>
</head>

<body>
	<section id="header-kop">
		<div class="container-fluid">
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td rowspan="3" width="16%" class="text-center">
							<img src="assets/images/logo.png" alt="logo-dkm" width="80" />
						</td>
						<td class="text-center"><h3>Narty Boarding House</h3></td>
						<td rowspan="3" width="16%">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center"><h2>Transkip Detail Transaksi</h2></td>
					</tr>
					<tr>
						<td class="text-center"><?php echo $alamat;?> </td>
					</tr>
				</tbody>
			</table>
			<hr class="line-top" />
		</div>
	</section>

	<section id="body-of-report">
		<div class="container-fluid">
			<h4 class="text-center">Detail Sewa</h4>
			<br />
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td width="23%">No. Sewa</td>
						<td width="2%">:</td>
						<td><?php echo $result['kode_booking'];?></td>
					</tr>
					<tr>
						<td>Penyewa</td>
						<td>:</td>
						<td><?php echo $result['nama_user'] ?></td>
					</tr>
					<tr>
						<td>kost</td>
						<td>:</td>
						<td><?php echo $result['nama_kost'];echo  ", "; echo $result['nama_kamarkost']; ?></td>
					</tr>
					<tr>
						<td>Tanggal Mulai</td>
						<td>:</td>
						<td><?php echo IndonesiaTgl($result['tgl_mulai']);?></td>
					</tr>
					<tr>
						<td>Tanggal Selesai</td>
						<td>:</td>
						<td><?php echo IndonesiaTgl($result['tgl_selesai']);?></td>
					</tr>
					<tr>
						<td>Durasi</td>
						<td>:</td>
						<td><?php echo $result['durasi'];?> Hari</td>
					</tr>
					<tr>
						<td>Biaya kost (<?php echo $result['durasi'];?>) Hari</td>
						<td>:</td>
						<td><?php echo format_rupiah($totalkost);?></td>
					</tr>
					<tr>
						<td>Total Biaya Sewa (<?php echo $result['durasi'];?>) Hari</td>
						<td>:</td>
						<td><?php echo format_rupiah($totalsewa);?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><?php echo $result['status'];?></td>
					</tr>
					<?php
						if($result['status']=="Menunggu Pembayaran"){
							echo "
						<tr>
							<td colspan='3'>
								<b>*Silahkan transfer total biaya sewa ke BANK ".$result['rekening']." dengan nama ".$result['nama_pemilik']." maksimal tanggal "?> <?php echo IndonesiaTgl($tglhasil);?> <?php echo ".
							</td>
						</tr>
							";
						}else{
						}?>
				</tbody>
			</table>
		</div><!-- /.container -->
	</section>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#jumlah').terbilang({
				'style'			: 3, 
				'output_div' 	: "jumlah2",
				'akhiran'		: "Rupiah",
			});
			window.print();
		});
	</script>

	<!-- Bootstrap Core JavaScript -->
	<script src="assets/new/bootstrap.min.js"></script>
	<!-- jTebilang JavaScript -->
	<script src="assets/new/jTerbilang.js"></script>

</body>
</html>