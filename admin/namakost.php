<?php
session_start();
error_reporting(0);
include('includes/config.php');
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
	<title>Narty Boarding House | Admin Kelola Kost   </title>
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
						<h2 class="page-title">Kelola Nama Kost</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Daftar Nama Kost</div>
							<div class="panel-body">
								<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
								else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr align="center">
											<th width="2%">No</th>
											<th width="15%">Nama Kost</th>
											<th >Email</th>
											<th>Telepon</th>
											<th>Nama Pemilik</th>
											<th>KTP</th>
											<th>Status</th>
											<th><a href="tambahnamakost.php">Tambah Kost <span class="fa fa-plus-circle"></span></a></th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$nomor = 0;
										$sqlnama_kost = "SELECT * FROM nama_kost";
										$querynama_kost = mysqli_query($koneksidb,$sqlnama_kost);
										while ($result = mysqli_fetch_array($querynama_kost)) {
											$nomor++;
										?>
										<tr align="center">
											<td><?php echo htmlentities($nomor);?></td>
											<td><?php echo htmlentities($result['nama_kost']);?></td>
											<td><?php echo htmlentities($result['email']);?></td>
											<td><?php echo htmlentities($result['telepon']);?></td>
											<td><?php echo htmlentities($result['nama_pemilik']);?></td>
											<td><a href="img/id/<?php echo htmlentities($result['ktp']);?>" target="blank"><img src="img/id/<?php echo htmlentities($result['ktp']);?>" width="40"></a></td>
											<td><?php echo htmlentities($result['statuspk']);?></td>
											<td><a href="#myModal" data-toggle="modal" data-load-code="<?php echo $result['email']; ?>" data-remote-target="#myModal .modal-body"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;&nbsp;&nbsp;
												<a href="namakostedit.php?id=<?php echo $result['id_namakost'];?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
											<a href="namakostdel.php?id=<?php echo $result['id_namakost'];?>" onclick="return confirm('Apakah anda yakin akan menghapus <?php echo $result['nama_kost'];?>?');"><i class="fa fa-close"></i></a></td>
										</tr>
										<?php }?>
									</tbody>
								</table>
								<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-body">
												<p>One fine body…</p>
											</div>
										</div>
									</div>
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
	var app = {
		code: '0'
	};
	$('[data-load-code]').on('click',function(e) {
		e.preventDefault();
		var $this = $(this);
		var code = $this.data('load-code');
		if(code) {
			$($this.data('remote-target')).load('pkview.php?code='+code);
			app.code = code;
		}
	});
	</script>
</body>
</html>
<?php } ?>