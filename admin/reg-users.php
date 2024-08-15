<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
	header('location:index.php');
} else {
	if(isset($_GET['del_id']) && isset($_GET['email'])){
		$id	= $_GET['del_id'];
		$email = $_GET['email'];
		$mySql	= "DELETE FROM users WHERE id_user='$id'";
		$myQry	= mysqli_query($koneksidb, $mySql);
		if($myQry){
			$msg = "Data user $email berhasil dihapus.";
		} else {
			$error = "Terjadi kesalahan, silahkan coba lagi!";
		}
	}

	if(isset($_GET['reset_password'])){
		$email = $_GET['reset_password'];
		$password = "123456";
		$pass = md5($password);
		$mySql	= "UPDATE users SET password='$pass' WHERE email='$email'";
		$myQry	= mysqli_query($koneksidb, $mySql);
		if($myQry){
			$msg = "Password untuk $email berhasil direset.";
		} else {
			$error = "Terjadi kesalahan, silahkan coba lagi!";
		}
	}
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
	<title>Narty Boarding House | Admin Kelola User</title>
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
						<h2 class="page-title">Detail User</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Daftar User</div>
							<div class="panel-body table-responsive">
								<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
								else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Telp</th>
											<th>KTP</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no=0;
										$sql = "SELECT * from  users ";
										$query = mysqli_query($koneksidb,$sql);
										while($result=mysqli_fetch_array($query))
										{
											$no++;
										?>	
										<tr>
											<td><?php echo $no;?></td>
											<td><?php echo htmlentities($result['nama_user']);?></td>
											<td><?php echo htmlentities($result['email']);?></td>
											<td><?php echo htmlentities($result['telp']);?></td>
											<td><a href="../image/id/<?php echo htmlentities($result['ktp']);?>" target="blank"><img src="../image/id/<?php echo htmlentities($result['ktp']);?>" width="40"></a></td>
											<td>
												<a href="#myModal" data-toggle="modal" data-load-code="<?php echo $result['email']; ?>" data-remote-target="#myModal .modal-body"><span class="glyphicon glyphicon-eye-open"></span></a>&nbsp;&nbsp;&nbsp;
												<a href="reg-users.php?reset_password=<?php echo $result['email'];?>" onclick="return confirm('Apakah anda yakin akan mereset password untuk email <?php echo $result['email'];?>?');"><span class="fa fa-refresh"></span></a>&nbsp;&nbsp;&nbsp;
												<a href="reg-users.php?del_id=<?php echo $result['id_user'];?>&email=<?php echo htmlentities($result['email']);?>" onclick="return confirm('Apakah anda yakin akan menghapus akun <?php echo $result['nama_user'];?>?');"><span class="fa fa-close"></span></a>
											</td>
										</tr>
										<?php } ?>
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
			$($this.data('remote-target')).load('userview.php?code='+code);
			app.code = code;
		}
	});
	</script>

</body>
</html>
<?php } ?>