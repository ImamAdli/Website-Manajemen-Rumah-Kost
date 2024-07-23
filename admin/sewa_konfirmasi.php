<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if(strlen($_SESSION['alogin'])==0){	
	header('location:index.php');}
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
	<title>Narty Boarding House | Admin Kelola Sewa   </title>
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
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Menunggu Konfirmasi Sewa Kost</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Daftar Sewa Menunggu Konfirmasi</div>
							<div class="panel-body table-responsive">
								<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
								else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr align="center">
										<th>No</th>
										<th>Kode Sewa</th>
										<th>kost</th>
										<th>Tgl. Mulai</th>
										<th>Tgl. Selesai</th>
										<th>Total</th>
										<th>Penyewa</th>
										<th>Status</th>
										<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i=0;
											$logpk = $_SESSION['alogin'];
											if ($_SESSION['alogin'] == 'admin') {
												$sqlsewa = "SELECT booking.*,kamar_kost.*,pemilik_kost.*,users.* FROM booking,kamar_kost,pemilik_kost,users WHERE booking.id_kamar=kamar_kost.id_kamar
												AND pemilik_kost.id_pemilik=kamar_kost.id_pemilik AND users.email=booking.email AND status='Menunggu Konfirmasi'
												ORDER BY booking.kode_booking DESC";
											} else {
												$sqlsewa = "SELECT booking.*,kamar_kost.*,pemilik_kost.*,users.* FROM booking,kamar_kost,pemilik_kost,users WHERE booking.id_kamar=kamar_kost.id_kamar
												AND pemilik_kost.id_pemilik=kamar_kost.id_pemilik AND users.email=booking.email AND status='Menunggu Konfirmasi' AND pemilik_kost.email='$logpk'
												ORDER BY booking.kode_booking DESC";
											}
											$querysewa = mysqli_query($koneksidb,$sqlsewa);
											while ($result = mysqli_fetch_array($querysewa)) {
												$biayakost=$result['durasi']*$result['harga'];
												$total=$biayakost;
												$i++;
											?>
										<tr align="center">
											<td><?php echo $i;?></td>
											<td><?php echo htmlentities($result['kode_booking']);?></td>
											<td><?php echo htmlentities($result['nama_kamar']);echo ", "; echo $result['nama_kost'];?></td>
											<td><?php echo IndonesiaTgl(htmlentities($result['tgl_mulai']));?></td>
											<td><?php echo IndonesiaTgl(htmlentities($result['tgl_selesai']));?></td>
											<td><?php echo format_rupiah(htmlentities($total));?></td>
											<td><a href="#myModal" data-toggle="modal" data-load-id="<?php echo $result['email']; ?>" data-remote-target="#myModal .modal-body"><?php echo $result['nama_user']; ?></a></td>
											<td><?php echo htmlentities($result['status']);?></td>
											<td>
											<a href="#myModal" data-toggle="modal" data-load-code="<?php echo $result['kode_booking']; ?>" data-remote-target="#myModal .modal-body"><span class="glyphicon glyphicon-eye-open"></span></a>
											<a href="sewaedit.php?id=<?php echo $result['kode_booking'];?>"><i class="fa fa-edit"></i></a></td>
										</tr>
										<?php }?>
									</tbody>
								</table>
								<!-- Large modal -->
								<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-body">
												<p>One fine body…</p>
											</div>
										</div>
									</div>
								</div>    
								<!-- Large modal --> 
							</div>
						</div>
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
				$($this.data('remote-target')).load('sewaview.php?code='+code);
				app.code = code;
			}
		});
		$('[data-load-id]').on('click',function(e) {
			e.preventDefault();
			var $this = $(this);
			var code = $this.data('load-id');
			if(code) {
				$($this.data('remote-target')).load('userview.php?code='+code);
				app.code = code;
			}
		});
    </script>
</body>
</html>
<?php } ?>