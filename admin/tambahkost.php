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
	<title>Narty Boarding House | Admin Tambah kost</title>
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
						<h2 class="page-title">Tambah kamar Kost</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Form Tambah kost</div>
									<div class="panel-body">
										<?php 
										$id=$_SESSION['alogin'];
										$sql ="SELECT * FROM  pemilik_kost WHERE email ='$id'";
										$query = mysqli_query($koneksidb,$sql);
										$result = mysqli_fetch_array($query);
										?>
										<form method="post" name="theform" action="tambahkostact.php" class="form-horizontal" onsubmit="return valid(this);" enctype="multipart/form-data">
											<div class="form-group">
												<label class="col-sm-2 control-label">Nama Kamar Kost<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="kosttitle" class="form-control" required>
												</div>
												<label class="col-sm-2 control-label">Pilih Nama Kost<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="form-control" name="kostname" required="" data-parsley-error-message="Field ini harus diisi" >
														<option value="">== Pilih Nama Kost ==</option>
													<?php
													$idkost=$result['id_pemilik'];
													$nmkost=$result['nama_kost'];
													if($_SESSION['alogin'] != 'admin'){
															echo  "<option value='$idkost' selected >$nmkost</option>";
													}else{
														$mySql = "SELECT * FROM pemilik_kost ORDER BY id_pemilik";
														$myQry = mysqli_query($koneksidb, $mySql);
														while ($myData = mysqli_fetch_array($myQry)) {
															echo "<option value='$myData[id_pemilik]'>$myData[nama_kost] </option>";
														}
													}
													?>
													</select>
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Deskripsi Kamar Kost<span style="color:red">*</span></label>
												<div class="col-sm-10">
													<textarea class="form-control" name="kostview" rows="3" required></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Harga /Hari<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="number" min="0" name="priceperday" class="form-control" required>
												</div>
												<label class="col-sm-2 control-label">Kamar Mandi<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="form-control" name="bathinfo" required>
														<option value=""> == Pilih Fasilitas == </option>
														<option value="Didalam">Didalam</option>
														<option value="Diluar">Diluar</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Luas Kamar (m²)<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="number" min="0" name="modelluas" class="form-control" required>
												</div>
												<label class="col-sm-2 control-label">AC (Aic Conditioner)<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="form-control" name="acinfo" required>
														<option value=""> == Pilih Fasilitas == </option>
														<option value="Ada">Ada</option>
														<option value="Tidak Ada">Tidak Ada</option>
													</select>
												</div>
											</div>
											<div class="hr-dashed"></div>
													
											<div class="form-group">
												<div class="col-sm-10 col-sm-offset-1">
													<h3><b><center>Upload Gambar Kamar</center></b></h3>
													<label for="file" class="drop-container" id="dropcontainer">
														<span class="drop-title">Drag and Drop Images Here &nbsp;<i class="fa fa-picture-o"></i></span>
														or
														<input type="file" name="files[]" id="file" accept="image/*" multiple required>
													</label>
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<div class="col-sm-3">
													<div class="checkbox checkbox-inline">
														<button class="btn btn-primary" type="submit">Tambah Kamar</button>
													</div>
												</div>
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