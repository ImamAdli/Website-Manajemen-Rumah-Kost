<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
	header('location:index.php');
	}else{
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
<title>Narty Boarding House | Admin Dashboard</title>

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
<!-- Bootstrap file input -->
<link rel="stylesheet" href="css/fileinput.min.css">
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
						<h2 class="page-title">Dashboard</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
													<?php 
													$logpk = $_SESSION['alogin'];
													if ($_SESSION['alogin'] == 'admin') {
													$sqlbayar = "SELECT * FROM booking WHERE status='Menunggu Pembayaran' ";
													} else {
														$sqlbayar = "SELECT * FROM booking a join kost b on a.id_kamarkost=b.id_kamarkost
														join nama_kost c on b.id_namakost=c.id_namakost WHERE status='Menunggu Pembayaran' AND c.email='$logpk'";
													}
													$querybayar = mysqli_query($koneksidb,$sqlbayar);
													$bayar=mysqli_num_rows($querybayar);
													?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($bayar);?></div>
													<div class="stat-panel-title text-uppercase">Menunggu Pembayaran</div>
												</div>
											</div>
												<a href="sewa_bayar.php" class="block-anchor panel-footer text-center">Rincian &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
													<?php
													$logpk = $_SESSION['alogin'];
													if ($_SESSION['alogin'] == 'admin') {
													$sqlkonfir = "SELECT kode_booking FROM booking WHERE status='Menunggu Konfirmasi'";
													} else {
														$sqlkonfir = "SELECT * FROM booking a join kost b on a.id_kamarkost=b.id_kamarkost
														join nama_kost c on b.id_namakost=c.id_namakost WHERE status='Menunggu Konfirmasi' AND c.email='$logpk'";
													}
													$querykonfir = mysqli_query($koneksidb,$sqlkonfir);
													$konfir=mysqli_num_rows($querykonfir);
													?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($konfir);?></div>
													<div class="stat-panel-title text-uppercase">Menunggu Konfirmasi</div>
												</div>
											</div>
												<a href="sewa_konfirmasi.php" class="block-anchor panel-footer text-center">Rincian &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-warning text-light">
												<div class="stat-panel text-center">
													<?php 
													$logpk = $_SESSION['alogin'];
													if ($_SESSION['alogin'] == 'admin') {
													$sql2 = "SELECT kode_booking FROM booking";
													} else {
														$sql2 = "SELECT * FROM booking a join kost b on a.id_kamarkost=b.id_kamarkost
														join nama_kost c on b.id_namakost=c.id_namakost WHERE c.email='$logpk'";
													}
													$query2 = mysqli_query($koneksidb,$sql2);
													$bookings=mysqli_num_rows($query2);
													?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($bookings);?></div>
													<div class="stat-panel-title text-uppercase">Total Transaksi</div>
												</div>
											</div>
											<a href="sewa.php" class="block-anchor panel-footer text-center">Rincian &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<?php 
									$sql3 = "SELECT id_namakost FROM nama_kost";
									$query3 = mysqli_query($koneksidb,$sql3);
									$namakost=mysqli_num_rows($query3);
									if ($_SESSION['alogin'] == 'admin') {
										echo "<div class='col-md-4'>";
										echo "<div class='panel panel-default'>";
										echo "<div class='panel-body bk-primary text-light'>";
										echo "<div class='stat-panel text-center'>";
										echo "<div class='stat-panel-number h1 '>$namakost</div>";
										echo "<div class='stat-panel-title text-uppercase'>Total Nama Kost</div>";
										echo "</div>";
										echo "</div>";
										echo "<a href='namakost.php' class='block-anchor panel-footer text-center'>Rincian <i class='fa fa-arrow-right'></i></a>";
										echo "</div>";
										echo "</div>";
									}?>
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
													<?php 
													$logpk = $_SESSION['alogin'];
													if ($_SESSION['alogin'] == 'admin') {
													$sql1 = "SELECT id_kamarkost FROM kost";
													} else {
														$sql1 = "SELECT * FROM kost a join nama_kost b on a.id_namakost=b.id_namakost
														WHERE b.email='$logpk'";
													}
													$query1 = mysqli_query($koneksidb,$sql1);
													$totalkost=mysqli_num_rows($query1);
													?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($totalkost);?></div>
													<div class="stat-panel-title text-uppercase">Jumlah Kamar Kost</div>
												</div>
											</div>
											<a href="kost.php" class="block-anchor panel-footer text-center">Rincian &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<?php 
									$sql = "SELECT id_user FROM users";
									$query = mysqli_query($koneksidb,$sql);
									$regusers=mysqli_num_rows($query);
									if ($_SESSION['alogin'] == 'admin') {
										echo "<div class='col-md-4'>";
										echo "<div class='panel panel-default'>";
										echo "<div class='panel-body bk-primary text-light'>";
										echo "<div class='stat-panel text-center'>";
										echo "<div class='stat-panel-number h1 '>$regusers</div>";
										echo "<div class='stat-panel-title text-uppercase'>User</div>";
										echo "</div>";
										echo "</div>";
										echo "<a href='reg-users.php' class='block-anchor panel-footer text-center'>Rincian <i class='fa fa-arrow-right'></i></a>";
										echo "</div>";
										echo "</div>";
									}?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="row">
								</div>
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
	window.onload = function(){
		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		}); 
		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});
		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});
	}
	</script>
</body>
</html>
<?php } ?>