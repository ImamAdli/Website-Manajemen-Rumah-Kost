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
	<title>Narty Boarding House | Admin Edit Info Nama Kost</title>
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
						<h2 class="page-title">Edit Nama Kost</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Form Edit Nama Kost</div>
									<div class="panel-body">
										<?php
										$id=$_GET['id'];
										$respassword=md5('123456');
										$sql ="SELECT * FROM nama_kost WHERE id_namakost='$id'";
										$query = mysqli_query($koneksidb,$sql);
										$result = mysqli_fetch_array($query);
										if(isset($_POST['submitreset'])){
											$sql ="SELECT password FROM nama_kost WHERE id_namakost='$id'";
											$query= mysqli_query($koneksidb,$sql);
												if(mysqli_num_rows($query) > 0){
													$con="UPDATE nama_kost SET password='$respassword' WHERE id_namakost='$id'";
													$chngpwd = mysqli_query($koneksidb,$con);
													$msg="Your Password succesfully changed";
												}else {
													$error="Your current password is not valid.";	
												}
										}
										?>
										<form method="post" class="form-horizontal" name="theform" action ="namakosteditact.php" onsubmit="return valid(this);" enctype="multipart/form-data">
										
											<div class="form-group">
												<label class="col-sm-2 control-label">Nama Kost<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="hidden" name="id" class="form-control" value="<?php echo $id;?>" required>
													<input type="text" class="form-control" value="<?php echo htmlentities($result['nama_kost']);?>" name="namakost" id="namakost" required>
												</div>
												<label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="email" class="form-control" value="<?php echo htmlentities($result['email']);?>" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">

												<label class="col-sm-2 control-label">Telepon<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="telepon" class="form-control" value="<?php echo htmlentities($result['telepon']);?>" required>
												</div>
											</div>	
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Nama Pemilik<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="namapemilik" class="form-control" value="<?php echo htmlentities($result['nama_pemilik']);?>" required>
												</div>
												<label class="col-sm-2 control-label">No.Rekening<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="rekening" class="form-control" value="<?php echo htmlentities($result['rekening']);?>" required>
												</div>
											</div>	
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Alamat<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="alamat" class="form-control" value="<?php echo htmlentities($result['alamat']);?>" required>
												</div>
												<label class="col-sm-2 control-label">Status<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="form-control" name="statuspk" required>
														<?php
															$js = $result['statuspk'];
															echo "<option value='$js' selected>".$js."</option>";
															echo "<option value='Approved'>Approved</option>";
															echo "<option value='Rejected'>Rejected</option>";
														?>
													</select>											
												</div>
											</div>	
											<div class="hr-dashed"></div>
											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<button class="btn btn-primary" type="submit" style="margin-top:4%">Simpan Perubahan</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="form-group">
											<div class="col-sm-3">
												<form method="post" name="submitreset">
													<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
													else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
													<div class="col-sm-4">
														<button class="btn btn-primary" name="submitreset" style="margin-top:4%" onclick="return confirm('Apakah anda akan mereset password <?php echo $result['nama_kost'];?>?');" >Reset Password</button>
													</div>
												</form>
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
</body>
</html>
<?php } ?>