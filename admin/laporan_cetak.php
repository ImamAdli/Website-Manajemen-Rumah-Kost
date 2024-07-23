<?php
session_start();
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
$awal=$_GET['awal'];
$akhir=$_GET['akhir'];
$stt	 = "Selesai";
$logpk = $_SESSION['alogin'];
$alamat = '';

if ($_SESSION['alogin'] == 'admin') {
    $sqlsewa = "SELECT booking.*,kamar_kost.*,pemilik_kost.*,users.* FROM booking,kamar_kost,pemilik_kost,users WHERE booking.id_kamar=kamar_kost.id_kamar
                AND pemilik_kost.id_pemilik=kamar_kost.id_pemilik AND users.email=booking.email AND status='$stt'
                AND booking.tgl_booking BETWEEN '$awal' AND '$akhir'";
} else {
    $sqlsewa = "SELECT booking.*,kamar_kost.*,pemilik_kost.*,users.* FROM booking,kamar_kost,pemilik_kost,users WHERE booking.id_kamar=kamar_kost.id_kamar
                AND pemilik_kost.id_pemilik=kamar_kost.id_pemilik AND users.email=booking.email AND status='$stt'AND pemilik_kost.email='$logpk'
                AND booking.tgl_booking BETWEEN '$awal' AND '$akhir'";
    $queryPemilik = mysqli_query($koneksidb, "SELECT alamat FROM pemilik_kost WHERE email='$logpk'");
    $resultPemilik = mysqli_fetch_array($queryPemilik);
    $alamat = $resultPemilik['alamat'];
}

$querysewa = mysqli_query($koneksidb,$sqlsewa);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Sewa Kost">
	<meta name="author" content="Narty">
	<title>Cetak Detail Laporan</title>
	<link href="../assets/images/cat-profile.png" rel="icon" type="images/x-icon">
	<!-- Bootstrap Core CSS -->
	<link href="../assets/new/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Custom Fonts -->
	<link href="../assets/new/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- jQuery -->
	<script src="../assets/new/jquery.min.js"></script>
</head>

<body>
	<section id="header-kop">
		<div class="container-fluid">
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td rowspan="3" width="16%" class="text-center">
							<img src="../assets/images/logo.png" alt="logo" width="80" />
						</td>
						<td class="text-center"><h3>Narty Boarding House</h3></td>
						<td rowspan="3" width="16%">&nbsp;</td>
					</tr>
					<tr>
						<td class="text-center"><h2>Laporan Transaksi</h2></td>
					</tr>
					<tr>
						<td class="text-center"><?php echo htmlentities($alamat); ?></td>
					</tr>
				</tbody>
			</table>
			<hr class="line-top" />
		</div>
	</section>
	<section id="body-of-report">
		<div class="container-fluid">
			<h4 class="text-center">Detail Laporan</h4>
			<h5 class="text-center">Tanggal <?php echo IndonesiaTgl($awal) ." s/d ". IndonesiaTgl($akhir); ?></h5>
			<br/>
			<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Sewa</th>
						<th>Kamar Kost</th>
						<th>Status</th>
						<th>Tanggal Sewa</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no=0;
					$pemasukan=0;
					while($result = mysqli_fetch_array($querysewa)) {
						$biayakost=$result['durasi']*$result['harga'];
						$total=$biayakost;
						$pemasukan += $total; 
						$no++;
					?>	
					<tr align="center">
						<td><?php echo $no;?></td>
						<td><?php echo htmlentities($result['kode_booking']);?></td>
						<td><?php echo htmlentities($result['nama_kamar']);echo ", "; echo $result['nama_kost'];?> </td>
						<td><?php echo htmlentities($result['status']);?></td>
						<td><?php echo IndonesiaTgl(htmlentities($result['tgl_booking']));?></td>
						<td><?php echo format_rupiah($total);?></td>
					</tr>
					<?php } ?>					
				</tbody>
				<tfoot>
					<?php
					echo '<tr>';
					echo '<th colspan="5" class="text-center">Total Pemasukan</th>';
					echo '<th class="text-center">'. format_rupiah($pemasukan) .'</th>';
					echo '</tr>';
					?>
				</tfoot>
			</table>
		</div>
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
	<script src="../assets/new/bootstrap.min.js"></script>
	<!-- jTebilang JavaScript -->
	<script src="../assets/new/jTerbilang.js"></script>
</body>
</html>