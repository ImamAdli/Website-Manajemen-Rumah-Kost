<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if(strlen($_SESSION['alogin'])==0){	
	header('location:index.php');
}
else{
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Narty Boarding House | Admin Laporan</title>
	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<h2 class="page-title">Laporan Transaksi</h2>
				<div class="panel panel-default">
					<div class="panel-body">
						<form method="get" name="laporan" onSubmit="return valid();"> 
							<div class="form-group">
								<div class="col-sm-4">
									<label>Tanggal Awal</label>
									<input type="date" class="form-control" name="awal" placeholder="From Date(dd/mm/yyyy)" required>
								</div>
								<div class="col-sm-4">
									<label>Tanggal Akhir</label>
									<input type="date" class="form-control" name="akhir" placeholder="To Date(dd/mm/yyyy)" required>
								</div>
								<div class="col-sm-4">
									<label>&nbsp;</label><br/>
									<input type="submit" name="submit" value="Lihat Laporan" class="btn btn-primary">
								</div>
							</div>
						</form>
					</div>
				</div>
				<?php
				if(isset($_GET['submit'])){
					$no=0;
					$mulai 	 = $_GET['awal'];
					$selesai = $_GET['akhir'];
					$logpk = $_SESSION['alogin'];
					$stt	 = "Selesai";
					if ($_SESSION['alogin'] == 'admin') {
					$sqlsewa = "SELECT booking.*,kamar_kost.*,pemilik_kost.*,users.* FROM booking,kamar_kost,pemilik_kost,users WHERE booking.id_kamar=kamar_kost.id_kamar
								AND pemilik_kost.id_pemilik=kamar_kost.id_pemilik AND users.email=booking.email AND status='$stt'
								AND booking.tgl_booking BETWEEN '$mulai' AND '$selesai'";
					} else {
						$sqlsewa = "SELECT booking.*,kamar_kost.*,pemilik_kost.*,users.* FROM booking,kamar_kost,pemilik_kost,users WHERE booking.id_kamar=kamar_kost.id_kamar
						AND pemilik_kost.id_pemilik=kamar_kost.id_pemilik AND users.email=booking.email AND status='$stt' AND pemilik_kost.email='$logpk'
						AND booking.tgl_booking BETWEEN '$mulai' AND '$selesai'";
					}
					$querysewa = mysqli_query($koneksidb,$sqlsewa);
					?>
					<div class="panel panel-default">
						<div class="panel-heading">Laporan Sewa Tanggal <?php echo IndonesiaTgl($mulai);?> sampai <?php echo IndonesiaTgl($selesai);?></div>
							<div class="panel-body table-responsive">
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
										while ($result = mysqli_fetch_array($querysewa)) {
											$biayakost=$result['durasi']*$result['harga'];
											$total=$biayakost;
										$no++;
										?>	
										<tr>
											<td><?php echo $no;?></td>
											<td><?php echo htmlentities($result['kode_booking']);?></td>
											<td><?php echo htmlentities($result['nama_kamar']);echo ", "; echo $result['nama_kost'];?> </td>
											<td><?php echo htmlentities($result['status']);?></td>
											<td><?php echo IndonesiaTgl(htmlentities($result['tgl_booking']));?></td>
											<td><?php echo format_rupiah($total);?></td>
										</tr>
										<?php } 
										?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group">
								<a href="laporan_cetak.php?awal=<?php echo $mulai;?>&akhir=<?php echo $selesai;?>" target="_blank" class="btn btn-primary">Cetak</a>
						</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script>
	var app = {
		code: '0'
	};
	$('[data-load-code]').on('click',function(e) {
		e.preventDefault();
		var $this = $(this);
		var code = $this.data('load-code');
		if(code) {
			$($this.data('remote-target')).load('userview.php?code='+code);
			app.code = code;
		}
	});
	
	function valid()
	{
		if(document.laporan.akhir.value < document.laporan.awal.value){
			alert("Tanggal akhir harus lebih besar dari tanggal awal!");
			return false;
		}
		return true;
	}
	</script>
</body>
</html>
<?php } ?>
