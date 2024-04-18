<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if(strlen($_SESSION['alogin'])==0){	
	header('location:index.php');
} else{ ?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Narty Boarding House | Admin Kelola Mobil</title>

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
<style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
</head>
<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">List Kost</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Daftar Kost</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Mobil</th>
											<th>Merek</th>
											<th>No. Polisi</th>
											<th>Harga /Hari</th>
											<th>Type BB</th>
											<th>Tahun</th>
											<th><a href="tambahmobil.php"><span class="fa fa-plus-circle"></span>Tambah Mobil</a></th>
										</tr>
									</thead>
									<tbody>
									<?php 
										$nomor = 0;
										$sqlmobil = "SELECT mobil.*, merek.* FROM mobil, merek WHERE mobil.id_merek=merek.id_merek ORDER BY mobil.id_mobil ASC";
										$querymobil = mysqli_query($koneksidb,$sqlmobil);
										while ($result = mysqli_fetch_array($querymobil)){
											$nomor++;
											?>
										<tr>
											<td><?php echo htmlentities($nomor);?></td>
											<td><?php echo htmlentities($result['nama_mobil']);?></td>
											<td><?php echo htmlentities($result['nama_merek']);?></td>
											<td><?php echo htmlentities($result['nopol']);?></td>
											<td><?php echo format_rupiah($result['harga']);?></td>
											<td><?php echo htmlentities($result['bb']);?></td>
											<td><?php echo htmlentities($result['tahun']);?></td>
											<td class="text-center"><a href="mobiledit.php?id=<?php echo $result['id_mobil'];?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
												<a href="mobildel.php?id=<?php echo $result['id_mobil'];?>" onclick="return confirm('Apakah anda akan menghapus <?php echo $result['nama_mobil'];?>?');"><i class="fa fa-close"></i></a></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
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
</body>
</html>
<?php } ?>