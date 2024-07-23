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

<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-10">
					<?php 
					$sql2 ="SELECT admin.* FROM admin";
					$query = mysqli_query($koneksidb,$sql2);
					$result = mysqli_fetch_array($query);
					if ($_SESSION['statuspk'] == 'Pending') {
					 	echo "<h2 class='page-title'>Akun Anda Sedang Diproses...</h2>
						<h2>Mohon untuk Menunggu Konfirmasi, Maksimal 48 Jam</h2>
						<h2>Atau bisa dengan Kontak Admin ke <a href='https://wa.me/".htmlentities($result['telp'])."'>".htmlentities($result['telp'])."</a></h2>";
					}else{
						echo "<h2 class='page-title'>Akun Anda Ditolak!!!</h2>
							<h2>Mohon untuk Memasukkan Data dengan Benar</h2>";
					}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>