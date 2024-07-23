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
	<title>Narty Boarding House | Admin Edit Info Pemilik Kost</title>
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
						<h2 class="page-title">Edit Pemilik Kost</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Form Edit Pemilik Kost</div>
									<div class="panel-body">
										<?php
										$id=$_GET['id'];
										$respassword=md5('123456');
										$sql ="SELECT * FROM pemilik_kost WHERE id_pemilik='$id'";
										$query = mysqli_query($koneksidb,$sql);
										$result = mysqli_fetch_array($query);
										if(isset($_POST['submitreset'])){
											$sql ="SELECT password FROM pemilik_kost WHERE id_pemilik='$id'";
											$query= mysqli_query($koneksidb,$sql);
												if(mysqli_num_rows($query) > 0){
													$con="UPDATE pemilik_kost SET password='$respassword' WHERE id_pemilik='$id'";
													$chngpwd = mysqli_query($koneksidb,$con);
													$msg="Your Password succesfully changed";
												}else {
													$error="Your current password is not valid.";	
												}
										}
										?>
										<form method="post" class="form-horizontal" name="theform" action ="pkeditact.php" onsubmit="return valid(this);" enctype="multipart/form-data">
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
												<label class="col-sm-2 control-label">Tipe Kost<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select class="form-control white_bg" name="tipekost" id="tipekost" required>
														<option value="Pria" <?php if($result['tipe_kost'] == 'Pria') echo 'selected'; ?>>Pria</option>
														<option value="Wanita" <?php if($result['tipe_kost'] == 'Wanita') echo 'selected'; ?>>Wanita</option>
														<option value="Campur" <?php if($result['tipe_kost'] == 'Campur') echo 'selected'; ?>>Campur</option>
													</select>
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
												<label class="col-sm-2 control-label">Alamat Kost<span style="color:red">*</span></label>
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
											<div class="form-group">
												<div class="col-sm-10 col-sm-offset-1">
													<style>
													#map {
														height: 400px;
														width: 100%;
														}
													</style>
													<h4>Edit Lokasi Kost pada Google Maps</h4>
													<div id="map"></div>
													<input type="text" name="latitude" id="latitude" hidden>
													<input type="text" name="longitude" id="longitude" hidden>
													<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_iV3faeC_1QJw69QzDDFbUXVL4G9XbtU&callback=initMap"></script>
													<script>
														function initMap() {
															// Pastikan variabel latitude dan longitude diatur dengan benar
															var lat = parseFloat("<?php echo $result['latitude']; ?>");
															var lng = parseFloat("<?php echo $result['longitude']; ?>");
															// Periksa apakah lat dan lng adalah angka
															if (isNaN(lat) || isNaN(lng)) {
																console.error("Latitude atau Longitude tidak valid.");
																return;
															}

															var map = new google.maps.Map(document.getElementById('map'), {
																center: {lat: lat, lng: lng},
																zoom: 15
															});
															var marker = new google.maps.Marker({
																position: {lat: lat, lng: lng},
																map: map,
																draggable: true // Marker dapat digeser
															});
															// Ketika marker digeser, update nilai latitude dan longitude pada form
															marker.addListener('dragend', function(event) {
																document.getElementById('latitude').value = event.latLng.lat();
																document.getElementById('longitude').value = event.latLng.lng();
															});
															// Ketika peta diklik, pindahkan marker dan update form
															map.addListener('click', function(event) {
																marker.setPosition(event.latLng);
																document.getElementById('latitude').value = event.latLng.lat();
																document.getElementById('longitude').value = event.latLng.lng();
															});
														}
														// Pastikan initMap dipanggil setelah halaman selesai dimuat
														window.addEventListener('load', initMap);
													</script>
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
														<button class="btn btn-primary" name="submitreset" style="margin-top:4%" onclick="return confirm('Apakah anda akan mereset password <?php echo $result['nama_pemilik'];?>?');" >Reset Password</button>
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