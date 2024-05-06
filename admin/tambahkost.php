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
						<h2 class="page-title">Tambah kost</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Form Tambah kost</div>
									<div class="panel-body">
										<form method="post" name="theform" action="tambahkostact.php" class="form-horizontal" onsubmit="return valid(this);" enctype="multipart/form-data">
											<div class="form-group">
												<label class="col-sm-2 control-label">Nama Kamar Kost<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="kosttitle" class="form-control" required>
												</div>
												<label class="col-sm-2 control-label">Pilih nama_kost<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="form-control" name="kostname" required="" data-parsley-error-message="Field ini harus diisi" >
														<option value="">== Pilih nama_kost ==</option>
														<?php
														$idkost=$result['id_namakost'];
														$nmkost=$result['nama_kost'];
														if($_SESSION['alogin'] != 'admin'){
															echo "<option value='$idkost'>$nmkost</option>";
														}else{
															echo "<option value='$idkost'>$nmkost</option>";
															$mySql = "SELECT * FROM nama_kost ORDER BY id_namakost";
															$myQry = mysqli_query($koneksidb, $mySql);
															while ($myData = mysqli_fetch_array($myQry)) {
															if ($myData['id_namakost']== $datanama_kost) {
																$cek = " selected";
																} else { $cek=""; }
																echo "<option value='$myData[id_namakost]' $cek>$myData[nama_kost] </option>";
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Deskripsi kost<span style="color:red">*</span></label>
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
														<option value="Tidak">Tidak Ada</option>
													</select>
												</div>
											</div>
											<div class="hr-dashed"></div>
											<div class="form-group">
												<div class="col-sm-12">
													<h4><b>Upload Gambar</b></h4>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-4">
													Gambar 1<span style="color:red">*</span><input type="file" name="img1" accept="image/*" required>
												</div>
												<div class="col-sm-4">
													Gambar 2<span style="color:red">*</span><input type="file" name="img2" accept="image/*" required>
												</div>
												<div class="col-sm-4">
													Gambar 3<input type="file" name="img3" accept="image/*">
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-4">
													Gambar 4<input type="file" name="img4" accept="image/*">
												</div>
												<div class="col-sm-4">
													Gambar 5<input type="file" name="img5" accept="image/*">
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